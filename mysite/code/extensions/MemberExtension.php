<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class MemberExtension extends DataExtension {

    private static $belongs_many_many = array(
    	//'Units' => 'DivisionUnit'
    );

	public function updateCMSFields(FieldList $currentFields) {
		// $tagField = TagField::create('Units', 'Units this content author can edit:', DivisionUnit::get(), $this->owner->Units())->setShouldLazyLoad(true);
		// $currentFields->addFieldToTab('Root.Main', $tagField);

	}
}