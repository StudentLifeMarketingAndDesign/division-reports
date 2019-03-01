<div class="keystatistics" <% if $Image %>style="background-image: url($Image.FocusFill(1500,900).URL"<% end_if %>>
	<div class="keystatistics__container container">
		<% if $Heading %>
			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-lg-8 offset-lg-2">
					<h2 class="keystatistics__heading">$Heading</h2>
				</div>
			</div>
		<% end_if %>
		<div class="row">
			<% if $Stat1 %>
				<div class="col-md-4">
					<div class="keystatistics__stat">
						<div class="keystatistics__num">
							<span>$Stat1</span>
						</div>
						<div class="keystatistics__label">
							<p>$StatLabel1</p>
						</div>
					</div>
				</div>
			<% end_if %>
			<% if $Stat2 %>
				<div class="col-md-4">
					<div class="keystatistics__stat">
						<div class="keystatistics__num">
							<span>$Stat2</span>
						</div>
						<div class="keystatistics__label">
							<p>$StatLabel2</p>
						</div>
					</div>
				</div>
			<% end_if %>
			<% if $Stat3 %>
				<div class="col-md-4">
					<div class="keystatistics__stat">
						<div class="keystatistics__num">
							<span>$Stat3</span>
						</div>
						<div class="keystatistics__label">
							<p>$StatLabel3</p>
						</div>
					</div>
				</div>
			<% end_if %>
		</div>

	</div>
</div>