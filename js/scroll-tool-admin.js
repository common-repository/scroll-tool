// Scroll-tool admin front-end functionality

jQuery(document).ready(function($) {
		
		var ext = ".png";
		var adjScroll='<div id="scroll-object"><div></div></div>';
		$( "body" ).append(adjScroll);
	
	$.fn.toggleDisabled = function() {
        return this.each(function() {
            var $this = $(this);
            if ($this.attr('disabled')) $this.removeAttr('disabled');
            else $this.attr('disabled', 'disabled');
        });
    };
	
	if ($("#scroll-sidebar").prop( "checked" )) {
		$( ".scroll-height" ).attr('disabled', 'disabled');
		$( "#scroll-leftbottom,#scroll-middlebottom,#scroll-rightbottom" ).attr('disabled', 'disabled');
		$( ".scroll-left-indent,.scroll-right-indent,.scroll-bottom-indent" ).attr('disabled', 'disabled');
	}
	else
	{
		$( "#scroll-left,#scroll-right" ).attr('disabled', 'disabled');
			if($("#scroll-leftbottom").prop( "checked" )){
			$( ".scroll-right-indent" ).attr('disabled', 'disabled');	
			}
			if($("#scroll-rightbottom").prop( "checked" )){
			$( ".scroll-left-indent" ).attr('disabled', 'disabled');	
			}
			if($("#scroll-middlebottom").prop( "checked" )){
			$( ".scroll-left-indent,.scroll-right-indent" ).attr('disabled', 'disabled');
			}
	}
	
	if(!$( "#scroll-display-labels" ).prop( "checked" )){
	$( "#scroll-text-up,#scroll-text-down,#scroll-text-size,#scroll-text-font,#scroll-text-color" ).attr('disabled', 'disabled');
	}
	
	if($( "#scroll-transparent-bg" ).prop( "checked" )){
	$( "#scroll-background-color" ).attr('disabled', 'disabled');
	}
	
	$('#scroll-text-color, #scroll-background-color, #scroll-border-color, #scroll-shadow-color').each(function() {
	$(this).css('background-color', $(this).val());
	});
	
	$('.qtyplus').click(function(e){
		e.preventDefault();
        fieldId = $(this).attr('field');
        var currentVal = parseInt($('#'+fieldId).val());
		if (!isNaN(currentVal)) {
            $('#'+fieldId).val(currentVal + 1);
        } else {
            $('#'+fieldId).val(0);
        }
		buildScroll();
    });
    $(".qtyminus").click(function(e) {
        e.preventDefault();
        fieldId = $(this).attr('field');
        var currentVal = parseInt($('#'+fieldId).val());
        if (!isNaN(currentVal) && currentVal > 0) {
            $('#'+fieldId).val(currentVal - 1);
        } else {
            $('#'+fieldId).val(0);
        }
		buildScroll();
    });
	
	function buildScroll(){
		var imageSize = 16;
		var fonts = [
					 'Default',
					 'Georgia, serif',
					 '"Palatino Linotype", "Book Antiqua", Palatino, serif',
					 '"Times New Roman", Times, serif',
					 'Arial, Helvetica, sans-serif',
					 '"Arial Black", Gadget, sans-serif',
					 '"Comic Sans MS", cursive, sans-serif',
					 'Impact, Charcoal, sans-serif',
					 '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
					 'Tahoma, Geneva, sans-serif',
					 '"Trebuchet MS", Helvetica, sans-serif',
					 'Verdana, Geneva, sans-serif',
					 '"Courier New", Courier, monospace',
					 '"Lucida Console", Monaco, monospace'
					 ];
		var scrollObject = $("#scroll-object");
		var limits = {
					  'scroll-width'			:	99,
					  'scroll-height'			:	99,
					  'scroll-left-indent'		:	99,
					  'scroll-bottom-indent'	:	99,
					  'scroll-right-indent'		:	99,
					  'scroll-border-thickness'	:	20,
					  'scroll-corners-radius'	:	49,
					  'scroll-shadow-thickness'	:	20
					 };
	var currentObj;
	var currentVal;
	if($("input[name='scroll_tool[button_arrow]']:checked").val() > 18){
		ext = ".svg";
	}else{
		ext = ".png";
	}
	for(var i in limits) {
		currentObj = $('#'+i);
		if(currentObj.attr('disabled')){
		currentObj.css('background-color', '#ECE9D8');
		}
		else
		{
		currentObj.css('background-color', '#FFFFFF');
		}
		currentVal = parseInt(currentObj.val());
		if (isNaN(currentVal) || currentVal < 0) {
			currentObj.val(0);
			currentObj.css('background-color', '#FF0000');
		}
		else
		{
			if (currentVal > limits[i]) {
				currentObj.val(limits[i]);
				currentObj.css('background-color', '#FF0000');
			}
		}
	}
	
	if($( "#scroll-button" ).prop( "checked" )){
		var styles = {
			'width' : $("#scroll-width").val()+"px",
			'height' : $("#scroll-height").val()+"px",
			'font-size' : $("#scroll-text-size").val()+"px",
			'color' : $("#scroll-text-color").val()
			};
		
		scrollObject.css(styles);
		if($( "#scroll-leftbottom" ).prop( "checked" )){
			scrollObject.css('top', 'auto');
			scrollObject.css('right', 'auto');
			scrollObject.css('margin-left', '0');
			scrollObject.css('left', $("#scroll-left-indent").val()+"px");
			scrollObject.css('bottom', $("#scroll-bottom-indent").val()+"px");
		}
		if($( "#scroll-rightbottom" ).prop( "checked" )){
			scrollObject.css('top', 'auto');
			scrollObject.css('left', 'auto');
			scrollObject.css('margin-left', '0');
			scrollObject.css('bottom', $("#scroll-bottom-indent").val()+"px");
			scrollObject.css('right', $("#scroll-right-indent").val()+"px");
		}
		if($( "#scroll-middlebottom" ).prop( "checked" )){
			scrollObject.css('left', '50%');
			scrollObject.css('margin-left', '-'+Math.floor($("#scroll-width").val()/2)+'px');
			scrollObject.css('bottom', $("#scroll-bottom-indent").val()+"px");
		}
		
		var paddingTop = Math.floor($("#scroll-height").val()/2-$("#scroll-text-size").val()/2);
		var topBg = Math.floor($("#scroll-height").val()/2-imageSize/2);
		$("#scroll-object div").css('margin', paddingTop+'px 0 0 '+imageSize+'px');
		if($( "#scroll-display-labels" ).prop( "checked" )){
		var paddingLeft = 'left';
		}
		else
		{
		var paddingLeft = Math.floor($("#scroll-width").val()/2-imageSize/2)+'px';
		}
		
		if($( "#scroll-transparent-bg" ).prop( "checked" )){
		scrollObject.css('background', 'transparent url(../wp-content/plugins/scroll-tool/img/up-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+') no-repeat '+paddingLeft+' '+topBg+'px');
		}
		else
		{
		scrollObject.css('background', $("#scroll-background-color").val()+' url(../wp-content/plugins/scroll-tool/img/up-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+') no-repeat '+paddingLeft+' '+topBg+'px');
		}
		if($( "#scroll-border-thickness" ).val() > 0){
			scrollObject.css('border', $("#scroll-border-thickness").val()+'px '+$("#scroll-border-color").val()+' '+$("select#scroll-border-shape option:selected").val());
		}
		else
		{
			scrollObject.css('border', 'none');
		}
		if($( "#scroll-corners-radius" ).val() > 0){
			var curWidth = $( "#scroll-width" ).val();
			var curHeight = $( "#scroll-height" ).val();
			var curDimention;
			if(curWidth == curHeight) curDimention = curWidth;
			if(curWidth < curHeight) curDimention = curWidth;
			if(curWidth > curHeight) curDimention = curHeight;
			if($("#scroll-corners-radius").val() <= curDimention/2){
			scrollObject.css('border-radius', $("#scroll-corners-radius").val()+'px');
			}
			else
			{
			scrollObject.css('border-radius', Math.floor(curDimention/2)+'px');
			$("#scroll-corners-radius").val(Math.floor(curDimention/2)).css('background-color', '#f0d528');
			}
		}
		else
		{
			scrollObject.css('border-radius', '0');
		}
		if($( "#scroll-shadow-thickness" ).val() > 0){
		scrollObject.css('box-shadow', '0px 0px '+$("#scroll-shadow-thickness").val()+'px '+$("#scroll-shadow-color").val());
		}
		else
		{
		scrollObject.css('box-shadow', 'none');
		}
	}
	
	if($( "#scroll-sidebar" ).prop( "checked" )){
		var styles = {
			'width' : $("#scroll-width").val()+"px",
			'height' : 'auto',
			'font-size' : $("#scroll-text-size").val()+"px",
			'color' : $("#scroll-text-color").val()
			};
		
		scrollObject.css(styles);
		
		if($( "#scroll-left" ).prop( "checked" )){
			scrollObject.css('left', '0');
			scrollObject.css('top', '0');
			scrollObject.css('bottom', '0');
			scrollObject.css('right', 'auto');
		}
		
		if($( "#scroll-right" ).prop( "checked" )){
			scrollObject.css('left', 'auto');
			scrollObject.css('top', '0');
			scrollObject.css('bottom', '0');
			scrollObject.css('right', '0');
		}
		
		var paddingTop = Math.floor($("#scroll-text-size").val()/2);
		var topBg = Math.floor(paddingTop+(paddingTop-imageSize/2)/2);
		$("#scroll-object div").css('margin', paddingTop+'px 0 0 '+imageSize+'px');
		if($( "#scroll-display-labels" ).prop( "checked" )){
		var paddingLeft = 'left';
		}
		else
		{
		var paddingLeft = Math.floor($("#scroll-width").val()/2-imageSize/2)+'px';
		}
		
		if($( "#scroll-transparent-bg" ).prop( "checked" )){
		scrollObject.css('background', 'transparent url(../wp-content/plugins/scroll-tool/img/up-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+') no-repeat '+paddingLeft+' '+topBg+'px');
		}
		else
		{
		scrollObject.css('background', $("#scroll-background-color").val()+' url(../wp-content/plugins/scroll-tool/img/up-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+') no-repeat '+paddingLeft+' '+topBg+'px');
		}
		if($( "#scroll-border-thickness" ).val() > 0){
			scrollObject.css('border', 'none');
			if($( "#scroll-left" ).prop( "checked")){
				scrollObject.css('border-right', $("#scroll-border-thickness").val()+'px '+$("#scroll-border-color").val()+' '+$("select#scroll-border-shape option:selected").val());
			}
			else
			{
				scrollObject.css('border-left', $("#scroll-border-thickness").val()+'px '+$("#scroll-border-color").val()+' '+$("select#scroll-border-shape option:selected").val());
			}
		}
		else
		{
			scrollObject.css('border', 'none');
		}
		if($( "#scroll-corners-radius" ).val() > 0){
			
			var curWidth = $( "#scroll-width" ).val();
			var curRadius;
			if(Number($("#scroll-corners-radius").val()) <= Number(curWidth)){
			curRadius = $("#scroll-corners-radius").val();
			}
			else
			{
			curRadius = curWidth;
			$("#scroll-corners-radius").val(curRadius).css('background-color', '#f0d528');
			}
			
			if($( "#scroll-left" ).prop( "checked")){
				scrollObject.css('border-radius', '0px '+curRadius+'px '+curRadius+'px 0px');
			}
			else
			{
				scrollObject.css('border-radius', curRadius+'px 0px 0px '+curRadius+'px');
			}
		}
		else
		{
			scrollObject.css('border-radius', '0');
		}
		if($( "#scroll-shadow-thickness" ).val() > 0){
		scrollObject.css('box-shadow', '0px 0px '+$("#scroll-shadow-thickness").val()+'px '+$("#scroll-shadow-color").val());
		}
		else
		{
		scrollObject.css('box-shadow', 'none');
		}
	}
		
		if($( "#scroll-display-labels" ).prop( "checked" )){
		$( "#scroll-object div" ).html($("#scroll-text-up").val());
		}
		else
		{
		$( "#scroll-object div" ).html('');
		$( "#scroll-object div" ).css('margin', '0');
		}
		
		if($("select#scroll-text-font option:selected").val()!=='0'){
			scrollObject.css('font-family', fonts[$("select#scroll-text-font option:selected").val()]);
		}
		else
		{
			scrollObject.css('font-family', 'inherit');
		}
	}
	buildScroll();
	var hideForMobile = boolVar('#scroll-hide-for-mobile');
	var animatedScroll = boolVar('#scroll-appearance');
	var animatedMotion = boolVar('#scroll-motion');
	var disableDown = boolVar('#scroll-disable-down');
	setOther(hideForMobile, animatedScroll, animatedMotion, disableDown);
	
	function boolVar(targetObj){
		if ($(targetObj).prop( "checked" ))
		return true;
		else
		return false;
	}
	
	$( "#scroll-text-size,#scroll-text-font,#scroll-border-shape" ).change(function() {
	buildScroll();
	});
	
	$( ".scroll-type" ).change(function() {

		$( ".scroll-height" ).toggleDisabled();
		$( "#scroll-left,#scroll-right,#scroll-leftbottom,#scroll-middlebottom,#scroll-rightbottom" ).removeAttr('checked').toggleDisabled();
		if($( "#scroll-button" ).prop( "checked" )){
			$( "#scroll-leftbottom" ).prop( "checked", true );
			$( ".scroll-left-indent,.scroll-bottom-indent" ).removeAttr('disabled');
		}
		else
		{
			$( "#scroll-left" ).prop( "checked", true );
			$( ".scroll-left-indent,.scroll-right-indent,.scroll-bottom-indent" ).attr('disabled', 'disabled');
		}
		buildScroll();

	});
	
	$( "#scroll-leftbottom" ).change(function() {
		$( ".scroll-left-indent,.scroll-right-indent,.scroll-bottom-indent" ).attr('disabled', 'disabled');
		$( ".scroll-left-indent,.scroll-bottom-indent" ).removeAttr('disabled');
		buildScroll();
	});
	
	$( "#scroll-rightbottom" ).change(function() {
		$( ".scroll-left-indent,.scroll-right-indent,.scroll-bottom-indent" ).attr('disabled', 'disabled');
		$( ".scroll-right-indent,.scroll-bottom-indent" ).removeAttr('disabled');
		buildScroll();
	});
		
	$( "#scroll-middlebottom" ).change(function() {
		$( ".scroll-left-indent,.scroll-right-indent,.scroll-bottom-indent" ).attr('disabled', 'disabled');
		$( ".scroll-bottom-indent" ).removeAttr('disabled');
		buildScroll();
	});
	
	$( "#scroll-display-labels" ).change(function() {
		if($(this).prop( "checked" )){
		$( "#scroll-text-up,#scroll-text-down,#scroll-text-size,#scroll-text-font,#scroll-text-color" ).removeAttr('disabled');
		}
		else
		{
		$( "#scroll-text-up,#scroll-text-down,#scroll-text-size,#scroll-text-font,#scroll-text-color" ).attr('disabled', 'disabled');
		}
		buildScroll();
	});
	
	$( "#scroll-transparent-bg" ).change(function() {
	$( "#scroll-background-color" ).toggleDisabled();
	buildScroll();
	});
	
	$( "input.scroll-button-arrow, #scroll-left, #scroll-right" ).change(function() {
		buildScroll();
	});
	
	$( "#scroll-width,#scroll-height,#scroll-left-indent,#scroll-bottom-indent,#scroll-right-indent,#scroll-border-thickness,#scroll-corners-radius,#scroll-shadow-thickness,#scroll-text-up" ).keyup(function() {
		buildScroll();
	});
	
	$( "#scroll-text-down" ).keyup(function() {
		$("#scroll-object div").html($(this).val());
	});
	
	$('#scroll-text-color, #scroll-background-color, #scroll-border-color, #scroll-shadow-color').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val('#'+hex);
		$(el).css('background-color', '#'+hex);
		$(el).ColorPickerHide();
		buildScroll();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
	
$( "#scroll-hide-for-mobile, #scroll-appearance, #scroll-motion, #scroll-disable-down" ).change(function() {
		var hideForMobile = boolVar('#scroll-hide-for-mobile');
		var animatedScroll = boolVar('#scroll-appearance');
		var animatedMotion = boolVar('#scroll-motion');
		var disableDown = boolVar('#scroll-disable-down');
		if($(this).attr('id') === 'scroll-hide-for-mobile' && $(this).prop( "checked" )){
			alert("Scroll tool will be hidden on frontend of site\nfor small screens (width less then 768 pixels).");
		}
		setOther(hideForMobile, animatedScroll, animatedMotion, disableDown);
	});

function setOther(hideForMobile, animatedScroll, animatedMotion, disableDown) {
		
		var scrollHeight;
		var lastPosition = 0;
		var downDirect = false;
		var isDown = true;
		var scrollPause = false;
		
		$( "#scroll-object" ).off('click mouseenter mouseleave');
		$(window).off('scroll');
		$('#scroll-object').stop().animate({'opacity':'1'});
		
		if(hideForMobile && $( window ).width() < 768){
		var showAdjScroll = false;
		}
		else
		{
		var showAdjScroll = true;
		}
		
	if(showAdjScroll){
		if(animatedScroll){
			$(window).scroll(function () {
			scrollHeight = $(document).scrollTop();
				if( scrollHeight > 30 && isDown ){
					$( "#scroll-object" ).stop();
					isDown = false;
					$( "#scroll-object" ).fadeTo('slow', 0.5);
				}
				if(scrollHeight > 30 && !scrollPause && !disableDown){
				downDirect = false;
				if($( "#scroll-display-labels" ).prop( "checked" ))
				$('#scroll-object div').html($('#scroll-text-up').val());
				$('#scroll-object').css('background-image', 'url(../wp-content/plugins/scroll-tool/img/up-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+')');
				}
				if( scrollHeight <= 30 && !isDown && disableDown ){
					$( "#scroll-object" ).stop();
					isDown = true;
					$( "#scroll-object" ).fadeOut('slow');
				}
			});
			}
			else
			{
			$(window).scroll(function () {
			scrollHeight = $(document).scrollTop();
				if( scrollHeight > 30 && isDown ){
					isDown = false;
					$( "#scroll-object" ).css('display', 'block');
				}
				if(scrollHeight > 30 && !scrollPause && !disableDown){
				downDirect = false;
				if($( "#scroll-display-labels" ).prop( "checked" ))
				$('#scroll-object div').html($('#scroll-text-up').val());
				$('#scroll-object').css('background-image', 'url(../wp-content/plugins/scroll-tool/img/up-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+')');
				}
				if( scrollHeight <= 30 && !isDown && disableDown ){
					isDown = true;
					$( "#scroll-object" ).css('display', 'none');
				}
			});
			}
		
		if(animatedScroll && !disableDown){
			
			$('#scroll-object').stop().animate({'opacity':'0.5'});
			
			$( "#scroll-object" ).mouseenter(function(){
				$('#scroll-object').stop().animate({'opacity':'1'});
			});
			$( "#scroll-object" ).mouseleave(function(){
				$('#scroll-object').stop().animate({'opacity':'0.5'});
			});
		}
		
		if(animatedScroll && disableDown){
			
			$('#scroll-object').stop().animate({'opacity':'0.5'});
			
			$( "#scroll-object" ).mouseenter(function(){
				if(scrollHeight > 30)
				$('#scroll-object').stop().animate({'opacity':'1'});
			});
			$( "#scroll-object" ).mouseleave(function(){
				if(scrollHeight > 30)
				$('#scroll-object').stop().animate({'opacity':'0.5'});
			});
		}
		
		if(animatedMotion){
			if(disableDown){
				$('#scroll-object').click(
					function (e) {
						$('html, body').animate({scrollTop: '0px'}, 800);
					}
				);
			}
			else
			{
				$('#scroll-object').click(
					function (e) {
						if(!downDirect){
						downDirect = true;
						if($( "#scroll-display-labels" ).prop( "checked" ))
						$('#scroll-object div').html($('#scroll-text-down').val());
						$('#scroll-object').css('background-image', 'url(../wp-content/plugins/scroll-tool/img/down-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+')');
						lastPosition = $(document).scrollTop();
						scrollPause = true;
						$('html, body').stop().animate({scrollTop: '0px'}, 800, function() {scrollPause = false;});
						}
						else
						{
						downDirect = false;
						if($( "#scroll-display-labels" ).prop( "checked" ))
						$('#scroll-object div').html($('#scroll-text-up').val());
						$('#scroll-object').css('background-image', 'url(../wp-content/plugins/scroll-tool/img/up-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+')');
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
				$('#scroll-object').click(
					function (e) {
						$( "#scroll-object" ).css('display', 'none');
						$('html, body').scrollTop(0);
					}
				);
			}
			else
			{
				$('#scroll-object').click(
					function (e) {
						if(!downDirect){
						downDirect = true;
						if($( "#scroll-display-labels" ).prop( "checked" ))
						$('#scroll-object div').html($('#scroll-text-down').val());
						$('#scroll-object').css('background-image', 'url(../wp-content/plugins/scroll-tool/img/down-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+')');
						lastPosition = $(document).scrollTop();
						scrollPause = true;
						$('html, body').scrollTop(0);
						scrollPause = false;
						}
						else
						{
						downDirect = false;
						if($( "#scroll-display-labels" ).prop( "checked" ))
						$('#scroll-object div').html($('#scroll-text-up').val());
						$('#scroll-object').css('background-image', 'url(../wp-content/plugins/scroll-tool/img/up-'+$("input[name='scroll_tool[button_arrow]']:checked").val()+ext+')');
						scrollPause = true;
						$('html, body').scrollTop(lastPosition);
						scrollPause = false;
						}
					}
				);
			}
		}
	}
}

});