<?php

class SiteConfigExtension extends DataExtension {

	private static $db = array(
		'GoogleAnalyticsID' => 'Text'
	);

	private static $has_one = array(

	);

	private static $defaults = array(

	);

	public function updateCMSFields(FieldList $fields) {

		$fields->addFieldToTab('Root.Main', new TextField('GoogleAnalyticsID', 'Google Analytics ID (UA-XXXXX-X)'));



		return $fields;
	}

}
class SiteConfigExtensionPage_Controller extends Page_Controller {

	public function init() {
		parent::init();
	}

}