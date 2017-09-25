<?php

class KeyStatisticsBlock extends Block{

	private static $db = array(
		"Heading" => "Text",
		"Stat1" => "Text",
		"StatLabel1" => "Text",
		"Stat2" => "Text",
		"StatLabel2" => "Text",
		"Stat3" => "Text",
		"StatLabel3" => "Text"
	);

	private static $has_one = array(
		'Image' => 'Image',
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab("Root.Main", new TextField("Heading", "Heading"));
		$fields->addFieldToTab("Root.Main", new UploadField("Image", "Background Image (optional)"));
		$fields->addFieldToTab("Root.Main", new HeaderField( 'Stat 1', '3', true ));
		$fields->addFieldToTab("Root.Main", new TextField("Stat1", "Stat 1"));
		$fields->addFieldToTab("Root.Main", new TextField("StatLabel1", "Stat 1 Label"));
		$fields->addFieldToTab("Root.Main", new HeaderField( 'Stat 2', '3', true ));
		$fields->addFieldToTab("Root.Main", new TextField("Stat2", "Stat 2"));
		$fields->addFieldToTab("Root.Main", new TextField("StatLabel2", "Stat 2 Label"));
		$fields->addFieldToTab("Root.Main", new HeaderField( 'Stat 3', '3', true ));
		$fields->addFieldToTab("Root.Main", new TextField("Stat3", "Stat 3"));
		$fields->addFieldToTab("Root.Main", new TextField("StatLabel3", "Stat 3 Label"));

		return $fields;
	}

}