$(document).ready(function(){

    //init state
    setPauseStateUI();
    setProgressUI(0);
    // init songinfo
    $("#song-list-wrap").find("li").each(function(){
       var opusid = $(this).attr("opus-id");
       // var opusname = $(this).attr("opus-name");
       // var opusmp3url = resourceBasicUrl + "/" + opusid + "/" + opusname + "/" + opusname + ".mp3";
       // mp3s.push(opusmp3url);
       if ($(this).attr("opus-active") == "true") {
          var songinfodivs = $(this).children()
          var songinfoclone = songinfodivs.clone(true);

          $("#current-song").append(songinfoclone);

          activeId = $(this).index();
       }
    });

    //hover  
    $("#song-list-wrap").hide();

    $("#current-song").hover(
        function(){
           $("#song-list-wrap").show();
        },
        function () {
           if (!$(".song-list-wrap").is(":hover")) {
              $("#song-list-wrap").hide();
           }   
        }
    );

    $("#song-list-wrap").hover(
        function(){
            $("#song-list-wrap").show();
        },
        function(){
            $("#song-list-wrap").hide();
        }
    );

    $(".song-item").hover(
        function(){
           $(this).css("border","1px solid white"); 
        },
        function(){
           $(this).css("border","1px solid gray")
        }
    );

});

function setPauseStateUI() {
  $("#play-ic").show();
  $("#pause-ic").hide();
}

function setPlayStateUI() {
  $("#pause-ic").show();
  $("#play-ic").hide();
}

function setProgressUI(timepercent) {
  // console.log(timepercent);
  var totalWidth = $("#progress").width();
  var currentWidth = totalWidth * timepercent;
  var currentWidthIc = currentWidth - 5;
  // console.log(currentWidth);startClock

  $("#progress-ic").css("margin-left",currentWidthIc + "px");
  $("#time-bar-progress").css("width", currentWidth + "px");
}















