// Scroll-tool front-end functionality

jQuery(document).ready(function($) {
		
		var scrollHeight;
		var lastPosition = 0;
		var downDirect = false;
		var isDown = true;
		var scrollPause = false;
		
		if(scrollToolParams.scrollToolOptions.hide_for_mobile && $( window ).width() < 768){
		var showAdjScroll = false;
		}
		else
		{
		var showAdjScroll = true;
		}
		
	if(showAdjScroll){
		var adjScroll='<div class="'+scrollToolParams.scrollToolClass+'" id="scroll-tool" style="'+scrollToolParams.scrollToolStyle+'">'+scrollToolParams.scrollToolLabel+'</div>';
		$( "body" ).append(adjScroll);
			if(scrollToolParams.scrollToolOptions.animated_scroll){
			$(window).scroll(function () {
			scrollHeight = $(document).scrollTop();
				if( scrollHeight > 300 && isDown ){
					$( "#scroll-tool" ).stop();
					isDown = false;
					$( "#scroll-tool" ).fadeTo('slow', 0.5);
				}
				if(scrollHeight > 300 && !scrollPause && !scrollToolParams.scrollToolOptions.disable_down){
				downDirect = false;
				$('#scroll-tool #label-up').css('display', 'block');
				$('#scroll-tool #label-down').css('display', 'none');
				$('#scroll-tool').css('background', scrollToolParams.scrollToolOptions.upBg);
				}
				if( scrollHeight <= 300 && !isDown && scrollToolParams.scrollToolOptions.disable_down ){
					$( "#scroll-tool" ).stop();
					isDown = true;
					$( "#scroll-tool" ).fadeOut('slow');
				}
			});
			}
			else
			{
			$(window).scroll(function () {
			scrollHeight = $(document).scrollTop();
				if( scrollHeight > 300 && isDown ){
					isDown = false;
					$( "#scroll-tool" ).css('display', 'block');
				}
				if(scrollHeight > 300 && !scrollPause && !scrollToolParams.scrollToolOptions.disableDown){
				downDirect = false;
				$('#scroll-tool #label-up').css('display', 'block');
				$('#scroll-tool #label-down').css('display', 'none');
				$('#scroll-tool').css('background', scrollToolParams.scrollToolOptions.upBg);
				}
				if( scrollHeight <= 300 && !isDown && scrollToolParams.scrollToolOptions.disableDown ){
					isDown = true;
					$( "#scroll-tool" ).css('display', 'none');
				}
			});
			}
		
		if(scrollToolParams.scrollToolOptions.animated_scroll && !scrollToolParams.scrollToolOptions.disable_down){
			
			$( "#scroll-tool" ).mouseenter(function(){
				$('#scroll-tool').stop().animate({'opacity':'1'});
			});
			$( "#scroll-tool" ).mouseleave(function(){
				$('#scroll-tool').stop().animate({'opacity':'0.5'});
			});
		}
		
		if(scrollToolParams.scrollToolOptions.animated_scroll && scrollToolParams.scrollToolOptions.disable_down){
			
			$( "#scroll-tool" ).mouseenter(function(){
				if(scrollHeight > 300)
				$('#scroll-tool').stop().animate({'opacity':'1'});
			});
			$( "#scroll-tool" ).mouseleave(function(){
				if(scrollHeight > 300)
				$('#scroll-tool').stop().animate({'opacity':'0.5'});
			});
		}
		
		if(scrollToolParams.scrollToolOptions.animated_motion){
			if(scrollToolParams.scrollToolOptions.disable_down){
				$('#scroll-tool').click(
					function (e) {
						$('html, body').animate({scrollTop: '0px'}, 800);
					}
				);
			}
			else
			{
				$('#scroll-tool').click(
					function (e) {
						if(!downDirect){
						downDirect = true;
						$('#scroll-tool #label-up').css('display', 'none');
						$('#scroll-tool #label-down').css('display', 'block');
						$('#scroll-tool').css('background', scrollToolParams.scrollToolOptions.downBg);
						lastPosition = $(document).scrollTop();
						scrollPause = true;
						$('html, body').stop().animate({scrollTop: '0px'}, 800, function() {scrollPause = false;});
						}
						else
						{
						downDirect = false;
						$('#scroll-tool #label-up').css('display', 'block');
						$('#scroll-tool #label-down').css('display', 'none');
						$('#scroll-tool').css('background', scrollToolParams.scrollToolOptions.upBg);
						scrollPause = true;
						$('html, body').stop().animate({scrollTop: lastPosition+'px'}, 800, function() {scrollPause = false;});
						}
					}
				);
			}
		}
		else
		{
			if(disableDown){
				$('#scroll-tool').click(
					function (e) {
						$( "#scroll-tool" ).css('display', 'none');
						$('html, body').scrollTop(0);
					}
				);
			}
			else
			{
				$('#scroll-tool').click(
					function (e) {

						if(!downDirect){
						downDirect = true;
						$('#scroll-tool #label-up').css('display', 'none');
						$('#scroll-tool #label-down').css('display', 'block');
						$('#scroll-tool').css('background', scrollToolParams.scrollToolOptions.downBg);
						lastPosition = $(document).scrollTop();
						scrollPause = true;
						$('html, body').scrollTop(0);
						scrollPause = false;
						}
						else
						{
						downDirect = false;
						$('#scroll-tool #label-up').css('display', 'block');
						$('#scroll-tool #label-down').css('display', 'none');
						$('#scroll-tool').css('background', scrollToolParams.scrollToolOptions.upBg);
						scrollPause = true;
						$('html, body').scrollTop(lastPosition);
						scrollPause = false;
						}
					}
				);
			}
		}
	}
});