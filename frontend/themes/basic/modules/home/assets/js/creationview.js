$( function() { 
	$( 'audio' ).audioPlayer({strTitle:"卡农经典百分百"}); 

	var tune_cover_url = $("#creation-post-view-link-tune").attr("dataimg");
	var player_bar_cover = $("#creation-post-view-link-tune #wrapper .audioplayer .audioplayer-volume .audioplayer-volume-button img");
	player_bar_cover.attr("src", tune_cover_url);

	var opus_cover_url = $("#creation-post-view-link-opus").attr("dataimg");
	var opus_cover = $("#creation-post-view-link-opus img");
	opus_cover.attr("src",opus_cover_url);
});