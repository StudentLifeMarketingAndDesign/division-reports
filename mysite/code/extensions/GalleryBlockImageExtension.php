<?php

class GalleryBlockImageExtension extends DataExtension
{
	private static $db = array(
		'Test' => 'Text'
	);
    private static $belongs_many_many = array(
        'GalleryBlock' => 'GalleryBlock'
    );
}