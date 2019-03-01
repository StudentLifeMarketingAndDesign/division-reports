<?php

use SilverStripe\ORM\DataExtension;

class GalleryBlockImageExtension extends DataExtension
{
	private static $db = array(
	
	);
    private static $belongs_many_many = array(
        'GalleryBlock' => 'GalleryBlock'
    );
}