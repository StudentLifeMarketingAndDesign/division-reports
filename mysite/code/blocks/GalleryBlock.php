<?php

class GalleryBlock extends Block{

	private static $db = array(

	);

	private static $has_one = array(

	);

	private static $many_many = array(
		'GalleryImages' => 'Image'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		// $fields->removeByName("Title");

		$fields->addFieldToTab(
			'Root.Main',
			$uploadField = new UploadField(
				$name = 'GalleryImages',
				$title = 'Upload one or more images (max 20 in total)'
			)
		);
		$uploadField->setAllowedMaxFileNumber(20);

		return $fields;
	}

}