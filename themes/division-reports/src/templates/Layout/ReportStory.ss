
$Header
<main class="container">

	<% if $BackgroundImage %>
		<% include FeaturedImage %>
	<% end_if %>


	<% if not $BackgroundImage %>
		<div class="">
			<div class="">
				<h1>$Title</h1>
				<% if $Summary %>
					<div class="">$Summary</div>
				<% end_if %>
			</div>
			<% if $FeaturedImage %>
				<% if FeaturedImage.Width >= 1200 %>
					<p class=""><img class="" src="$FeaturedImage.CroppedImage(1200,700).URL" alt="" role="presentation" /></p>
				<% end_if %>
			<% end_if %>
		</div>
	<% end_if %>

	$BlockArea(BeforeContent)

	<div class="row">
		<article role="main" class="">
			$BlockArea(BeforeContentConstrained)
			<div class="">
				<% if $FeaturedImage %>
					<% if FeaturedImage.Width >= 700 && FeaturedImage.Width < 1200 %>
						<p class=""><img class="" src="$FeaturedImage.SetWidth(840).URL" alt="" role="presentation" /></p>
					<% end_if %>
				<% end_if %>
				<div class="">

					<div class=" clearfix">
						<% include ByLine %>
						<ul class="">
							<li><a href="javascript:window.open('http://www.facebook.com/sharer/sharer.php?u=$AbsoluteLink', '_blank', 'width=400,height=500');void(0);"  title="Share on Facebook"><img src="{$ThemeDir}/dist/images/icon_facebook.png" alt="Share on Facebook"></a>
							</li>
							<li><a href="https://twitter.com/intent/tweet?text=$AbsoluteLink" title="Share on Twitter" target="_blank"><img src="{$ThemeDir}/dist/images/icon_twitter.png" alt="Share on Twitter"></a></li>
							<li><a href="javascript:window.open('https://www.linkedin.com/cws/share?url=$AbsoluteLink', '_blank', 'width=400,height=500');void(0);" title="Share on LinkedIn" target="_blank"><img src="{$ThemeDir}/dist/images/icon_linkedin.png" alt="share on linkedid"></a></li>
						</ul>
					</div>
					<% if $FeaturedImage %>
						<% if FeaturedImage.Width < 700 %>
							<img class="" src="$FeaturedImage.URL" alt="" class="right">
						<% end_if %>
					<% end_if %>
					$Content
					<% if $ExternalURL %>
						<p><a href="$ExternalURL" class="" target="_blank">$ExternalURLText</a></p>
					<% end_if %>
				</div>
				$BlockArea(AfterContentConstrained)
				<% include TagsCategories %>
			</div>
			$Form
		</article>
	</div>
	$BlockArea(AfterContent)
</main>

<%-- <% if $RelatedNewsEntries %>
<div class="block_area block_area_aftercontent">
	<section class="content-block__container recentnews" aria-labelledby="RelatedNewsSection">
		<div class="content-block row">
			<div class="newsblock">
				<div class="column">
					<h3 class="newsblock-title text-center" id="RelatedNewsSection">Related News</h3>
				</div>
				<ul class="medium-up-3 ">
					<% loop $RelatedNewsEntries.limit(3) %>
						<li class="column column-block">
							<% include BlogCard %>
						</li>
					<% end_loop %>
				</ul>
			</div>
		</div>
	</section>
</div>
<% end_if %> --%>









