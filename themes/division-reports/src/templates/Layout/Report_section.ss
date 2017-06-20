
<% with $CurrentSection %>
<% if $InfoSlides %>
	

	<div class="carousel__container">
		<% include SectionHeader %>
		<div class="carousel">
			<% loop $InfoSlides %>
				<div class="carousel-cell">
					<% if $MediaType == "Image" %>
						<div class="cell-bg" data-flickity-bg-lazyload="$BackgroundImage.CroppedFocusedImage(1500,900).URL">
							<div class="cell-screen"></div>
							<div class="inner">
								<% include InfoSlideBody %>
							</div>
						</div>
					<% else_if $MediaType == "Video" %>
						<div class="cell-bg">
							<div class="fullwidth-video">
								<video playsinline autoplay muted loop autoplay src="$BackgroundVideo.URL" id="vid-bg" class="ani-vid-fadein" style="opacity: 1;"></video>
							</div>
							<div class="inner">
								<% include InfoSlideBody %>
							</div>
						</div>
					<% end_if %>
				</div>
			<% end_loop %>
		</div>

	</div>
<% else %>
	
	<header class="header">
		<h1>$Title</h1>
	</header>

<% end_if %>


$BlockArea(BeforeContent)
	<h1>$Title Stories:</h1>
	<% loop $Stories %>
		<h2><a href="$Link">$Title</a></h2>
	<% end_loop %>
$BlockArea(AfterContent)
<% end_with %>

<h2>Other sections:</h2>
<% loop $Sections %>
	<h3><a href="$Link">$Title</a></h3>
<% end_loop %>

