<div class="cell-text">
	<% if $LayoutType == "ArbitraryStatsHTML" %>
		$ArbitraryStatsHTML
	<% else %>
		<div class="container info-slide__body">
			<div class="info-slide__section info-slide__section--border-bottom info-slide__section--margin-bottom">
				<div class="row">
					<div class="col">
						<h2 class="info-slide__heading">A few facts about our department for 2017</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col info-slide__section info-slide__section--padding-right">
					<div class="row row-eq-height">
						<div class="col info-slide__section">
							<p><span class="stat__num counter" id="stat1" data-count="2314"></span> <span class="stat__label">Appointments</span></p>
							<p class="stat__caption">Including 321 primary care, 455 psychiatry, 228 in gynecology and 743 in nursing.</p>
						</div>
					</div>
					<div class="row row-eq-height">
						<div class="col info-slide__section info-slide__section--border-top">
							<p><span class="stat__num counter" id="stat2" data-count="2314"></span> <span class="stat__label">Visits</span></p>
							<p class="stat__caption">Including 321 primary care, 455 psychiatry, 228 in gynecology and 743 in nursing.</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="row row-eq-height">
						<div class="col info-slide__section info-slide__section--border-left info-slide__section--with-padding">
							<div class="circle" id="circles-1"></div>
							<p>84% of patients who report being satisfied with their visit overall</p>
						</div>
						<div class="col info-slide__section info-slide__section--border-left info-slide__section--with-padding">
							<div class="circle" id="circles-2"></div>
							<p>81% of patients who report being satisfied with their visit overall</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<% end_if %>

	<% if $ButtonLink %>
		<a href="$ButtonLink" target="_blank" class="cell-btn">$ButtonText</a>
	<% end_if %>
</div>