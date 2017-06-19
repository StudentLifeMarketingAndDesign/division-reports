<nav class="nav" id="nav">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<a href="$BaseUrl"><% include DslLogoSvg %></a><br />
				<span class="nav__report-title">Annual Report 2017</span>
			</div>
			<div class="col-sm-3 offset-sm-3 col-md-2 offset-md-6">
				<div class="nav__explore">
					<span class="nav__item" id="handle">Explore</span>
					<div class="nav__menu-icon"></div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<nav data-navigation-handle="#handle" data-navigation-content="#content">
					<ul>
					<% loop $Menu(1) %>
					    <li><a href="$Link">$MenuTitle</a></li>
					<% end_loop %>
					</ul>
				</nav>
			</div>
		</div>

	</div>
</nav>