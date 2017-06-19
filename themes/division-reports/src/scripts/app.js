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