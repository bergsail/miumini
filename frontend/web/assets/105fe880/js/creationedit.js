function ajax_submit_back() {
   console.log("submit sucess");
}

jQuery(function($){

  $('#btn-creation-create').click(function(){
      
      var formData = new FormData();
      var dataid = $('#creation-cover-pic-post').attr('dataid');
      var post_url = $('#creation-cover-pic-post').attr('dataurl');
      var tune_url = $('#creation-cover-pic-tune').attr('dataurl');
      var opus_url = $('#creation-cover-pic-opus').attr('dataurl');
      var titlePost = $('#form-creation-title-post')[0].value;
      var titleTune = $('#form-creation-title-tune')[0].value;
      var titleOpus = $('#form-creation-title-opus')[0].value;
      var tagsPost = '';
          var tags_obj_post = $('#form-creation-tags-wrap-post .tags .tag');
              tags_obj_post.each(function(){
                var obj = $(this);
                obj.find("button").remove();
                tagsPost = tagsPost + obj.html() + ',';
              });
      var tagsTune = '';
          var tags_obj_tune = $('#form-creation-tags-wrap-tune .tags .tag');
              tags_obj_tune.each(function(){
                var obj = $(this);
                obj.find("button").remove();
                tagsTune = tagsTune + obj.html() + ',';
              });
      var tagsOpus = '';
          var tags_obj_opus = $('#form-creation-tags-wrap-opus .tags .tag');
              tags_obj_opus.each(function(){
                var obj = $(this);
                obj.find("button").remove();
                tagsOpus = tagsOpus + obj.html() + ',';
              });

      var contentPost = $('.edui-body-container').html();
      var contentTune = $('#creation-audio-editor').attr('dataurl');
      var contentOpus = $('#creation-graphic-editor').attr('dataurl');

      var opus_work_author = $('#form-composer').html();
      var opus_work_number = $('#form-opusid').html();
      var opus_work_movement = $('#form-movementid').html();
      var opus_work_key = $('#form-key').html();
      var opus_work_alias = $('#form-alias').html();
      var opus_work_instruments = $('#form-instruments').html();
      var opus_work_birth = $('#form-compose-time').html();
      var opus_work_production = $('#form-publish-time').html();
      var opus_work_period = $('#form-period').html();
      var opus_work_style = $('#form-style').html();
      var opus_work_notation = $('#form-notation').html();

      formData.append('createid', dataid);
      formData.append('createtype', 'WEN_QU_PU');
      formData.append('post_id', '');
      formData.append('tune_id', '');
      formData.append('opus_id', '');
      formData.append('post_path', post_url);
      formData.append('tune_path', tune_url);
      formData.append('opus_path', opus_url);

      formData.append('post_title', titlePost);
      formData.append('post_tags', tagsPost);
      formData.append('post_content', contentPost);

      formData.append('tune_title', titleTune);
      formData.append('tune_tags', tagsTune);
      formData.append('tune_content', contentTune);

      formData.append('opus_title', titleOpus);
      formData.append('opus_tags', tagsOpus);
      formData.append('opus_content', contentOpus);

      formData.append('opus_work_author', opus_work_author);
      formData.append('opus_work_number', opus_work_number);
      formData.append('opus_work_movement', opus_work_movement);
      formData.append('opus_work_key', opus_work_key); 
      formData.append('opus_work_alias', opus_work_alias);
      formData.append('opus_work_instruments', opus_work_instruments);
      formData.append('opus_work_birth', opus_work_birth);
      formData.append('opus_work_production', opus_work_production);
      formData.append('opus_work_period', opus_work_period);
      formData.append('opus_work_style', opus_work_style);
      formData.append('opus_work_notation', opus_work_notation);

      // formData.append('created_by', '');
      // formData.append('created_at', '');
      // formData.append('updated_at', '');
      formData.append('status', 'public');
      formData.append('explore_status', '');
      $.ajax({
          url:'http://114.215.141.35/frontend/web/index.php/home/creation/create', //后台处理程序
          type:'post',         //数据发送方式
          dataType:'json',     //接受数据格式
          data:formData,         //要传递的数据
          success:ajax_submit_back, //回传函数(这里是函数名)
          processData: false,
          contentType: false
      });
  });
  $('#btn-creation-preview').click(function (){
        var formData = new FormData();
        var dataid = $('#creation-cover-pic-post').attr('dataid');
        var post_url = $('#creation-cover-pic-post').attr('dataurl');
        var tune_url = $('#creation-cover-pic-tune').attr('dataurl');
        var opus_url = $('#creation-cover-pic-opus').attr('dataurl');
        var titlePost = $('#form-creation-title-post')[0].value;
        var titleTune = $('#form-creation-title-tune')[0].value;
        var titleOpus = $('#form-creation-title-opus')[0].value;
        var tagsPost = '';
            var tags_obj_post = $('#form-creation-tags-wrap-post .tags .tag');
                tags_obj_post.each(function(){
                  var obj = $(this);
                  obj.find("button").remove();
                  tagsPost = tagsPost + obj.html() + ',';
                });
        var tagsTune = '';
            var tags_obj_tune = $('#form-creation-tags-wrap-tune .tags .tag');
                tags_obj_tune.each(function(){
                  var obj = $(this);
                  obj.find("button").remove();
                  tagsTune = tagsTune + obj.html() + ',';
                });
        var tagsOpus = '';
            var tags_obj_opus = $('#form-creation-tags-wrap-opus .tags .tag');
                tags_obj_opus.each(function(){
                  var obj = $(this);
                  obj.find("button").remove();
                  tagsOpus = tagsOpus + obj.html() + ',';
                });

        var contentPost = $('.edui-body-container').html();
        var contentTune = $('#creation-audio-editor').attr('dataurl');
        var contentOpus = $('#creation-graphic-editor').attr('dataurl');

        var opus_work_author = $('#form-composer').html();
        var opus_work_number = $('#form-opusid').html();
        var opus_work_movement = $('#form-movementid').html();
        var opus_work_key = $('#form-key').html();
        var opus_work_alias = $('#form-alias').html();
        var opus_work_instruments = $('#form-instruments').html();
        var opus_work_birth = $('#form-compose-time').html();
        var opus_work_production = $('#form-publish-time').html();
        var opus_work_period = $('#form-period').html();
        var opus_work_style = $('#form-style').html();
        var opus_work_notation = $('#form-notation').html();

        formData.append('createid', dataid);
        formData.append('createtype', 'WEN_QU_PU');
        formData.append('post_id', '');
        formData.append('tune_id', '');
        formData.append('opus_id', '');
        formData.append('post_path', post_url);
        formData.append('tune_path', tune_url);
        formData.append('opus_path', opus_url);

        formData.append('post_title', titlePost);
        formData.append('post_tags', tagsPost);
        formData.append('post_content', contentPost);

        formData.append('tune_title', titleTune);
        formData.append('tune_tags', tagsTune);
        formData.append('tune_content', contentTune);

        formData.append('opus_title', titleOpus);
        formData.append('opus_tags', tagsOpus);
        formData.append('opus_content', contentOpus);

        formData.append('opus_work_author', opus_work_author);
        formData.append('opus_work_number', opus_work_number);
        formData.append('opus_work_movement', opus_work_movement);
        formData.append('opus_work_key', opus_work_key); 
        formData.append('opus_work_alias', opus_work_alias);
        formData.append('opus_work_instruments', opus_work_instruments);
        formData.append('opus_work_birth', opus_work_birth);
        formData.append('opus_work_production', opus_work_production);
        formData.append('opus_work_period', opus_work_period);
        formData.append('opus_work_style', opus_work_style);
        formData.append('opus_work_notation', opus_work_notation);

        // formData.append('created_by', '');
        // formData.append('created_at', '');
        // formData.append('updated_at', '');
        formData.append('status', 'public');
        formData.append('explore_status', '');
        $.ajax({
            url:'http://114.215.141.35/frontend/web/index.php/home/creation/preview', //后台处理程序
            type:'post',         //数据发送方式
            dataType:'json',     //接受数据格式
            data:formData,         //要传递的数据
            success:ajax_submit_back, //回传函数(这里是函数名)
            processData: false,
            contentType: false
        });
  });
  
  //deal tag
  var tag_input_post = $('#form-field-tags-post');
  try{
    tag_input_post.tag(
      {
      placeholder:tag_input_post.attr('placeholder'),
      source: ace.vars['US_STATES'],
      }
    )
  }
  catch(e) {
    tag_input_post.after('<textarea id="'+tag_input_post.attr('id')+'" name="'+tag_input_post.attr('name')+'" rows="3">'+tag_input_post.val()+'</textarea>').remove();
  }

  var tag_input_tune = $('#form-field-tags-tune');
  try{
    tag_input_tune.tag(
      {
      placeholder:tag_input_tune.attr('placeholder'),
      source: ace.vars['US_STATES'],
      }
    )
  }
  catch(e) {
    tag_input_tune.after('<textarea id="'+tag_input_tune.attr('id')+'" name="'+tag_input_tune.attr('name')+'" rows="3">'+tag_input_tune.val()+'</textarea>').remove();
  }

  var tag_input_opus = $('#form-field-tags-opus');
  try{
    tag_input_opus.tag(
      {
      placeholder:tag_input_opus.attr('placeholder'),
      source: ace.vars['US_STATES'],
      }
    )
  }
  catch(e) {
    tag_input_opus.after('<textarea id="'+tag_input_opus.attr('id')+'" name="'+tag_input_opus.attr('name')+'" rows="3">'+tag_input_opus.val()+'</textarea>').remove();
  }


  //deal editor
  function showErrorAlert (reason, detail) {
    var msg='';
    if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
    else {
      }
      $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
        '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
  }

  function dealupload() {
    console.log('audio upload');
  }
  $('#id-input-file-audio').ace_file_input({
      no_file:'mp3,wav,ogg...',
      btn_choose:'选择',
      btn_change:'修改',
      droppable:false,
      thumbnail:false, //| true | large
      //whitelist:'gif|png|jpg|jpeg'
      //blacklist:'exe|php'
      onchange:dealupload
      //
  });

  $('#id-input-file-graphic').ace_file_input({
      no_file:'zip,xml,pdf,jpg ...',
      btn_choose:'选择',
      btn_change:'修改',
      droppable:false,
      // onchange:null,
      thumbnail:false //| true | large
      //whitelist:'gif|png|jpg|jpeg'
      //blacklist:'exe|php'
      //onchange:''
      //
  });


  //editables on first profile page
  $.fn.editable.defaults.mode = 'inline';
  $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    
  
  //text editable
    $('#form-composer') .editable({
       type: 'text',
       name: 'form-composer'
    });
    $('#form-opusid') .editable({
       type: 'text',
       name: 'form-opusid'
    });
    $('#form-movementid') .editable({
       type: 'text',
       name: 'form-movementid'
    });
     $('#form-key') .editable({
       type: 'text',
       name: 'form-key'
    });
    $('#form-alias') .editable({
       type: 'text',
       name: 'form-alias'
    });
    $('#form-instruments') .editable({
       type: 'text',
       name: 'form-instruments'
    });
    $('#form-compose-time') .editable({
       type: 'text',
       name: 'form-compose-time'
    });
    $('#form-publish-time') .editable({
       type: 'text',
       name: 'form-publish-time'
    });
    $('#form-period') .editable({
       type: 'text',
       name: 'form-period'
    });
    $('#form-style') .editable({
       type: 'text',
       name: 'form-style'
    });
    $('#form-notation') .editable({
       type: 'text',
       name: 'form-notation'
    });

    // console.log($('#creation-cover-pic-post-preview-content img').attr('src'));

    var post_src = $('#creation-cover-pic-post-preview-content img').attr('src');
    if (post_src!='undefined'&&post_src!=''){
        $("#creation-cover-pic-post-copper-wrapper").hide();
        $("#post-cover-click-upload-wrapper").hide();
        $('#post-cover-click-change-wrapper').attr("display","block");
        $('#post-cover-click-change-wrapper').show();

        $('#creation-cover-pic-post').attr('dataurl', post_src);
    }
    else {
        $("#creation-cover-pic-post-preview-content").children().remove();
    }

    var tune_src = $('#creation-cover-pic-tune-preview-content img').attr('src');
    if (tune_src!='undefined'&&tune_src!=''){
        $("#creation-cover-pic-tune-copper-wrapper").hide();
        $("#tune-cover-click-upload-wrapper").hide();
        $('#tune-cover-click-change-wrapper').attr("display","block");
        $('#tune-cover-click-change-wrapper').show();

        $('#creation-cover-pic-tune').attr('dataurl', tune_src);
    }
    else {
        $("#creation-cover-pic-tune-preview-content").children().remove();
    }

    var opus_src = $('#creation-cover-pic-opus-preview-content img').attr('src');
    if (opus_src!='undefined'&&opus_src!=''){
        $("#creation-cover-pic-opus-copper-wrapper").hide();
        $("#opus-cover-click-upload-wrapper").hide();
        $('#opus-cover-click-change-wrapper').attr("display","block");
        $('#opus-cover-click-change-wrapper').show();

        $('#creation-cover-pic-opus').attr('dataurl', opus_src);
    }
    else {
        $("#creation-cover-pic-opus-preview-content").children().remove();
    }


    var $formTune = $('#tune-form');
    var file_input_tune = $formTune.find('input[type=file]');
    var upload_in_progress_tune = false;
    
    file_input_tune.ace_file_input({
      no_file:'mp3. ...',
      btn_choose:'选择',
      btn_change:'修改',
      droppable: false,
      thumbnail: false,

      reset_input: function() {
        console.log('reset');
      },
      before_remove: function() {
        console.log('before remove');
        if(upload_in_progress_tune)
          return false;//if we are in the middle of uploading a file, don't allow resetting file input
        return true;
      },

      before_change: function(files, dropped) {
        // var file = files[0];
    
        //  if( file.size > 110000 ) {//~100Kb
        //    alert('File size should not exceed 100Kb!');
        //    return false;
        //  }
        return true;
      }

    }).on('change', function(){
        $('#creation-info-tune .ace-file-input a').hide();
        $('#tune-content-submit').show();
        $('#tune-content-reset').show();
    });
    
    $formTune.on('submit', function() {
      var submit_url = $formTune.attr('action');
      if(!file_input_tune.data('ace_input_files')) return false;//no files selected
      
      var deferred ;
      if( "FormData" in window ) {
        //for modern browsers that support FormData and uploading files via ajax
        var fd = new FormData($formTune.get(0));
          
        //if file has been drag&dropped , append it to FormData
        if(file_input_tune.data('ace_input_method') == 'drop') {
          var files = file_input_tune.data('ace_input_files');
          if(files && files.length > 0) {

            fd.append(file_input_tune.attr('name'), files[0]);
            //to upload multiple files, the 'name' attribute should be something like this: myfile[]
          }
        }
        
        var dataid = $('#creation-audio-editor').attr('dataid');
        fd.append('createid',dataid);
        fd.append('createscoretype', 'tune');

        upload_in_progress_tune = true;
        deferred = $.ajax({
          url: submit_url,
          type: $formTune.attr('method'),
          processData: false,
          contentType: false,
          dataType: 'json',
          data: fd,
          xhr: function() {
            var req = $.ajaxSettings.xhr();
            if (req && req.upload) {
              req.upload.addEventListener('progress', function(e) {
                if(e.lengthComputable) {  
                  var done = e.loaded || e.position, total = e.total || e.totalSize;
                  var percent = parseInt((done/total)*100) + '%';
                  //percentage of uploaded file
                }
              }, false);
            }
            return req;
          },
          beforeSend : function() {
          },
          success : function(msg) {
            console.log(msg);
          }
        })

      }
      else {
        //for older browsers that don't support FormData and uploading files via ajax
        //we use an iframe to upload the form(file) without leaving the page
        upload_in_progress_tune = true;
        deferred = new $.Deferred
        
        var iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
        $formTune.after('<iframe id="'+iframe_id+'" name="'+iframe_id+'" frameborder="0" width="0" height="0" src="about:blank" style="position:absolute;z-index:-1;"></iframe>');
        $formTune.append('<input type="hidden" name="temporary-iframe-id" value="'+iframe_id+'" />');
        $formTune.next().data('deferrer' , deferred);//save the deferred object to the iframe
        $formTune.attr({'method' : 'POST', 'enctype' : 'multipart/form-data',
              'target':iframe_id, 'action':submit_url});

        $formTune.get(0).submit();
        
        //if we don't receive the response after 60 seconds, declare it as failed!
        setTimeout(function(){
          var iframe = document.getElementById(iframe_id);
          if(iframe != null) {
            iframe.src = "about:blank";
            $(iframe).remove();
            
            deferred.reject({'status':'fail','message':'Timeout!'});
          }
        } , 60000);
      }
      
      
      ////////////////////////////
      deferred.done(function(result){
        upload_in_progress_tune = false;
        if(result.statusText == 'OK') {
          $('#creation-audio-editor').attr('dataurl', result.responseText);
        }
        else {
          console.log("upload failed");
        }

        $('#tune-content-submit').hide();
        $('#tune-content-reset').hide();
        // $('#creation-info-opus .ace-file-input a').hide();

      }).fail(function(res){
        upload_in_progress_tune = false;
        $('#creation-audio-editor').attr('dataurl',res.responseText);
        
        $('#tune-content-submit').hide();
        $('#tune-content-reset').hide();
        // $('#creation-info-opus .ace-file-input a').hide();
      });

      deferred.promise();
      return false;
    });
    
    $formTune.on('reset', function() {
      file_input_tune.ace_file_input('reset_input');
      $('#tune-content-submit').hide();
      $('#tune-content-reset').hide();
    });




    var $formOpus = $('#opus-form');
    var file_input_opus = $formOpus.find('input[type=file]');
    var upload_in_progress_opus = false;
    
    file_input_opus.ace_file_input({
      no_file:'zip,xml,pdf,jpg ...',
      btn_choose:'选择',
      btn_change:'修改',
      droppable: false,
      thumbnail: false,

      reset_input: function() {
        console.log('reset');
      },
      before_remove: function() {
        console.log('before remove');
        if(upload_in_progress_opus)
          return false;//if we are in the middle of uploading a file, don't allow resetting file input
        return true;
      },

      before_change: function(files, dropped) {
        // var file = files[0];
    
        //  if( file.size > 110000 ) {//~100Kb
        //    alert('File size should not exceed 100Kb!');
        //    return false;
        //  }
        return true;
      }

    }).on('change', function(){
        $('#creation-info-opus .ace-file-input a').hide();
        $('#opus-content-submit').show();
        $('#opus-content-reset').show();
    });
    
    $formOpus.on('submit', function() {
      var submit_url = $formOpus.attr('action');
      if(!file_input_opus.data('ace_input_files')) return false;//no files selected
      
      var deferred ;
      if( "FormData" in window ) {
        //for modern browsers that support FormData and uploading files via ajax
        var fd = new FormData($formOpus.get(0));
          
        //if file has been drag&dropped , append it to FormData
        if(file_input_opus.data('ace_input_method') == 'drop') {
          var files = file_input_opus.data('ace_input_files');
          if(files && files.length > 0) {

            fd.append(file_input_opus.attr('name'), files[0]);
            //to upload multiple files, the 'name' attribute should be something like this: myfile[]
          }
        }
        
        var dataid = $('#creation-graphic-editor').attr('dataid');
        fd.append('createid',dataid);
        fd.append('createscoretype', 'opus');

        upload_in_progress_opus = true;
        deferred = $.ajax({
          url: submit_url,
          type: $formOpus.attr('method'),
          processData: false,
          contentType: false,
          dataType: 'json',
          data: fd,
          xhr: function() {
            var req = $.ajaxSettings.xhr();
            if (req && req.upload) {
              req.upload.addEventListener('progress', function(e) {
                if(e.lengthComputable) {  
                  var done = e.loaded || e.position, total = e.total || e.totalSize;
                  var percent = parseInt((done/total)*100) + '%';
                  //percentage of uploaded file
                }
              }, false);
            }
            return req;
          },
          beforeSend : function() {
          },
          success : function(msg) {
            console.log(msg);
          }
        })

      }
      else {
        //for older browsers that don't support FormData and uploading files via ajax
        //we use an iframe to upload the form(file) without leaving the page
        upload_in_progress_opus = true;
        deferred = new $.Deferred
        
        var iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
        $formOpus.after('<iframe id="'+iframe_id+'" name="'+iframe_id+'" frameborder="0" width="0" height="0" src="about:blank" style="position:absolute;z-index:-1;"></iframe>');
        $formOpus.append('<input type="hidden" name="temporary-iframe-id" value="'+iframe_id+'" />');
        $formOpus.next().data('deferrer' , deferred);//save the deferred object to the iframe
        $formOpus.attr({'method' : 'POST', 'enctype' : 'multipart/form-data',
              'target':iframe_id, 'action':submit_url});

        $formOpus.get(0).submit();
        
        //if we don't receive the response after 60 seconds, declare it as failed!
        setTimeout(function(){
          var iframe = document.getElementById(iframe_id);
          if(iframe != null) {
            iframe.src = "about:blank";
            $(iframe).remove();
            
            deferred.reject({'status':'fail','message':'Timeout!'});
          }
        } , 60000);
      }
      
      
      ////////////////////////////
      deferred.done(function(result){
        upload_in_progress_opus = false;
        if(result.statusText == 'OK') {
          $('#creation-graphic-editor').attr('dataurl', result.responseText);
        }
        else {
          console.log("upload failed");
        }

        $('#opus-content-submit').hide();
        $('#opus-content-reset').hide();
        // $('#creation-info-opus .ace-file-input a').hide();

      }).fail(function(res){
        upload_in_progress_opus = false;
        $('#creation-graphic-editor').attr('dataurl',res.responseText);
        
        $('#opus-content-submit').hide();
        $('#opus-content-reset').hide();
        // $('#creation-info-opus .ace-file-input a').hide();
      });

      deferred.promise();
      return false;
    });
    
    $formOpus.on('reset', function() {
      file_input_opus.ace_file_input('reset_input');
      $('#opus-content-submit').hide();
      $('#opus-content-reset').hide();
    });



  $('#imgCroper').hide();
  $('#filePicker').hide();
  $('#tune-content-submit').hide();
  $('#tune-content-reset').hide();
  $('#opus-content-submit').hide();
  $('#opus-content-reset').hide();

  //opus data 
  if ($('#creation-audio-editor').attr('dataurl')) {
    var dataurl = $('#creation-audio-editor').attr('dataurl');
    var filename = dataurl.split('-_-')[1];
    if(typeof(filename) != "undefined") {
        $('#creation-info-tune .ace-file-input a').hide();
        $('#tune-form .ace-file-input .ace-file-container').addClass('selected');
        $('#tune-form .ace-file-input .ace-file-container').attr('data-title', '修改');
        $('#tune-form .ace-file-input .ace-file-container .ace-file-name').attr('data-title', filename);
        $('#tune-form .ace-file-input .ace-file-container .ace-file-name i').removeClass('fa-upload');
        $('#tune-form .ace-file-input .ace-file-container .ace-file-name i').addClass('fa-file');
    } 
  }

  if ($('#creation-graphic-editor').attr('dataurl')) {
    var dataurl = $('#creation-graphic-editor').attr('dataurl');
    var filename = dataurl.split('-_-')[1];
    if(typeof(filename) != "undefined") {
    // console.log($("#opus-form label")[0]);
        $('#creation-info-opus .ace-file-input a').hide();
        $('#opus-form .ace-file-input .ace-file-container').addClass('selected');
        $('#opus-form .ace-file-input .ace-file-container').attr('data-title', '修改');
        $('#opus-form .ace-file-input .ace-file-container .ace-file-name').attr('data-title', filename);
        $('#opus-form .ace-file-input .ace-file-container .ace-file-name i').removeClass('fa-upload');
        $('#opus-form .ace-file-input .ace-file-container .ace-file-name i').addClass('fa-file');
    }
  }
       
});