<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;


class SiteConfigExtension extends DataExtension {

	private static $db = array(
	);

	private static $has_one = array(

	);

	private static $defaults = array(

	);

	public function updateCMSFields(FieldList $fields) {


		return $fields;
	}

}
