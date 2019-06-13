var PageTransitions = (function() {

	var $main = $( '#pt-main' ),
		$pages = $main.children( 'div.pt-page' ),
		$iterate = $( '#iterateEffects' ),
		animcursor = 1,
		pagesCount = $pages.length,
		current = 0,
		isAnimating = false,
		endCurrPage = false,
		endNextPage = false,
		animEndEventNames = {
			'WebkitAnimation' : 'webkitAnimationEnd',
			'OAnimation' : 'oAnimationEnd',
			'msAnimation' : 'MSAnimationEnd',
			'animation' : 'animationend'
		},
		// animation end event name
		animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ],
		// support css animations
		support = Modernizr.cssanimations;
	
	function init() {

		$pages.each( function() {
			var $page = $( this );
			$page.data( 'originalClassList', $page.attr( 'class' ) );
		} );

		$pages.eq( current ).addClass( 'pt-page-current' );


        $('#btn-creation-post').on('click',function(){
        	if($('#btn-creation-tune').hasClass('btn-create-type-active')) {
        	   $('#btn-creation-tune').removeClass('btn-create-type-active');
        	   nextPage(59, 1, 0);
        	}
            if($('#btn-creation-opus').hasClass('btn-create-type-active')) {
        	   $('#btn-creation-opus').removeClass('btn-create-type-active');
        	   nextPage(58, 2, 0);
        	}
        	$('#btn-creation-post').addClass('btn-create-type-active');
        });
        $('#btn-creation-tune').on('click',function(){
        	if($('#btn-creation-post').hasClass('btn-create-type-active')) {
        	   $('#btn-creation-post').removeClass('btn-create-type-active');
        	   nextPage(58, 0, 1);
        	}
            if($('#btn-creation-opus').hasClass('btn-create-type-active')) {
        	   $('#btn-creation-opus').removeClass('btn-create-type-active');
        	   nextPage(59, 2, 1);
        	}
        	$('#btn-creation-tune').addClass('btn-create-type-active');
        });
        $('#btn-creation-opus').on('click',function(){
        	if($('#btn-creation-post').hasClass('btn-create-type-active')) {
        	   $('#btn-creation-post').removeClass('btn-create-type-active');
        	   nextPage(59, 0, 2);
        	}
            if($('#btn-creation-tune').hasClass('btn-create-type-active')) {
        	   $('#btn-creation-tune').removeClass('btn-create-type-active');
        	   nextPage(58, 1, 2);
        	}
        	$('#btn-creation-opus').addClass('btn-create-type-active');
        });
        
	}

	function nextPage( animation, currentpage, nextpage ) {

		if( isAnimating ) {
			return false;
		}

		isAnimating = true;
		
		var $currPage = $pages.eq( currentpage );

		if( current < pagesCount - 1 ) {
			++current;
		}
		else {
			current = 0;
		}

		var $nextPage = $pages.eq( nextpage ).addClass( 'pt-page-current' ),
			outClass = '', inClass = '';


		switch( animation ) {

			case 58:
				outClass = 'pt-page-rotateCubeLeftOut pt-page-ontop';
				inClass = 'pt-page-rotateCubeLeftIn';
				break;
			case 59:
				outClass = 'pt-page-rotateCubeRightOut pt-page-ontop';
				inClass = 'pt-page-rotateCubeRightIn';
				break;
			
		}

		$currPage.addClass( outClass ).on( animEndEventName, function() {
			$currPage.off( animEndEventName );
			endCurrPage = true;
			if( endNextPage ) {
				onEndAnimation( $currPage, $nextPage );
			}
		} );

		$nextPage.addClass( inClass ).on( animEndEventName, function() {
			$nextPage.off( animEndEventName );
			endNextPage = true;
			if( endCurrPage ) {
				onEndAnimation( $currPage, $nextPage );
			}
		} );

		if( !support ) {
			onEndAnimation( $currPage, $nextPage );
		}

	}

	function onEndAnimation( $outpage, $inpage ) {
		endCurrPage = false;
		endNextPage = false;
		resetPage( $outpage, $inpage );
		isAnimating = false;
	}

	function resetPage( $outpage, $inpage ) {
		$outpage.attr( 'class', $outpage.data( 'originalClassList' ) );
		$inpage.attr( 'class', $inpage.data( 'originalClassList' ) + ' pt-page-current' );
	}

	init();

	return { init : init };

})();