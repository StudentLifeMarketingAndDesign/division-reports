<?php

class AuthorBlock extends Block{

	private static $db = array(

	);

	private static $has_one = array(
		
	);

	private static $many_many = array(
	
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		// $f->addFieldToTab('Root.Main', new TextField('ButtonLink', 'Button Link'));

		return $f;
	}
	
}