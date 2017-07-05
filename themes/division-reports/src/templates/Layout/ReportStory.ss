<main role="main" class="story-single smooth">
	<header class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-2">
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
	</header>
	<% if $FeaturedImage %>
		<div class="story-single__coverimage">
			<img src="$FeaturedImage.FocusFillMax(1920,1080).URL" class="story-single__img" width="1920" height="1080">
			<% if $FeaturedImageCaption %>
				<p class="story-single__image-caption">$FeaturedImageCaption</p>
			<% end_if %>
		</div>
	<% end_if %>
	<div class="container story-single__body-container">
		<div class="row">
			<div class="col-lg-8 push-lg-2">
				<div class="story-single__body">
					<div class="story-single__text">
						$Content
					</div>
				</div>
			</div>
			<div class="col-lg-2 pull-lg-8">
				<div class="story-meta">
					<% loop $Credits %>
					<a href="$URL" class="story-meta__author-link">
						<% if $BlogProfileImage %>
							<img src="$BlogProfileImage.FocusFill(200,200).URL" class="story-meta__author-img" />
						<% end_if %>
						<p class="story-meta__author-name text-center">$FirstName $Surname</p>
					</a>
					<% end_loop %>
					<div class="story-meta__section">
						<h2 class="story-meta__section-title">Section</h2>
						<p class="story-meta__tags"><% loop $Sections %><a href="$Link" class="tag">$Title<% if not $Last %> <% end_if %><% end_loop %></a></p>
					</div>
					<div class="story-meta__section">
						<h2 class="story-meta__section-title">Topics</h2>
						<p class="story-meta__tags"><% loop $Tags %>
						<a href="$Link" class="tag">$Title<% if not $Last %> <% end_if %><% end_loop %></a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-2">
				<% if $PhotoCredit %>
				<p class="story-single__photo-credit story-single__image-caption">$PhotoCredit</p>
				<% end_if %>
				<div class="story-share">
					<h3 class="story-share__heading">Share this article</h3>
					<ul class="story-share__social clearfix">
						<li><a href="javascript:window.open('http://www.facebook.com/sharer/sharer.php?u=$AbsoluteLink', '_blank', 'width=400,height=500');void(0);"  title="Share on Facebook"><img src="{$ThemeDir}/dist/images/social-facebook.png" alt="Share on Facebook"></a>
						</li>
						<li><a href="https://twitter.com/intent/tweet?text=$AbsoluteLink" title="Share on Twitter" target="_blank"><img src="{$ThemeDir}/dist/images/social-twitter.png" alt="Share on Twitter"></a></li>
						<li><a href="javascript:window.open('https://www.linkedin.com/cws/share?url=$AbsoluteLink', '_blank', 'width=400,height=500');void(0);" title="Share on LinkedIn" target="_blank"><img src="{$ThemeDir}/dist/images/social-linkedin.png" alt="share on linkedid"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<% include RelatedStories %>

</main>