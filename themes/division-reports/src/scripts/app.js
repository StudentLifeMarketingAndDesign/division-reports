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
var demo = new CountUp("stat1", 0, 3746, 0, 2.5, countOptions);
var demo2 = new CountUp("stat2", 0, 562, 0, 2.5, countOptions);
demo.start();
demo2.start();


//*********************
//****** Circles ******
//*********************

var myCircle = Circles.create({
  id:                  'circles-1',
  radius:              100,
  value:               84,
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
});

var myCircle2 = Circles.create({
  id:                  'circles-2',
  radius:              100,
  value:               81,
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
});