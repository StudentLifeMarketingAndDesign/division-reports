
<% if $Pages %>
<ul class="story-filter__list"> 
	<% loop $Pages %>
		<% include StoryCardLarge %>
	<% end_loop %>
</ul>
<% else %>
	<p class="text-center">No stories filed under "{$Query}."</p>

<% end_if %>
<p><button onclick="resetList()">Reset search</button></p>
