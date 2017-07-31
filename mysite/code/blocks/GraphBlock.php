<?php

class GraphBlock extends Block{

	private static $db = array(
		"GraphType" => "Enum('Image,Google Sheets,Chart.js','Image')",
	);

	private static $has_one = array(
		'Image' => 'Image'
	);

	private static $many_many = array(
	
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->addFieldToTab('Root.Main', DropdownField::create('GraphType', 'GraphType', singleton('GraphBlock')->dbObject('GraphType')->enumValues()));
		// $f->addFieldToTab('Root.Main', new UploadField('Image', 'Image'));
		// $f->addFieldToTab('Root.Main', new TextField('Link', 'Link'));

		return $f;
	}
	
}