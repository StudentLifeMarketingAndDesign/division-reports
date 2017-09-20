<main role="main" class="story-single">
	$BlockArea(BeforeContent)
	<div class="container">
		<div class="row">
			<div class="col-lg-9 offset-lg-1">
				<div class="story-single__header">
					<% if $Sections %>
					<a class="section-tag" href="$Sections.First.Link">$Sections.First.Title</a>
					<% end_if %>
					<h1 class="header__title story-single-heading__title">$Title</h1>
					<% if $Summary %>
						<div class="header__intro summary">
							$Summary
						</div>
					<% end_if %>
				</div>
			</div>
		</div>
	</div>
	<% if $FeaturedVideo %>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="featuredvideo">
						<div class="fluid-width-video-wrapper" style="padding-top: 56.25%;">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/$FeaturedVideo" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	<% else_if $FeaturedImage %>
		<figure class="coverimage">
			<div class="coverimage__container">
				<picture>
					<source srcset="$FeaturedImage.FocusFillMax(1300,730).URL" media="(min-width: 980px)">
					<source srcset="$FeaturedImage.FocusFillMax(980,550).URL" media="(min-width: 480px)">
					<img srcset="$FeaturedImage.FocusFillMax(480,270).URL" class="coverimage__cover" <% if $FeaturedImageCaption %>alt="$FeaturedImageCaption"><% else %>alt="$Title"<% end_if %>
				</picture>
				<%-- <img src="$FeaturedImage.FocusFillMax(480,270).URL" class="story-single__img" alt=""> --%>
			</div>
			<% if $FeaturedImageCaption || $PhotoCredit %>
				<figcaption class="coverimage__meta">
					<div class="container">
						<div class="row">
							<% if $FeaturedImageCaption %>
								<div class="col-lg-6 offset-lg-3">
									<div class="coverimage__caption">
										<p>$FeaturedImageCaption</p>
									</div>
								</div>
							<% end_if %>

							<% if $PhotoCredit %>
								<div class="col-lg-2 offset-lg-1">
									<div class="coverimage__credit">
										<p class="">credit: $PhotoCredit</p>
									</div>
								</div>
							<% end_if %>
						</div>
					</div>
				</figcaption>
			<% end_if %>
		</figure>
	<% end_if %>

	<div class="story-wrapper">

		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					$BlockArea(BeforeContentConstrained)
					<div class="content-inner">
						$Content
					</div>
					$BlockArea(AfterContentConstrained)

				</div>
			</div>
		</div>

		<div class="story-footer clearfix">
			<div class="story-meta">
				<div class="inner">
					<% if $Credits.Count > 1 %>
						<div class="multiple-authors">
							<h4 class="story-meta__section-title">Authors</h4>
					<% end_if %>
					<% loop $Credits %>
						<a href="$URL" class="author clearfix">
							<% if $BlogProfileImage %>
								<img src="$BlogProfileImage.FocusFill(200,200).URL" class="author__img" />
							<% end_if %>
							<p class="author__name">$FirstName $Surname</p>
						</a>
					<% end_loop %>
					<% if $Credits.Count > 1 %></div><% end_if %>

					<% if $Sections %>
					<div class="story-meta__section">
						<h4 class="story-meta__section-title">Section</h4>
						<ul class="story-meta__tags">
							<% loop $Sections %>
								<li><a href="$Link" class="tag">$Title</a></li>
							<% end_loop %>
						</ul>
					</div>
					<% end_if %>

					<% if $Tags %>
					<div class="story-meta__section">
						<h4 class="story-meta__section-title">Topics</h4>
						<ul class="story-meta__tags">
							<% loop $Tags %>
								<li><a href="$Link" class="tag">$Title</a></li>
							<% end_loop %>
						</ul>
					</div>
					<% end_if %>
				</div>
			</div>
			<div class="story-share">
				<div class="inner">
					<h5 class="story-share__heading">Share this article</h5>
					<ul class="story-share__social clearfix">
						<li><a href="javascript:window.open('http://www.facebook.com/sharer/sharer.php?u=$AbsoluteLink', '_blank', 'width=400,height=500');void(0);"  title="Share on Facebook"><img src="{$ThemeDir}/dist/images/social-facebook.png" alt="Share on Facebook"></a>
						</li>
						<li><a href="https://twitter.com/intent/tweet?text=$AbsoluteLink" title="Share on Twitter" target="_blank"><img src="{$ThemeDir}/dist/images/social-twitter.png" alt="Share on Twitter"></a></li>
						<li><a href="javascript:window.open('https://www.linkedin.com/cws/share?url=$AbsoluteLink', '_blank', 'width=400,height=500');void(0);" title="Share on LinkedIn" target="_blank"><img src="{$ThemeDir}/dist/images/social-linkedin.png" alt="share on linkedid"></a></li>
						<li><a href="mailto:?subject=$Title"><img src="{$ThemeDir}/dist/images/email.png" alt="email"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	$BlockArea(AfterContent)
	<% include RelatedStories %>
</main>
