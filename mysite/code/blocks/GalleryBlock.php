<?php

class GalleryBlock extends Block{

	private static $db = array(

	);

	private static $has_one = array(

	);

	private static $many_many = array(
		'GalleryImages' => 'Image'
	);
    private static $many_many_extraFields = array(
        'GalleryImages' => array('SortOrder' => 'Int')
    );

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		// $fields->removeByName("Title");

		$fields->addFieldToTab(
			'Root.Main',
			$uploadField = new SortableUploadField(
				$name = 'GalleryImages',
				$title = 'Upload one or more images (max 20 in total)'
			)
		);
		$uploadField->setAllowedMaxFileNumber(20);

		return $fields;
	}
   public function SortedImages(){
        return $this->GalleryImages()->Sort('SortOrder');
    }
}