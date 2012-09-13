var latitude, longitude, long, lat, longLatWeather;			
var count = 0;
var countVal = 0;
var countSelect = 0;
window.now=1;

$(document).ready(function() {

	$('input#phoneNumber, input#topPneNumber').keydown(function(e) {
		var a=[8,9,13,16,17,18,20,27,35,36,37,38,39,40,45,46,91,92];
		var k = e.which;
		
		for (i = 48; i < 58; i++)
			a.push(i);
		for (i = 96; i < 106; i++)
			a.push(i);
		
		if (!(a.indexOf(k)>=0))
			e.preventDefault();		
	});	
	
	/* mobile swipe code */		
	function checkLights () {				
		count = 0;
		countVal = 0;
		countSelect = 0;
		// if we are ion the 4th tab, we want to be counting the val of the select boxes		
		if (window.now===4) {
			$('#pg'+ window.now +' select').each(function() {
				count++;
				if($(this).find('option:selected').val()!=0) {
					countVal++;
				}		
			});
		} else {		
			// else count the input fields		
			$('#pg'+ window.now +' input:visible, #pg'+ window.now +' textarea').each(function() {		
				// make sure we are not counting the submit button
				if ($(this).attr('type')!='submit') {					
					count++;
					if(window.now===3) {						
						if($(this).is(':checked')) {
							countVal++;
						}								
					} else {						
						if($(this).val()!=="") {
							countVal++;
						}
					}	
				}
				
				
			});
		}			
	}	
	function changeLights () {			
		if (countVal === count) {
			$('.traffic-lights .holder' + window.now).removeClass('red amber green').addClass('green').children().removeClass('red amber green red-light amber-light green-light').addClass('green green-light');
		} else if (countVal < count && countVal > 0) {
			$('.traffic-lights .holder' + window.now).removeClass('red amber green').addClass('amber').children().removeClass('red amber green red-light amber-light green-light').addClass('amber amber-light');
		} else {
			$('.traffic-lights .holder' + window.now).removeClass('red amber green').addClass('red').children().removeClass('red amber green red-light amber-light green-light').addClass('red red-light');
		}
	}
	
	var swipeLeft = function(event) { 
		checkLights();					
		changeLights();
		// if we are the last page, do not animate
		if (window.now!=4) {
			window.now++;
			$('#container').animate({				
				width: "400%",
				right: "+=100%"
			}, "slow");	
		}
		//event.stopPropagation();
	}	
	
	var swipeRight =  function(event) {		
		checkLights();					
		changeLights();
		// if we are the first page, do not animate
		if (window.now!=1) {
			window.now--;
			$('#container').animate({				
				width: "400%",
				right: "-=100%"
			}, "slow");	
		}
		//event.stopPropagation();
	}
	
	var photoCount = 1;
	$('.add-photo').live("click", function() {		
		$('.remove-photo').show();		
		$('<input type="file" name="file[]" id="file'+ photoCount +'" size="20" />').insertAfter('#file' + (photoCount-1)); 
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
		alert("Geolocation is not supported by this browser");
	}
	
	function displayPosition(position) {		
		latitude = position.coords.latitude;			
		longitude = position.coords.longitude;		
		$('input#geolocation').val(latitude+','+longitude);		
		longLatWeather = latitude + ',' + longitude;
		
		console.log(longLatWeather);

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
	  // here we need to provide an option for the weather dropdown  
	  
	}
	
	$('#sendMail').submit(function() {
		// Loop through traffic lights until you find red light class, return pg number and break and return false
		var lightClass;
		$('.formSectionFour .traffic-lights > div.red, .formSectionFour .traffic-lights > div.amber').each(function() {
			lightClass = $(this).attr('class').replace('light-holder','').replace('red','').replace('','').replace('amber','').replace('green','').replace('holder','').replace(/^\s\s*/, '').replace(/\s\s*$/, '');
			if(lightClass != "") {				
				return false;
			}
		});
		// Add class of error to all input fields that do not have value
		$('input, textarea, select').each(function() {			
		    if($(this).parents('.formSection').hasClass('formSectionThree')===true) {
				if($(this).is(':checked')) {				
				    $(this).removeClass('error');
					$(this).addClass('success');					
				} else {				
					$(this).removeClass('success');
					$(this).addClass('error');
				}
			} else if($(this).parents('.formSection').hasClass('formSectionFour')===true) {
				if($(this).val()==="0") {
					$(this).removeClass('success');
					$(this).addClass('error');					
				}
			
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
		
		// change the traffic lights on the last page		
		// if we are ion the 4th tab, we want to be counting the val of the select boxes		
		if (window.now===4) {
			$('#pg'+ window.now +' select').each(function() {
				count++;
				if($(this).find('option:selected').val()!=0) {
					countVal++;
				}		
			});
			checkLights();	
			changeLights();
		}
		// Animate container to relevant pg number	
		window.now = lightClass;		
		switch (lightClass) {
			case "1":
				var animatePercent = "-=300%";
			break;
			case "2":
				var animatePercent = "-=200%";				
			break;
			case "3":
				var animatePercent = "-=100%";				
			break;
			case "4":
				var animatePercent = "0%";				
			break;	
		}
		$('#container').animate({				
			width: "400%",
			right: animatePercent
		}, "slow");
		
		// if the count of red classes is nil then we want to serialize form data and ajax to submit php
		var redAmberLightCount = 0;
		$('.formSectionFour .traffic-lights > div.red, .formSectionFour .traffic-lights > div.amber').each(function() {
			redAmberLightCount++;		
		});		
		
		if (redAmberLightCount===0) {		
			return true;	
			// Return success message inside pg4 container-padding			
			
		} else {
			console.log('error');
			return false;
		}	
		
	});	
	
	$('#container').on('swipeleft', function(e){swipeLeft(e);}).on('swiperight', function(e){swipeRight(e);});	
	
	// when the lights are clicked, we need to naviagte to that page and change the lights
	$('.light-holder').on("click", function() {
		var lightNumber = $(this).children().text();		
		// WE NEED THIS TO BE WHERE WE HAVE JUST COME FROM AND NOT WHERE WE ARE GOING		
		var previousCheck = $('#pg' + window.now + ' .light-selected').children().text();		
		
		window.now = parseInt(previousCheck);
		
		
		console.log("window now typeof - " + typeof window.now);
		
		console.log("window from where we clicked - " + window.now);
		
		
		checkLights();					
		changeLights();	
		window.now = parseInt(lightNumber);
		
		console.log("the new window - " + window.now);
		
		lightNumber = lightNumber - 1;
		lightNumber = lightNumber += "00%";		
		$('#container').animate({				
			width: "400%",
			right: lightNumber
		}, "slow");
	});
	
	
	
	
});