
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
							<div class="inner inner--is-overlay">
								<% include InfoSlideBody %>
							</div>
						</div>
					<% else_if $MediaType == "Video" %>
						<div class="cell-bg">
							<div class="fullwidth-video">
								<video playsinline autoplay muted loop autoplay src="$BackgroundVideo.URL" id="vid-bg" class="ani-vid-fadein" style="opacity: 1;"></video>
							</div>
							<div class="inner inner--is-overlay">
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
 	<div class="container">
		<% if $Stories %>
			<% loop $Stories %>
				<% include StoryCardLarge %>
			<% end_loop %>
		<% else %>
			<p><%t Blog.NoPosts 'There are no posts' %></p>
		<% end_if %>
 	</div>
<% end_with %>

