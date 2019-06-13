// ---------------------------------
// ---------  Uploader -------------
// ---------------------------------
// var Uploader = (function() {

function createUploader(croptype) {
    // -------setting-------
    // 如果使用原始大小，超大的图片可能会出现 Croper UI 卡顿，所以这里建议先缩小后再crop.
    var FRAME_WIDTH = 1600;


    var _ = WebUploader;
    var Uploader = _.Uploader;
    var uploaderContainer = $('#creation-cover-pic-' + croptype + '-copper-wrapper .uploader-container');
    var uploader, file;

    var dataid = $('#creation-cover-pic-' + croptype).attr('dataid');
    var datatype;
    if (croptype == "post") {
        datatype = "WEN";
    }
    else if (croptype == "tune") {
        datatype = "QU";
    }
    else if (croptype == "opus") {
        datatype = "PU";
    }


    if ( !Uploader.support() ) {
        alert( 'Web Uploader 不支持您的浏览器！');
        throw new Error( 'WebUploader does not support the browser you are using.' );
    }

    // hook,
    // 在文件开始上传前进行裁剪。
    Uploader.register({
        'before-send-file': 'cropImage'
    }, {

        cropImage: function( file ) {
            var data = file._cropData,
                image, deferred;

            file = this.request( 'get-file', file );
            deferred = _.Deferred();

            image = new _.Lib.Image();

            deferred.always(function() {
                image.destroy();
                image = null;
            });

            image.once( 'error', deferred.reject );
            image.once( 'load', function() {
                image.crop( data.x, data.y, data.width, data.height, data.scale );
            });

            image.once( 'complete', function() {
                var blob, size;

                // 移动端 UC / qq 浏览器的无图模式下
                // ctx.getImageData 处理大图的时候会报 Exception
                // INDEX_SIZE_ERR: DOM Exception 1
                try {
                    
                    blob = image.getAsBlob();
                    size = file.size;
                    file.source = blob;
                    file.size = blob.size;


                    file.trigger( 'resize', blob.size, size );

                    deferred.resolve();
                } catch ( e ) {
                    console.log( e );
                    // 出错了直接继续，让其上传原始图片
                    deferred.resolve();
                }
            });

            file._info && image.info( file._info );
            file._meta && image.meta( file._meta );
            image.loadFromBlob( file.source );
            return deferred.promise();
        }
    });

    return {
        init: function( selectCb ) {

            uploader = new Uploader({
                pick: {
                    // id: '#filePicker',
                    // id:'#post-cover-click-upload-wrapper',
                    id: '#creation-cover-pic-' + croptype + ' .pick-uploader',
                    multiple: false
                },
                formData: {
                    createid: dataid,
                    createtype:datatype
                },
                // 设置用什么方式去生成缩略图。
                thumb: {
                    quality: 70,

                    // 不允许放大
                    allowMagnify: false,

                    // 是否采用裁剪模式。如果采用这样可以避免空白内容。
                    crop: false
                },

                // 禁掉分块传输，默认是开起的。
                chunked: false,

                // 禁掉上传前压缩功能，因为会手动裁剪。
                compress: false,

                // fileSingleSizeLimit: 2 * 1024 * 1024,

                server: 'http://114.215.141.35/frontend/web/index.php/home/creation/upcover',
                swf: 'dist/Uploader.swf',
                fileNumLimit: 1,
                onError: function() {
                    var args = [].slice.call(arguments, 0);
                    alert(args.join('\n'));
                }
            });

            uploader.on('fileQueued', function( _file ) {
                file = _file;
                uploader.makeThumb( file, function( error, src ) {
                    if ( error ) {
                        alert('不能预览');
                        return;
                    }
                    selectCb( src );
                }, FRAME_WIDTH, 1 );   // 注意这里的 height 值是 1，被当成了 100% 使用。
            }).on('uploadSuccess', function(_file, response) {
                var responseStr = response._raw;
                $('#creation-cover-pic-' + croptype).attr("dataurl",responseStr);
                // response=response.replace('\n','');
                console.log(responseStr);
                // alert('上传成功');
            });
        },
        reset: function() {
            uploader = null;
            file = null;
        },
        crop: function( data ) {
           
            var scale = 1.0;
            if (croptype == 'post') {
                scale = postCroper.getImageSize().width / file._info.width;
            }
            if (croptype == 'tune') {
                scale = tuneCroper.getImageSize().width / file._info.width;
            }
            if (croptype == 'opus') {
                scale = opusCroper.getImageSize().width / file._info.width;
            }
    
            data.scale = scale;

            file._cropData = {
                x: data.x1,
                y: data.y1,
                width: data.width,
                height: data.height,
                scale: data.scale
            };
        },

        upload: function() {
            uploader.upload();
        },
    }
};
// })();

// ---------------------------------
// ---------  Crpper ---------------
// ---------------------------------
// var Croper = (function() {
function createCroper(croptype) {
    var container = $('#creation-cover-pic-' + croptype + '-copper-wrapper .cropper-wraper');
    var $image = container.find('.img-container img');
    var btn = $('#creation-cover-pic-' + croptype + '-copper-wrapper .upload-btn');
    var isBase64Supported, callback;
    var cropRatio;
    if (croptype == "post") {
        cropRatio = 3 / 1;
    }
    else if (croptype == "tune") {
        cropRatio = 1 / 1;
    }
    else if (croptype == "opus") {
        cropRatio = 3 / 4;
    }
    $image.cropper({
        aspectRatio: cropRatio,
        preview: "#creation-cover-pic-" + croptype + "-preview-content",
        responsive: false,
        restore:false,
        done: function(data) {
         
            $("#creation-cover-pic-" + croptype + "-copper-wrapper").css("z-index","1024");
            $("#" + croptype + "-cover-click-upload-wrapper").hide();
 
            $('#creation-cover-pic-' + croptype + '-copper-wrapper .upload-cancel-btn').show();
            $('#creation-cover-pic-' + croptype + '-copper-wrapper .upload-btn').show();
        }
    });

    function srcWrap( src, cb ) {
 
        // we need to check this at the first time.
        if (typeof isBase64Supported === 'undefined'
            ||isBase64Supported == false) {
            (function() {
                var data = new Image();
                var support = true;
                data.onload = data.onerror = function() {
                    if( this.width != 1 || this.height != 1 ) {
                        support = false;
                    }
                }
                data.src = src;
                isBase64Supported = support;
            })();
        }

        if ( isBase64Supported ) {
            cb( src );
        } else {
            // otherwise we need server support.
            // convert base64 to a file.
            $.ajax('preview.php', {
                method: 'POST',
                data: src,
                dataType:'json'
            }).done(function( response ) {
                if (response.result) {
                    cb( response.result );
                } else {
                    alert("预览出错");
                }
            });
        }
        isBase64Supported = false;
    }

    btn.on('click', function() {
        $("#creation-cover-pic-" + croptype + "-copper-wrapper").hide();
        $('#' + croptype + '-cover-click-change-wrapper').show();
       
        callback && callback($image.cropper("getData"));
        return false;
    });


    return {
        setSource: function( src ) {
          
            // 处理 base64 不支持的情况。
            // 一般出现在 ie6-ie8
            srcWrap( src, function( src ) {
                $image.cropper("setImgSrc", src);
            });

            container.removeClass('webuploader-element-invisible');
             $("#creation-cover-pic-" + croptype + "-copper-wrapper").show();

            return this;
        },
        unset: function() {

            $image.cropper("setImgSrc", " ");
        },

        getImageSize: function() {
            var img = $image.get(0);
            return {
                width: img.naturalWidth,
                height: img.naturalHeight
            }
        },

        setCallback: function( cb ) {

            callback = cb;
            return this;
        },

        disable: function() {
            $image.cropper("disable");
            return this;
        },

        enable: function() {
            $image.cropper("enable");
            return this;
        }
    }
};

var postCroper = createCroper('post');
var postUploader = createUploader('post');
postUploader.init(function( src ) {
    postCroper.setSource( src );
    postCroper.setCallback(function( data ) {
        postUploader.crop(data);
        postUploader.upload();
    });
});

function resetCoperNUploaderPost() {

    $('#creation-cover-pic-post-preview-content').children().remove();

    $('#post-cover-click-upload-wrapper').children().remove();
    $('#post-cover-click-upload-wrapper').append(" <span><span class='grey'>点击上传封面</span><i class='upload-icon ace-icon fa fa-plus fa-x'></i></span>");
    $('#post-cover-click-upload-wrapper').show();
    $('#creation-cover-pic-post-copper-wrapper').css('z-index','-1');
    $('#creation-cover-pic-post-copper-wrapper').hide();

    $('#creation-cover-pic-post-copper-wrapper .cropper-wraper .img-container img').remove();
    $('#creation-cover-pic-post-copper-wrapper .cropper-wraper .img-container .cropper-container').remove();
    $('#creation-cover-pic-post-copper-wrapper .cropper-wraper .img-container').append('<img src=\"\" alt=\"\" />');
    $('#creation-cover-pic-post-copper-wrapper .upload-cancel-btn').css('display','none');
    $('#creation-cover-pic-post-copper-wrapper .upload-btn').css('display','none');

    postCroper.unset();

    postCroper = createCroper('post');
    postUploader = createUploader('post');
    postUploader.init(function( src ) {
        postCroper.setSource( src );
        postCroper.setCallback(function( data ) {
            postUploader.crop(data);
            postUploader.upload();
        });
    });
}

var btnCancelPost = $('#creation-cover-pic-post-copper-wrapper .upload-cancel-btn');
btnCancelPost.on('click',function(){
   resetCoperNUploaderPost();
    // $('#cropper-img-container img').remove();
});
var btnChangePost = $('#post-cover-click-change-wrapper');
btnChangePost.on('click',function(){
    resetCoperNUploaderPost();
    btnChangePost.hide();
});

//////
var tuneCroper = createCroper('tune');
var tuneUploader = createUploader('tune');
tuneUploader.init(function( src ) {
    tuneCroper.setSource( src );
    tuneCroper.setCallback(function( data ) {
        tuneUploader.crop(data);
        tuneUploader.upload();
    });
});

function resetCoperNUploaderTune() {

    $('#creation-cover-pic-tune-preview-content').children().remove();

    $('#tune-cover-click-upload-wrapper').children().remove();
    $('#tune-cover-click-upload-wrapper').append(" <span><span class='grey'>点击上传封面</span><i class='upload-icon ace-icon fa fa-plus fa-x'></i></span>");
    $('#tune-cover-click-upload-wrapper').show();
    $('#creation-cover-pic-tune-copper-wrapper').css('z-index','-1');
    $('#creation-cover-pic-tune-copper-wrapper').hide();

    $('#creation-cover-pic-tune-copper-wrapper .cropper-wraper .img-container img').remove();
    $('#creation-cover-pic-tune-copper-wrapper .cropper-wraper .img-container .cropper-container').remove();
    $('#creation-cover-pic-tune-copper-wrapper .cropper-wraper .img-container').append('<img src=\"\" alt=\"\" />');
    $('#creation-cover-pic-tune-copper-wrapper .upload-cancel-btn').css('display','none');
    $('#creation-cover-pic-tune-copper-wrapper .upload-btn').css('display','none');

    tuneCroper.unset();

    tuneCroper = createCroper('tune');
    tuneUploader = createUploader('tune');
    tuneUploader.init(function( src ) {
        tuneCroper.setSource( src );
        tuneCroper.setCallback(function( data ) {
            tuneUploader.crop(data);
            tuneUploader.upload();
        });
    });
}

var btnCancelTune = $('#creation-cover-pic-tune-copper-wrapper .upload-cancel-btn');
btnCancelTune.on('click',function(){
   resetCoperNUploaderTune();
    // $('#cropper-img-container img').remove();
});
var btnChangeTune = $('#tune-cover-click-change-wrapper');
btnChangeTune.on('click',function(){
    resetCoperNUploaderTune();
    btnChangeTune.hide();
});


//////
var opusCroper = createCroper('opus');
var opusUploader = createUploader('opus');
opusUploader.init(function( src ) {
    opusCroper.setSource( src );
    opusCroper.setCallback(function( data ) {
        opusUploader.crop(data);
        opusUploader.upload();
    });
});

function resetCoperNUploaderOpus() {

    $('#creation-cover-pic-opus-preview-content').children().remove();

    $('#opus-cover-click-upload-wrapper').children().remove();
    $('#opus-cover-click-upload-wrapper').append(" <span><span class='grey'>点击上传封面</span><i class='upload-icon ace-icon fa fa-plus fa-x'></i></span>");
    $('#opus-cover-click-upload-wrapper').show();
    $('#creation-cover-pic-opus-copper-wrapper').css('z-index','-1');
    $('#creation-cover-pic-opus-copper-wrapper').hide();

    $('#creation-cover-pic-opus-copper-wrapper .cropper-wraper .img-container img').remove();
    $('#creation-cover-pic-opus-copper-wrapper .cropper-wraper .img-container .cropper-container').remove();
    $('#creation-cover-pic-opus-copper-wrapper .cropper-wraper .img-container').append('<img src=\"\" alt=\"\" />');
    $('#creation-cover-pic-opus-copper-wrapper .upload-cancel-btn').css('display','none');
    $('#creation-cover-pic-opus-copper-wrapper .upload-btn').css('display','none');

    opusCroper.unset();

    opusCroper = createCroper('opus');
    opusUploader = createUploader('opus');
    opusUploader.init(function( src ) {
        opusCroper.setSource( src );
        opusCroper.setCallback(function( data ) {
            opusUploader.crop(data);
            opusUploader.upload();
        });
    });
}

var btnCancelOpus = $('#creation-cover-pic-opus-copper-wrapper .upload-cancel-btn');
btnCancelOpus.on('click',function(){
   resetCoperNUploaderOpus();
    // $('#cropper-img-container img').remove();
});
var btnChangeOpus = $('#opus-cover-click-change-wrapper');
btnChangeOpus.on('click',function(){
    resetCoperNUploaderOpus();
    btnChangeOpus.hide();
});




