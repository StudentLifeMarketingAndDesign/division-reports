<?php

use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use DNADesign\Elemental\Models\BaseElement;
use UncleCheese\DisplayLogic\Forms\Wrapper;
class GraphBlock extends BaseElement{

	private static $db = array(
		'Caption' => 'HTMLText',
		"GraphType" => "Enum('Image,Google Sheets,Chart.js','Image')",
	);

	private static $has_one = array(
		'Image' => Image::class
	);

	private static $many_many = array(

	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$f->removeByName(Image::class);
		$f->addFieldToTab('Root.Main',

				DropdownField::create('GraphType', 'Graph Type', singleton('GraphBlock')->dbObject('GraphType')->enumValues())
			);

		$f->addFieldToTab('Root.Main',
				Wrapper::create(
					UploadField::create(Image::class, Image::class)
				)->displayIf('GraphType')->isEqualTo(Image::class)->end());


		$f->addFieldToTab('Root.Main', HTMLEditorField::create('Caption', 'Graph caption'));
		// $f->addFieldToTab('Root.Main', );
		// $f->addFieldToTab('Root.Main', new TextField('Link', 'Link'));

		return $f;
	}

}
