<?php

use SilverStripe\Forms\TextField;
use SilverStripe\CMS\Model\RedirectorPage;


class ReportRedirector extends RedirectorPage {

	private static $db = array(
        'Year' => 'Int'
	);

	private static $has_many = array(

	);
    private static $extensions = array(

    );

	private static $allowed_children = array();

	public function getCMSFields() {
		$f = parent::getCMSFields();
        $f->addFieldToTab('Root.Main', TextField::create('Year'));
		return $f;
	}

}

