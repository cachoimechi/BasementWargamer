$(document).ready(function() {
	
	$('.toggle').click(function() {
		$(this).parent().next().toggle('slow');
		return false;
	});
	
	$(".checkbox").click(function(){
  		if($(this).is(":checked")){
  			$(this).next('input').attr("disabled", false);
  		} else {
  			$(this).next('input').attr("disabled", true)
  		}
	});
	
	$("#pageflip").hover(function() { //On hover...
		$("#pageflip img , .msg_block").stop()
			.animate({ //Animate and expand the image and the msg_block (Width + height)
				width: '307px',
				height: '319px'
			}, 500);
		} , function() {
		$("#pageflip img").stop() //On hover out, go back to original size 50x52
			.animate({
				width: '50px',
				height: '52px'
			}, 220);
		$(".msg_block").stop() //On hover out, go back to original size 50x50
			.animate({
				width: '50px',
				height: '50px'
			}, 200); //Note this one retracts a bit faster (to prevent glitching in IE)
	});


});