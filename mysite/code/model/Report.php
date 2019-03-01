<?php

use SilverStripe\Forms\TextField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Blog\Model\Blog;
use SilverStripe\Blog\Model\BlogTag;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\View\ArrayData;
use SilverStripe\Blog\Model\BlogController;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class Report extends Blog {

	private static $db = array(
        'Year' => 'Int'

	);

	private static $has_many = array(
		'Sections' => 'ReportSection'
	);
    private static $extensions = array(
        'StoryFilter',
    );

	private static $allowed_children = array('ReportStory');

	private static $singular_name = 'Report';

	private static $plural_name = 'Reports';

	public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->removeByName('Content');

        $f->addFieldToTab('Root.Main', TextField::create('Year'));

		$sectionGridFieldConfig = GridFieldConfig_RelationEditor::create();
        $sectionGridFieldConfig->addComponent(new GridFieldSortableRows('Sort'));
		$sectionGridField = new GridField('Sections', 'Units/Sections in this report', $this->Sections());

		$sectionGridField->setConfig($sectionGridFieldConfig);

		$f->addFieldToTab('Root.Main', $sectionGridField);

		return $f;
	}

	public function getLumberjackTitle(){
		return 'Stories';
	}

    public function Featured(){

        $data = new DataObject();

        $stories = ReportStory::get()->sort('RAND()')->filter(array('IsFeatured' => 1, 'ParentID' => $this->ID))->limit(3);

        $storiesArray = $stories->toArray();

        if(sizeof($storiesArray) > 0){
            $data->Story1 = $storiesArray[0];

            if(isset($storiesArray[1])){
                $data->Story2 = $storiesArray[1];
            }

            if(isset($storiesArray[2])){
                $data->Story3 = $storiesArray[2];
            }
        }


        return $data;

    }

    public function Authors(){
        $stories = ReportStory::get()->filter(array('ParentID' => $this->ID));
        $authors = new ArrayList();

        foreach($stories as $story){
            $storyAuthors = $story->getCredits();
            foreach($storyAuthors as $storyAuthor){
                $authors->push($storyAuthor);
            }
        }

        $authors->removeDuplicates();
        $authors = $authors->sort('Surname ASC');

        return $authors;

    }
}

