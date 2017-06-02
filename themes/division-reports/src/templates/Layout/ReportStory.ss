<div class="">
	<article>
		<h1>$Title</h1>

		<% if $FeaturedImage %>
			<p class="">$FeaturedImage.setWidth(795)</p>
		<% end_if %>

		<div class="">$Content</div>

		<% include EntryMeta %>
	</article>

	$Form
	$CommentsForm
</div>

