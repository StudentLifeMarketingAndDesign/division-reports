
<% with $CurrentSection %>
	<% if $InfoSlides %>
		<% if $InfoSlides.Count > 1 %><div class="carousel"><% end_if %>

			<% loop $InfoSlides %>

				<div class="infoslide" <% if $MediaType == "Image" %>style="background-image: url($BackgroundImage.CroppedFocusedImage(1500,900).URL"<% end_if %>>

					<% if $MediaType == "Video" %>
						<div class="fullwidth-video">
							<video playsinline autoplay muted loop autoplay src="$BackgroundVideo.URL" id="vid-bg" class="ani-vid-fadein" style="opacity: 1;"></video>
						</div>
					<% end_if %>

					<div class="infoslide__body">
						<h1 class="infoslide__title">$Up.Title</h1>
						<% include InfoSlideBody %>
						<% if $ButtonLink %>
							<div class="infoslide__btnwrap">
								<a href="$ButtonLink" class="infoslide__btn">$ButtonTitle</a>
							</div>
						<% end_if %>
					</div>

				</div>
			<% end_loop %>

		<% if $InfoSlides.Count > 1 %></div><% end_if %>

	<% end_if %>

	<br />
 	<div class="container">
 		<% if $Content %>
 			<div class="row">
 				<div class="col-lg-6 offset-lg-3">
 					$BlockArea(BeforeContent)
					<div class="content-inner">
						$Content
					</div>
					$BlockArea(AfterContent)
				</div>
			</div>
 		<% end_if %>
 		<br />
	</div>
	<% if $Stories %>
		<div class="storycards">
			<div class="container">
				<div class="row">
					<div class="col">
						<h4 class="storycards__heading">Stories from $Title</h4>
					</div>
				</div>
				<% loop $Stories %>
					<% include StoryCardLarge %>
				<% end_loop %>
			</div>
		</div>
	<% else %>


	<% end_if %>
<% end_with %>

