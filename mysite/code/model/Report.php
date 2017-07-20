<?php

class Report extends Blog {

	private static $db = array(


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

		$sectionGridFieldConfig = GridFieldConfig_RelationEditor::create();
		$sectionGridField = new GridField('Sections', 'Units/Sections in this report', $this->Sections());

		$sectionGridField->setConfig($sectionGridFieldConfig);
		
		$f->addFieldToTab('Root.Sections', $sectionGridField);

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
}

class Report_Controller extends Blog_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	
	private static $allowed_actions = array(
        'section',
        'loadSection',
        'loadTag',
    );
    private static $url_handlers = array(
        'section/$Section!/$Rss' => 'section',
        'loadSection/$Section!' => 'loadSection',
        'loadTag/$Tag!' => 'loadTag',

    );

    public function loadSection(){

        $section = ReportSection::get()->byID($this->request->param('Section'));
        // print_r($this->getRequest()->param('Section'));
        // print_r($section);
        return $section->renderWith('LoadSection');
    }

    public function loadTag(){

        $tag = BlogTag::get()->byID($this->request->param('Tag'));
        return $tag->renderWith('LoadTag');
    }

    public function section(){

        $section = $this->getCurrentSection();


        if ($section) {
            return $this->renderWith(array('Report_section', 'Page'));
        }

        $this->httpError(404, 'Not Found');

        return null;
    }

    public function getCurrentSection()
    {
        /**
         * @var Blog $dataRecord
         */
        $dataRecord = $this->dataRecord;
        $section = $this->request->param('Section');
        if ($section) {
            return $dataRecord->Sections()
                ->filter('URLSegment', array($section, rawurlencode($section)))
                ->first();
        }
        return null;
    }

    /** 
     * Returns true if the $Rss sub-action for categories/tags has been set to "rss"
     */
    private function isRSS() 
    {
        $rss = $this->request->param('Rss');
        if(is_string($rss) && strcasecmp($rss, "rss") == 0) {
            return true;
        } else {
            return false;
        }
    }

}
