<?php

class ReportStory extends BlogPost {

	private static $db = array(
		
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
		$member = Member::currentUser();

		$unitField = ListboxField::create('Units', 'Contributing Division Unit(s)', DivisionUnit::get()->map()->toArray())->setMultiple(true);
		if (!Permission::checkMember($member, 'ADMIN')) {

			$unitField->setDisabled(true);
		}
		$f->addFieldToTab("blog-admin-sidebar", $unitField);



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
		//example: set attributes before calling parent::populateDefaults();
	    // if($parent = $this->Parent()) {
	    //     $this->FullTitle = $parent->Title . ': ' . $this->Title;
	    // } 

	    $member = Member::currentUser();

	    if($member){
		    $memberUnits = $member->Units();

		    foreach($memberUnits as $unit){
		    	$this->Units()->add($unit);
		    }

	    }

	    parent::populateDefaults();
	}

	public function RelatedStories(){

	}


}