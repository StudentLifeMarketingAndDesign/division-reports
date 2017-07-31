<?php

class ImageBlock extends Block{

	private static $db = array(
		'Caption' => 'HTMLText',
		'ButtonText' => 'Varchar(155)',
		'ButtonLink' => 'Varchar(255)'
	);

	private static $has_one = array(
		'Image' => 'Image'
	);

	private static $many_many = array(
	
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$f->addFieldToTab('Root.Main', new UploadField('Image', 'Image'));
		$f->addFieldToTab('Root.Main', new HTMLEditorField('Caption', 'Caption'));
		$f->addFieldToTab('Root.Main', new TextField('ButtonText', 'Button Text'));
		$f->addFieldToTab('Root.Main', new TextField('ButtonLink', 'Button Link'));

		return $f;
	}
	
}