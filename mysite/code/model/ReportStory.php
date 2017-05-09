<?php

class ReportStory extends BlogPost {

	private static $db = array(
		'AuthorEmails' => 'Text'
	);

	private static $belongs_many_many = array(
		'Units' => 'DivisionUnit'
	);

	private static $singular_name = 'Story';

	private static $plural_name = 'Stories';

	private static $summary_fields = array('Title', 'ContributingUnits');

	public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->removeByName('PublishDate');
		$f->removeByName('Authors');


		$authorEmailField = TextareaField::create('AuthorEmails', 'Author email addresses (comma separated)')->setRows(3);
		$member = Member::currentUser();

		$unitField = ListboxField::create('Units', 'Contributing Division Unit(s)', DivisionUnit::get()->map()->toArray())->setMultiple(true);
		if (!Permission::checkMember($member, 'ADMIN')) {

			$unitField->setDisabled(true);
		}
		$f->addFieldToTab("blog-admin-sidebar", $unitField);
		$f->addFieldToTab("blog-admin-sidebar", $authorEmailField);



		return $f;
	}

	public function getContributingUnits(){
		$units = $this->Units();
		$list = '';
		foreach($units as $unit){
			$list .= $unit->Title.' ';
		}
		return $list;
	}

	public function populateDefaults() {
		//set attributes before calling parent::populateDefaults();

	    // $member = Member::currentUser();

	    // if($member){
		   //  $memberUnits = $member->Units();

		   //  foreach($memberUnits as $unit){
		   //  	$this->Units()->add($unit);
		   //  }

	    // }

	    parent::populateDefaults();
	}

	public function RelatedStories(){

	}

public function onBeforeWrite() {
    // check on first write action, aka "database row creation" (ID-property is not set)
    if(!$this->isInDb()) {

    }

    // check on every write action:
    $authorEmails = $this->AuthorEmails;

    $authorEmailsArray = explode(',',$authorEmails);
    //print_r($authorEmailsArray);

    // CAUTION: You are required to call the parent-function, otherwise
    // SilverStripe will not execute the request.
    parent::onBeforeWrite();
  }

}