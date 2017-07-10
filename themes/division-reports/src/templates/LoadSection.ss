<% if $Stories %>
	<ul class="story-filter__list"> 
		<% loop $Stories %>
			<% include StoryCardLarge %>
		<% end_loop %>
	</ul>
<% end_if %>

