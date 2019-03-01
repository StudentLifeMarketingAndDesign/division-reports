<?php

use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use DNADesign\Elemental\Models\BaseElement;
class LinkBlock extends BaseElement{

	private static $db = array(
		'Link' => 'Varchar(2083)',
		'Content' => 'HTMLText'
	);

	private static $has_one = array(
		'Image' => Image::class
	);

	private static $many_many = array(

	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$f->addFieldToTab('Root.Main', new UploadField(Image::class, Image::class));
		$f->addFieldToTab('Root.Main', new TextField('Link', 'Link'));

		return $f;
	}

}
