

		<article>
			<div class="container">
				<header class="header text-center">
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<h1>
							<% if $ArchiveYear %>
								<%t Blog.Archive 'Archive' %>:
								<% if $ArchiveDay %>
									$ArchiveDate.Nice
								<% else_if $ArchiveMonth %>
									$ArchiveDate.format('F, Y')
								<% else %>
									$ArchiveDate.format('Y')
								<% end_if %>
							<% else_if $CurrentTag %>
								<%t Blog.Tag 'Tag' %>: $CurrentTag.Title
							<% else_if $CurrentCategory %>
								<%t Blog.Category 'Category' %>: $CurrentCategory.Title
							<% else %>
								Featured Stories
							<% end_if %>
							</h1>

							<%-- <div class="header__intro summary">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed est vel nunc iaculis tempus quis quis urna. Curabitur scelerisque hendrerit mauris, id pellentesque metus maximus vitae.</p>
							</div> --%>
						</div>
					</div>
				</header>
			</div>
		</header>
	</div>

	<% if not $CurrentTag %>
		<% with $Featured %>
		<div class="story-tile__container">
			<div class="row no-gutters">
				<div class="col-lg-8">
					<% with $Story1 %>
						<a href="$Link" <% if $FeaturedVideo %>style="background-image: url('http://img.youtube.com/vi/$FeaturedVideo/maxresdefault.jpg')"<% else_if $FeaturedImage %>style="background-image: url($FeaturedImage.FocusFillMax(1080,720).URL"<% end_if %> class="story-tile story-tile--large">
							<div class="story-tile__header story-tile__header--large">
								<% if $Sections %>
									<span class="section-tag" href="$Sections.First.Link">$Sections.First.Title</span>
								<% end_if %>
								<h2 class="story-tile__title">$Title</h2>
							</div>
						</a>
					<% end_with %>
				</div>
				<div class="col-lg-4">
					<div class="row">
						<div class="col-lg-12">
							<% with $Story2 %>
								<a href="$Link" <% if $FeaturedVideo %>style="background-image: url('http://img.youtube.com/vi/$FeaturedVideo/sddefault.jpg')"<% else_if $FeaturedImage %>style="background-image: url($FeaturedImage.FocusFillMax(1080,720).URL"<% end_if %> class="story-tile story-tile--small">
									<div class="story-tile__header">
										<% if $Sections %>
											<span class="section-tag" href="$Sections.First.Link">$Sections.First.Title</span>
										<% end_if %>
										<h2 class="story-tile__title story-tile__title--small">$Title</h2>
									</div>
								</a>
							<% end_with %>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<% with $Story3 %>
								<a href="$Link" <% if $FeaturedVideo %>style="background-image: url('http://img.youtube.com/vi/$FeaturedVideo/sddefault.jpg')"<% else_if $FeaturedImage %>style="background-image: url($FeaturedImage.FocusFillMax(1080,720).URL"<% end_if %> class="story-tile story-tile--small">
									<div class="story-tile__header">
										<% if $Sections %>
											<span class="section-tag" href="$Sections.First.Link">$Sections.First.Title</span>
										<% end_if %>
										<h2 class="story-tile__title story-tile__title--small">$Title</h2>
									</div>
								</a>
							<% end_with %>
						</div>
					</div>
				</div>
			</div>
		</div>
		<% end_with %>
		<% end_if %>


			<% if not $CurrentTag %>
			<div class="explorenav">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="text-center">Sections</h3>

								<div class="row">
									<% loop $allSections %>
										<div class="col-sm-6 col-lg-4">
											<a href="$Link" class="explorenav__link">
												<div class="imagegradient">
													<img src="$SectionCover.CroppedFocusedImage(400,140).URL" alt="" class="desaturate">
												</div>
												<h3>$Title</h3>
											</a>
										</div>
									<% end_loop %>
								</div>

						</div>
					</div>
				</div>
			</div>
			<% end_if %>

			<% if not $CurrentTag %>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<br><br>
						<h3 class="text-center">Filter stories by department, topic, or search</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">

						<select name="section-filter" id="section-dropdown" onchange="sectionList(this.value)" placeholder="Department" class="form-control story-filter__input story-filter__dept">
						<option value="0" hidden>Section</option>
						<% loop $Sections %>
							<option value="$ID">$Title</option>
						<% end_loop %>
						</select>

					</div>
					<div class="col-lg-4">

						<select name="topic-filter" id="tag-dropdown" onchange="tagList(this.value)" placeholder="Department" class="form-control story-filter__input story-filter__dept">
						<option value="0" hidden>Topic</option>
						<% loop $Tags %>
							<option value="$ID">$Title</option>
						<% end_loop %>
						</select>

					</div>
					<div class="col-lg-4">
						<input type="search" name="dept-filter" placeholder="Search" class="form-control story-filter__input story-filter__search">
					</div>
				</div>

			</div>
			<% end_if %>
			<br><br />
			<div class="filtered-story-card container" id="filter">
				<% if $PaginatedList.Exists %>
					<% loop $PaginatedList %>
						<% include StoryCardLarge %>
					<% end_loop %>
				<% else %>
					<p><%t Blog.NoPosts 'There are no posts' %></p>
				<% end_if %>
		 	</div>
		</article>

$Form
$CommentsForm

<% with $PaginatedList %>
	<% include Pagination %>
<% end_with %>