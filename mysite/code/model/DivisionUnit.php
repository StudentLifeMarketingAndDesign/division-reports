<?php
class DivisionUnit extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(155)',
		'URLSegment' => 'Varchar(155)',
		'ShowInMenus' => 'Boolean'
	);

	private static $has_one = array(
	);

	private static $many_many = array(
		'Members' => 'Member',
		'Stories' => 'ReportStory'
	);

	private static $defaults = array(
		'ShowInMenus' => true
	);

	public function getCMSFields() {
		// $f = parent::getCMSFields();
		$f = new FieldList();

		$f->push(TextField::create('Title'));
		$f->push(CheckboxField::create('ShowInMenus', 'Show in menus'));


		return $f;
	}

}

