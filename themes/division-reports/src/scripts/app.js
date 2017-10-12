//*********************
//******** Nav ********
//*********************

$("nav").navigation({
	customClass    : "",
	gravity        : "left",
	label          : true,
	labels: {
		closed     : "Explore",
		open       : "Close"
	},
	maxWidth       : "9000px",
	theme          : "fs-light",
	type           : "toggle"
});

$("nav").on("open.navigation", function() {
		$(".nav__menu-icon").addClass("nav__menu-icon--menu-is-active");
}).on("close.navigation", function() {
		$(".nav__menu-icon").removeClass("nav__menu-icon--menu-is-active");
});
$('#archive-dropdown').on('change', function(){
    location.href = $(this).val();
});
//**********************
//****** Carousel ******
//**********************

var $carousel = $('.carousel').flickity({
	imagesLoaded: true,
	percentPosition: false,
	selectedAttraction: 0.015,
	friction: 0.3,
	prevNextButtons: false,
	draggable: true,
	autoPlay: true,
	autoPlay: 8000,
	pauseAutoPlayOnHover: false,
	bgLazyLoad: true,
	pageDots: true
});

var $imgs = $carousel.find('.carousel-cell .cell-bg');
// get transform property
var docStyle = document.documentElement.style;
var transformProp = typeof docStyle.transform == 'string' ?
	'transform' : 'WebkitTransform';
// get Flickity instance
var flkty = $carousel.data('flickity');

$carousel.on( 'scroll.flickity', function() {
	flkty.slides.forEach( function( slide, i ) {
		var img = $imgs[i];
		var x = ( slide.target + flkty.x ) * -1/3;
		img.style[ transformProp ] = 'translateX(' + x  + 'px)';
	});
});

$('.carousel-nav-cell').click(function() {
	flkty.stopPlayer();
});

//**********************
//****** Count up ******
//**********************

var countOptions = {
  useEasing : true,
  useGrouping : true,
  separator : ',',
  decimal : '.',
};


var counts = [];

$('.count__container').each(
  function(){
  	new Waypoint({
	  element:  this,
	  offset: 'bottom-in-view',
	  handler: countCreator
	});
  }
);

function countCreator(index){

	var countId = $( this.element ).attr("data-count-id");
	var count = document.getElementById(countId);
    counts[index] = new CountUp(
      $( count ).attr("id"),
      0, //start at 0
      $( count ).attr("data-value"),
      0, //number of decimals
      2.5, //speed/duration
      countOptions
    );

    counts[index].start();

}
//*********************
//****** Circles ******
//*********************

var circles = [];
var circleWaypoints = [];
//Use an element with the class "circle" and the attribute 'data-value="X"' in the markup
$('.circle__container').each(
  function(){
  	new Waypoint({
	  element:  this,
	  offset: 'bottom-in-view',
	  handler: circleCreator
	});
  }
);

function circleCreator(index) {
	var circleId = $( this.element ).attr("data-circle-id");
	var circle = document.getElementById(circleId);

	if($(circle).attr("data-active") != "true"){
		circles.push (Circles.create({
		    id:                  circleId,
		    radius:              100,
		    value:               $(circle).attr("data-value"),
		    maxValue:            100,
		    width:               10,
		    text:                function(value){return value + '%';},
		    colors:              ['#565655', '#f0be1e'],
		    duration:            2000,
		    wrpClass:            'circles-wrp',
		    textClass:           'circles-text',
		    valueStrokeClass:    'circles-valueStroke',
		    maxValueStrokeClass: 'circles-maxValueStroke',
		    styleWrapper:        true,
		    styleText:           true
		}));

		$(circle).attr("data-active", true);
	}
}
//*********************
//*********************
//*********************

function sectionList(str) {
	var xhttp;
	var currentUrl = window.location.href;
	if (str == "") {
		document.getElementById("filter-list").innerHTML = "";
		return;
	}
	else{
		xhttp = new XMLHttpRequest();
		$("#filter-list").show();
		$("#pagination").hide();
		$("#default-list").hide();
		$("#search-input").val("");
		document.getElementById("filter-list").innerHTML = '<p class="text-center"><img src="themes/division-reports/dist/images/loader.gif" /></p>';
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("filter-list").innerHTML = xhttp.responseText;
				$("#tag-dropdown").val(0).removeAttr("selected");
			}
		};
		xhttp.open("GET", currentUrl + "/loadSection/"+str, true);
		xhttp.send();
	}

}

function tagList(str) {
	var xhttp;
	var currentUrl = window.location.href;
	if(str == 0){
		resetList();
		return;
	}
	if (str == "") {
		document.getElementById("filter-list").innerHTML = "";
		return;
	}
	else{
		$("#filter-list").show();
		$("#pagination").hide();
		$("#default-list").hide();
		$("#search-input").val("");
		document.getElementById("filter-list").innerHTML = '<p class="text-center"><img src="themes/division-reports/dist/images/loader.gif" /></p>';
		xhttp = new XMLHttpRequest();
		// $("#section-dropdown").reset();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("filter-list").innerHTML = xhttp.responseText;
				$("#section-dropdown").val(0).removeAttr("selected");
			}
		};
		xhttp.open("GET", currentUrl + "/loadTag/"+str, true);
		xhttp.send();
	}

}

function searchList(str){
	if(str.length < 4){
		return;
	}
	var xhttp;
	var currentUrl = window.location.href;
	if (str == "") {
		document.getElementById("filter-list").innerHTML = "";
		return;
	}
	else{
		$("#filter-list").show();
		$("#pagination").hide();
		$("#default-list").hide();
		document.getElementById("filter-list").innerHTML = '<p class="text-center"><img src="themes/division-reports/dist/images/loader.gif" /></p>';
		xhttp = new XMLHttpRequest();
		// $("#section-dropdown").reset();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("filter-list").innerHTML = xhttp.responseText;
				$("#section-dropdown").val(0).removeAttr("selected");
				$("#tag-dropdown").val(0).removeAttr("selected");
			}
		};
		xhttp.open("GET", currentUrl + "/loadSearch/"+str, true);
		xhttp.send();
	}

}

function resetList(){
	$("#pagination").show();
	$("#default-list").show();
	$("#filter-list").hide();
}

/*-------------------------------------------------*/
/*-------------------------------------------------*/
// Background Video
/*-------------------------------------------------*/
/*-------------------------------------------------*/
$('.backgroundvideo__link').click(function(e){
	var that = $(this);
	var video = that.data('video');
	var width = $('img', that).width();
	var height = $('img', that).height();
	that.parent().addClass('on');
	that.parent().prepend('<div class="flex-video widescreen"><iframe src="https://www.youtube.com/embed/' + video + '?rel=0&autoplay=1" width="' + width + '" height="' + height + '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>');
	that.hide();
	e.preventDefault();
});


//***********************
//****** FitVids ********
//***********************
$(".content-inner").fitVids();

//***********************
//*** Image Galleries ***
//***********************

$(document).ready(function() {
	$('.galleryblock').each(function() { // the containers for all your galleries
	    $(this).magnificPopup({
	        delegate: 'a', // the selector for gallery item
	        type: 'image',
	        gallery: {
	          enabled:true
	        },

			callbacks: {
			    open: function() {
			      $('html').addClass('modal');
			    },
			    close: function() {
			      // Wait until overflow:hidden has been removed from the html tag
			      setTimeout(function() {
			        $('html').removeClass('modal');
			      }, 100)
			    }
			}


	    });
	});

});
//************************
//****** Tilt Cards ******
//************************
(function() {
	var tiltSettings = [
	{},
	{
		movement: {
			imgWrapper : {
				translation : {x: 10, y: 10, z: 30},
				rotation : {x: 0, y: -10, z: 0},
				reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
			},
			lines : {
				translation : {x: 10, y: 10, z: [0,70]},
				rotation : {x: 0, y: 0, z: -2},
				reverseAnimation : {duration : 2000, easing : 'easeOutExpo'}
			},
			caption : {
				rotation : {x: 0, y: 0, z: 2},
				reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
			},
			overlay : {
				translation : {x: 10, y: -10, z: 0},
				rotation : {x: 0, y: 0, z: 2},
				reverseAnimation : {duration : 2000, easing : 'easeOutExpo'}
			},
			shine : {
				translation : {x: 100, y: 100, z: 0},
				reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
			}
		}
	},
	{
		movement: {
			imgWrapper : {
				rotation : {x: -5, y: 10, z: 0},
				reverseAnimation : {duration : 900, easing : 'easeOutCubic'}
			},
			caption : {
				translation : {x: 30, y: 30, z: [0,40]},
				rotation : {x: [0,15], y: 0, z: 0},
				reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
			},
			overlay : {
				translation : {x: 10, y: 10, z: [0,20]},
				reverseAnimation : {duration : 1000, easing : 'easeOutExpo'}
			},
			shine : {
				translation : {x: 100, y: 100, z: 0},
				reverseAnimation : {duration : 900, easing : 'easeOutCubic'}
			}
		}
	},
	{
		movement: {
			imgWrapper : {
				rotation : {x: -5, y: 10, z: 0},
				reverseAnimation : {duration : 50, easing : 'easeOutQuad'}
			},
			caption : {
				translation : {x: 20, y: 20, z: 0},
				reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
			},
			overlay : {
				translation : {x: 5, y: -5, z: 0},
				rotation : {x: 0, y: 0, z: 6},
				reverseAnimation : {duration : 1000, easing : 'easeOutQuad'}
			},
			shine : {
				translation : {x: 50, y: 50, z: 0},
				reverseAnimation : {duration : 50, easing : 'easeOutQuad'}
			}
		}
	},
	{
		movement: {
			imgWrapper : {
				translation : {x: 0, y: -8, z: 0},
				rotation : {x: 3, y: 3, z: 0},
				reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
			},
			lines : {
				translation : {x: 15, y: 15, z: [0,15]},
				reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
			},
			overlay : {
				translation : {x: 0, y: 8, z: 0},
				reverseAnimation : {duration : 600, easing : 'easeOutExpo'}
			},
			caption : {
				translation : {x: 10, y: -15, z: 0},
				reverseAnimation : {duration : 900, easing : 'easeOutExpo'}
			},
			shine : {
				translation : {x: 50, y: 50, z: 0},
				reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
			}
		}
	},
	{
		movement: {
			lines : {
				translation : {x: -5, y: 5, z: 0},
				reverseAnimation : {duration : 1000, easing : 'easeOutExpo'}
			},
			caption : {
				translation : {x: 15, y: 15, z: 0},
				rotation : {x: 0, y: 0, z: 3},
				reverseAnimation : {duration : 1500, easing : 'easeOutElastic', elasticity : 700}
			},
			overlay : {
				translation : {x: 15, y: -15, z: 0},
				reverseAnimation : {duration : 500,easing : 'easeOutExpo'}
			},
			shine : {
				translation : {x: 50, y: 50, z: 0},
				reverseAnimation : {duration : 500, easing : 'easeOutExpo'}
			}
		}
	},
	{
		movement: {
			imgWrapper : {
				translation : {x: 5, y: 5, z: 0},
				reverseAnimation : {duration : 800, easing : 'easeOutQuart'}
			},
			caption : {
				translation : {x: 10, y: 10, z: [0,50]},
				reverseAnimation : {duration : 1000, easing : 'easeOutQuart'}
			},
			shine : {
				translation : {x: 50, y: 50, z: 0},
				reverseAnimation : {duration : 800, easing : 'easeOutQuart'}
			}
		}
	},
	{
		movement: {
			lines : {
				translation : {x: 40, y: 40, z: 0},
				reverseAnimation : {duration : 1500, easing : 'easeOutElastic'}
			},
			caption : {
				translation : {x: 20, y: 20, z: 0},
				rotation : {x: 0, y: 0, z: -5},
				reverseAnimation : {duration : 1000, easing : 'easeOutExpo'}
			},
			overlay : {
				translation : {x: -30, y: -30, z: 0},
				rotation : {x: 0, y: 0, z: 3},
				reverseAnimation : {duration : 750, easing : 'easeOutExpo'}
			},
			shine : {
				translation : {x: 100, y: 100, z: 0},
				reverseAnimation : {duration : 750, easing : 'easeOutExpo'}
			}
		}
	}];

	function init() {
		var idx = 0;
		[].slice.call(document.querySelectorAll('a.tilter')).forEach(function(el, pos) {
			idx = pos%2 === 0 ? idx+1 : idx;
			new TiltFx(el, tiltSettings[idx-1]);
		});
	}
	init();
	// Preload all images.
	// imagesLoaded(document.querySelector('main'), function() {
	// 	document.body.classList.remove('loading');

	// });

	// REMOVE THIS!
	// For Demo purposes only. Prevent the click event.
	[].slice.call(document.querySelectorAll('a[href="#"]')).forEach(function(el) {
		el.addEventListener('click', function(ev) { ev.preventDefault(); });
	});


})();