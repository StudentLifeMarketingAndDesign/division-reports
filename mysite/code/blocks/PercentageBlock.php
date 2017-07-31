<?php

class PercentageBlock extends Block{

	private static $db = array(
		"Value" => "Text",
		'Position' => 'Varchar(155)',
		"Label" => "Text",

	);

	private static $has_one = array(

	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName("Title");

		$fields->addFieldToTab("Root.Main", new TextField("Value", "Value (1-100)"));
		$fields->addFieldToTab("Root.Main", new TextField("Label", "Label"));
		$fields->addFieldToTab("Root.Main", DropdownField::create(
			'Position',
			'Position',
			array(
				'left' => 'Float Left',
				'right' => 'Float Right',
				'center'=> 'Centered'
			)
		)->setEmptyString('(Select One)'));

		return $fields;
	}

}