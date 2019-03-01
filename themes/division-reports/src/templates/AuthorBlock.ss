<div class="author__block">
	<%-- <% if $Title %><h2>$Title</h2><% end_if %> --%>
	<% with $CurrentPage %>
		<div class="row">
		<% cached %>
		<% loop $Authors %>
			<div class="col-lg-4 col-6 col-sm-3">
				<a href="$URL" class="author clearfix">
					<% if $BlogProfileImage %>
						<img src="$BlogProfileImage.FocusFill(200,200).URL" class="author__img" />
					<% else %>
						<img src="{$ThemeDir}/src/images/placeholder-staff.png" class="author__img" />
						
					<% end_if %>
					<p class="author__name">$FirstName $Surname</p>
				</a>
			</div>
		<% end_loop %>
		<% end_cached %>
		</div>
	<% end_with %>
</div>