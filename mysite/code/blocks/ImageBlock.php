<?php

use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use DNADesign\Elemental\Models\BaseElement;
class ImageBlock extends BaseElement{

	private static $db = array(
		'Caption' => 'HTMLText',
		'ButtonText' => 'Varchar(155)',
		'ButtonLink' => 'Varchar(255)'
	);

	private static $has_one = array(
		'Image' => Image::class
	);

	private static $many_many = array(

	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$f->addFieldToTab('Root.Main', new UploadField(Image::class, Image::class));
		$f->addFieldToTab('Root.Main', new HTMLEditorField('Caption', 'Caption'));
		$f->addFieldToTab('Root.Main', new TextField('ButtonText', 'Button Text'));
		$f->addFieldToTab('Root.Main', new TextField('ButtonLink', 'Button Link'));

		return $f;
	}

}
