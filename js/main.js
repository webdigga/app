// make sure the form is not submitted via ajax, this is because we are sending file data
$(document).bind("mobileinit", function(){
  $.mobile.ajaxEnabled = false;
});

$(document).ready(function() {
	/* add/remove file input */
	var photoCount = 1;
	$('.add-photo').live("click", function() {				
		$('.remove-photo').show();		
		$('<input type="file" name="file[]" id="file'+ photoCount +'" />').insertAfter('#file' + (photoCount-1)); 
		photoCount++;
	});	

	$('.remove-photo').live("click", function(){		
		if($(this).siblings('input').last().attr('id')==="file1") {
			$(this).siblings('input').last().remove();
			$('.remove-photo').hide();
			photoCount--;
		} else {
			$(this).siblings('input').last().remove();
			photoCount--;
		}		
	});
	
	// geolocation
	if (navigator.geolocation) {	
		var timeoutVal = 10 * 100 * 1000;
		navigator.geolocation.getCurrentPosition (
			displayPosition,
			displayError,
			{ 
			enableHighAccuracy: true,
			timeout:timeoutVal,
			maximumAge: 0
			}
		);
	} else {
		// make sure if geolocation is not supported we deal with location and weather
		displayError();
	}
	
	function displayPosition(position) {	
		latitude = position.coords.latitude;			
		longitude = position.coords.longitude;		
		$('input#geolocation').val(latitude+','+longitude);		
		longLatWeather = latitude + ',' + longitude;
		// get weather		
		var geoURL = 'http://api.wunderground.com/api/5306a3d8de591df9/geolookup/conditions/q/' + longLatWeather + '.json';	
		$.ajax({
			url:           geoURL,
			cache:         true,
			async:         false,
			dataType:      'jsonp',
			type:          'GET',
			success: function(data) {
				// grab weather data
				$('input#temperature').val(data.current_observation.temp_c);	
				$('input#weather').val(data.current_observation.weather);	
				$('input#wind').val(data.current_observation.wind_string);	
				$('input#visibility').val(data.current_observation.visibility_mi);	
				$('input#image').val(data.current_observation.icon_url);
				$('input#imagealt').val(data.current_observation.icon);
				// set the weather and location status to true as we should have hit the feed
				$('input#weather-status').val(true);
				$('input#location-status').val(true);
				
				
				
				
				
				
				
				// hide the h3 tag that explains we failed
				$('.geo-fail').hide();
				// remove the weather and locations select box as we got the info from the feed
				$('#weather-select').remove();
				
				$('#streetName').remove();
				$('#townName').remove();
				$('#country-select').remove();
			}
		});
	}	
	
	function displayError(error) {
	  var errors = { 
			1: 'Permission denied',
			2: 'Position unavailable',
			3: 'Request timeout'
	  };	  
		console.log("Error: " + errors[error.code]);	  
		// set the weather and location status to be false so the action page picks up the select box data instead of feed
		$('input#weather-status').val(false);
		$('input#location-status').val(false);		
	}	
	
	$('#sendMail').submit(function() {
		// Add class of error to all input fields that do not have value			
		$('input[type="file"], input[type="text"], input[type="checkbox"], input[type="tel"], textarea, select').each(function() {
			// checkboxes
			if($(this).parent().parent().hasClass('section-3')===true) {
				if($(this).is(':checked')) {				
					$(this).removeClass('error');
					$(this).addClass('success');
				} else {
					$(this).removeClass('success');
					$(this).addClass('error');
				}
				// we are going to add the style in jquery as no prev css selector				
				$('input[type="checkbox"]').prev().css('border', '1px solid #CCC');
				$('input[type="checkbox"].error').prev().css('border', '1px solid red');
				$(this).change(function(){
					if($(this).is(':checked')){
						$(this).removeClass('error');
						$(this).addClass('success');
						$(this).prev().css('border', '1px solid #CCC');
					}else{
						$(this).addClass('error');
						$(this).removeClass('success');
						$(this).prev().css('border', '1px solid red');
					}
				});
			} else if($(this).parent().parent().parent().hasClass('section-4')===true || $(this).parent().parent().parent().hasClass('section-4')===true) {
				if($(this).val()==="0") {
					$(this).removeClass('success');
					$(this).addClass('error');					
				}	
				// we are going to add the style in jquery as no prev css selector				
				$('#vehicle-select, #weather-select, #country-select').prev().css('color', '1px solid #222');
				$('#vehicle-select.error, #weather-select.error, #country-select.error').prev().css('color', 'red');	
				$(this).change(function(){
					if (!$(this).length) {
						$(this).addClass('error');
						$(this).removeClass('success');
						$(this).prev().css('color', 'red');
					} else {
						$(this).removeClass('error');
						$(this).addClass('success');
						$(this).prev().css('color', '#222');
					}	
				});
			} else {
				if($(this).val()==="") {	
					$(this).removeClass('success');
					$(this).addClass('error');					
				} else {
					$(this).removeClass('error');
					$(this).addClass('success');
				}
				$(this).focusout(function() {
					if($(this).val()==="") {
						$(this).removeClass('success');
						$(this).addClass('error');						
					} else {
						$(this).removeClass('error');
						$(this).addClass('success');
					}
				});
			}
		});		
		
		// check for errors
		if ($(this).find('.error').length > 0) {		
			var getPageId = $('.error:eq(0)').parents('div[data-role="page"]').attr('id');
			$.mobile.changePage($('#'+getPageId), {transition:"none"});
			return false;
		} else {
			// show the loading gif
			$('.ui-icon-loading').show();
			return true;
		}
	});
});