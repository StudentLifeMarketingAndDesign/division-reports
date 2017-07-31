<?php

class VideoBlock extends Block{

	private static $db = array(
		'YouTubeID' => 'Varchar(11)',
	);

	private static $has_one = array(

	);

	private static $many_many = array(
	
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->addFieldToTab('Root.Main', new YouTubeField('YouTubeID', 'YouTube Video'));
		return $f;
	}
	
}