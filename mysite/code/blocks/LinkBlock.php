<?php

class LinkBlock extends Block{

	private static $db = array(
		'Link' => 'Varchar(2083)',
		'Content' => 'HTMLText'
	);

	private static $has_one = array(
		'Image' => 'Image'
	);

	private static $many_many = array(
	
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$f->addFieldToTab('Root.Main', new UploadField('Image', 'Image'));
		$f->addFieldToTab('Root.Main', new TextField('Link', 'Link'));

		return $f;
	}
	
}