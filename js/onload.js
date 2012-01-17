function make_a_call( argument ){
	$('#debug-console-poptup-wrapper .content-wrapper').addClass('loading');
	$.post( window.location.protocol + '//' + window.location.host + '/wordpress/wp-content/plugins/wp-debug-console/api.php', { argument: argument }, function(data){
		$('#debug-console-poptup-wrapper .content-wrapper').removeClass('loading').html( data );
	});
}

function rememberPosition(){
	var position = $('#debug-console-poptup-wrapper').position();
	setCookie('debug-console-position', position.top + ':' + position.left );
}

function forgetPosition(){
	deleteCookie('debug-console-position');
}

var the_console = '';
the_console += '<div id="debug-console-poptup-wrapper">';
the_console += '	<div class="header-wrapper">';
the_console += '		<div class="pin"></div>';
the_console += '		<div class="handle"></div>';
the_console += '		<div class="x"></div>';
the_console += '	</div>'; // div.header-wrapper
the_console += '	<div class="content-wrapper loading"></div>';
the_console += '	<div class="footer-wrapper">';
the_console += '		<a class="button" argument="caller">Call</a>';
the_console += '		<a class="button" argument="defined-constants">Defined Constants</a>';
the_console += '		<a class="button" argument="clear-log">Clear Log</a>';
the_console += '		<a class="button" argument="php-info">PHP</a>';
the_console += '		<div class="resizer"></div>';
the_console += '	</div>';
the_console += '</div>';

$(document).ready(function(){
	
	$('body').prepend(the_console); 


	var position = getCookie('debug-console-position');

	if( position != undefined ){
		position = position.split(':');
		$('#debug-console-poptup-wrapper').css({
			top: position[0] + 'px',
			left: position[1] + 'px'
		})
	}


	$('#debug-console-poptup-wrapper').draggable({ 
		handle: '.handle',
		stop: function(){ rememberPosition(); }
	});

	$('#debug-console-poptup-wrapper .footer-wrapper').resizable({ handles: 'n, e, s, w' });

	make_a_call();

	$('#debug-console-poptup-wrapper').addClass('show').fadeIn(0);

	$('.wp-debugger, #debug-console-poptup-wrapper').mouseenter(function(){
		$('#debug-console-poptup-wrapper').addClass('show').fadeIn(0);
	});

	$('#debug-console-poptup-wrapper .x').click(function(){
		$('#debug-console-poptup-wrapper').removeClass('show');
		forgetPosition();
	});


	$('#debug-console-poptup-wrapper .pin').click(function(){
		var $console = $('#debug-console-poptup-wrapper');

		$console.toggleClass('pinned');

		if( $console.hasClass('pinned') ){ 
			$(this).attr('title', 'Click to unpin');
		} else {
			$(this).attr('title', 'Click to pin');
		}

		forgetPosition();
	});

	$('#debug-console-poptup-wrapper .button').click(function(e){ 
		make_a_call( $(e.target).attr('argument') );
	});

	$('#debug-console-poptup-wrapper .arrow, #debug-console-poptup-wrapper h3').live('click', function(){
		$(this).parents('.section').toggleClass('open');
	});

});
