<?php
class DivisionUnit extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(155)',
		'URLSegment' => 'Varchar(155)',
	);

	private static $has_one = array(
	);

	private static $many_many = array(
		'Members' => 'Member',
		'Stories' => 'ReportStory'
	);

}

