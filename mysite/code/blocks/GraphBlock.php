<?php

class GraphBlock extends Block{

	private static $db = array(
		'Caption' => 'HTMLText'
		"GraphType" => "Enum('Image,Google Sheets,Chart.js','Image')",
	);

	private static $has_one = array(
		'Image' => 'Image'
	);

	private static $many_many = array(
	
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$f->removeByName('Image');
		$f->addFieldToTab('Root.Main',
		
				DropdownField::create('GraphType', 'Graph Type', singleton('GraphBlock')->dbObject('GraphType')->enumValues())
			);

		$f->addFieldToTab('Root.Main',
				DisplayLogicWrapper::create(
					UploadField::create('Image', 'Image')
				)->displayIf('GraphType')->isEqualTo('Image')->end());


		$f->addField('Root.Main' HTMLEditorField::create('Caption', 'Graph caption'));
		// $f->addFieldToTab('Root.Main', );
		// $f->addFieldToTab('Root.Main', new TextField('Link', 'Link'));

		return $f;
	}
	
}