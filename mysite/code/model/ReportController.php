<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Blog\Model\Blog;
use SilverStripe\Blog\Model\BlogTag;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\View\ArrayData;
use SilverStripe\Blog\Model\BlogController;
class ReportController extends BlogController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */

	private static $allowed_actions = array(
		'section',
		'loadSection',
		'loadTag',
		'loadSearch'
	);
	private static $url_handlers = array(
		'section/$Section!/$Rss' => 'section',
		'loadSection/$Section!' => 'loadSection',
		'loadTag/$Tag!' => 'loadTag',
		'loadSearch/$Query!' => 'loadSearch',

	);

	public function loadSection(){

		$section = ReportSection::get()->byID($this->request->param('Section'));
		// print_r($this->getRequest()->param('Section'));
		// print_r($section);

		if($section){
		   return $section->renderWith('LoadSection');
		}

	}

	public function loadTag(){

		$tag = BlogTag::get()->byID($this->request->param('Tag'));

		if($tag){
			return $tag->renderWith('LoadTag');
		}

	}

	public function loadSearch(){
		$query = $this->request->param('Query');

		if(strlen($query) < 4){
			return;
		}
		$pages = SiteTree::get()->filter(array('ParentID' => $this->ID))->filterAny(
			array('Title:PartialMatch' => $query,
				  'Content:PartialMatch' => $query));
		// print_r($query);
		return $this->customise(
			array(
				'Query' => $query,
				'Pages' => $pages
			)
			)->renderWith('LoadSearch');

	}

	public function section(){

		$section = $this->getCurrentSection();
		$data = new ArrayData(array(
			'Title' => $section->Title
		));

		if ($section) {
			return $this->customise($data)->renderWith(array('Report_section', 'Page'));
		}

		$this->httpError(404, 'Not Found');

		return null;
	}

	public function getCurrentSection()
	{
		/**
		 * @var Blog $dataRecord
		 */
		$dataRecord = $this->dataRecord;
		$section = $this->request->param('Section');
		if ($section) {
			return $dataRecord->Sections()
				->filter('URLSegment', array($section, rawurlencode($section)))
				->first();
		}
		return null;
	}

	public function SectionsWithStories(){
		return ReportSection::get()->filterByCallback(
			function($item, $list) {
				return $item->Stories()->Count() > 0;
			}
		);
	}

	/**
	 * Returns true if the $Rss sub-action for categories/tags has been set to "rss"
	 */
	protected function isRSS()
	{
		$rss = $this->request->param('Rss');
		if(is_string($rss) && strcasecmp($rss, "rss") == 0) {
			return true;
		} else {
			return false;
		}
	}

}
