<?php

use DNADesign\Elemental\Models\ElementalArea;
use DNADesign\Elemental\Models\ElementContent;

use SilverStripe\Dev\BuildTask;

class MigrateContentToElementCustom extends BuildTask
{

	protected $title = 'MigrateContentToElement CUSTOM';

	protected $description = 'When installing Elemental this task converts content in the $Content '
		. 'field to an ElementContent';

	public function run($request)
	{
		// TODO: needs rewriting for multiple elemental areas
		$pageTypes = singleton(ElementalArea::class)->supportedPageTypes();

		$count = 0;

			$pages = \Page::get();

			foreach ($pages as $page) {
				$content = $page->Content;
				$page->Content = '';
				// trigger area relations to be setup
				$page->write();
				$area = $page->ElementalArea();
				$element = new ElementContent();
				$element->Title = 'Auto migrated content';
				$element->HTML = $content;
				$element->ParentID = $area->ID;
				$element->write();
			}
			$count += $pages->Count();
			echo 'Migrated ' . $pages->Count() . ' pages\' content<br>';

		echo 'Finished migrating ' . $count . ' pages\' content<br>';
	}
}
