<?php

class Report extends Blog {

	private static $db = array(


	);
    private static $extensions = array(
        'StoryFilter',
    );	

	private static $allowed_children = array('ReportStory');

	private static $singular_name = 'Report';

	private static $plural_name = 'Reports';

	public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->removeByName('Content');


		return $f;
	}

	public function getLumberjackTitle(){
		return 'Stories';
	}


}

class Report_Controller extends Blog_Controller {

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
	private static $allowed_actions = array (
		'unit'
	);

	public function unit(){
		return '';
	}

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

}
