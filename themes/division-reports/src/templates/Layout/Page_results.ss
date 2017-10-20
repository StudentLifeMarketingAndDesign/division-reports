<div class="container header__container">
	<div class="row">
		<article class="col-lg-10 offset-lg-1 text-center" role="main">
			<h1 class="header__page-title">$Title</h1>
			<% if $Query %>
				<p>You searched for &quot;{$Query}&quot;</p>
				<% if $Results %>
					<% loop $Results %>
						<% include StoryCardLarge %>
					<% end_loop %>
					$Form			
					<% with $PaginatedList %>
						<% include Pagination %>
					<% end_with %>
				<% else %>
					<p>Sorry, your search query did not return any results.</p>
				<% end_if %>
			<% else %>
				<p>No search term specified. Please enter a search term below:</p>
				$SearchForm
				<hr />
			<% end_if %>
		</article>
	</div>
</div>
