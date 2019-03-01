<% if $GalleryImages %>
	<div class="galleryblock">
		<% if $Title %><h3>$Title</h3><% end_if %>
		<div class="row">
			<% loop $GalleryImages %>
				<div class="col-6 col-md-4">
					<a href="$SetWidth(1200).URL">
						<img src="$FocusFill(200,200).URL" alt="">
					</a>
				</div>
			<% end_loop %>
		</div>
	</div>
<% end_if %>
