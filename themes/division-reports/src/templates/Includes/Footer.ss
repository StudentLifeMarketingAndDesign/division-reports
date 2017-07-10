<footer class="footer clearfix" role="contentinfo">
	<div class="row">
		<div class="footer-info__container">
			<div class="medium-6 large-5 columns">
				<a href="$BaseUrl"><% include DslLogoStackedSvg %></a>
					<p class="footer-info--text">The Division of Student Life fosters student success by creating and promoting inclusive educationally purposeful services and activities within and beyond the classroom.</p>
			</div>
		</div>
		<div class="footer-link__container">
			<div class="small-6 columns">
				<ul class="border-list" id="col">
					<% loop $Sections %>
						<li><a href="$Link" target="_blank">$Title</a></li>
					<% end_loop %>
				</ul>
			</div>
		</div>
	</div>
	<div class="md-bar row">
		<div class="small-12 columns">
			<section>
				<p>
				&copy; $Now.Year <span>The University of Iowa. All Rights Reserved. Privacy Information </span><span>&#124;</span> <span>Created by </span>
				<a href="http://md.studentlife.uiowa.edu/" target="_blank"><img src="{$ThemeDir}/src/images/md.png" class="md-bar--logo b-lazy lazy unveil" alt="Marketing and Design Logo" /></a>
				</p>
			</section>
		</div>
	</div>
</footer>