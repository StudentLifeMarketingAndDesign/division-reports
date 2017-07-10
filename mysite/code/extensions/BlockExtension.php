<?php

class BlockExtension extends DataExtension {



	public function updateCMSFields(FieldList $currentFields) {
		$currentFields->renameField('Title', 'Block Name');
	}
}