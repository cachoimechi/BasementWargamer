/* Author: Adam Krone */
$(function() {
	
	//Social Media Mouseovers
	$('#youtube').mouseover(function() {
		$('#yt_img').attr("src", "img/youtube.png");
		$('#yt_span').css("color", "white");
	}).mouseout(function() {
		$('#yt_img').attr("src", "img/youtube_bw.png");
		$('#yt_span').css("color", "#666");
	});
	
	$('#twitter').mouseover(function() {
		$('#tw_img').attr("src", "img/twitter-2.png");
	}).mouseout(function() {
		$('#tw_img').attr("src", "img/twitter-2_bw.png");
	});
	
	$('#facebook').mouseover(function() {
		$('#fb_img').attr("src", "img/facebook.png");
	}).mouseout(function() {
		$('#fb_img').attr("src", "img/facebook_bw.png");
	});
	
	//Slider
	var current = 0,
	     currentSlide = 1,
		totalSlides = $('#slider li').length;
	
	$('#arrowright').click(function(event) {
		event = event || window.event;
		event.preventDefault();
		currentSlide++;
		current -= 600;
		
		if(currentSlide>totalSlides) {
			current = 0;
			currentSlide = 1;
		}
		
		$('#slider').animate({"left" : current + "px"}, "slow");
	});
	
	$('#arrowleft').click(function(event) {
		event = event || window.event;
		event.preventDefault();
		if(currentSlide === 1) {
			current -= 600 * (totalSlides -1);
			currentSlide = totalSlides;
		} else {	
			currentSlide--;
			current += 600;
		}
		
		$('#slider').animate({"left" : current + "px"}, "slow");
	});
	
});






















