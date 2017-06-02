<?php

class Report extends Blog {

	private static $db = array(


	);

	private static $has_many = array(
		'Units' => 'ReportUnit'
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

		$unitGridFieldConfig = GridFieldConfig_RelationEditor::create();
		$unitGridField = new GridField('Units', 'Units in this report', $this->Units());

		$unitGridField->setConfig($unitGridFieldConfig);
		
		$f->addFieldToTab('Root.Main', $unitGridField);

		return $f;
	}

	public function getLumberjackTitle(){
		return 'Stories';
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
        'unit',
    );
    private static $url_handlers = array(
        'unit/$Unit!/$Rss' => 'unit',
    );
    public function unit(){
        $unit = $this->getCurrentUnit();

        if ($unit) {
            $this->Stories = $unit->Stories();

            if($this->isRSS()) {
            	return $this->rssFeed($this->stories, $unit->getLink());
            } else {
            	return $this->render();
            }
        }

        $this->httpError(404, 'Not Found');

        return null;
    }

    public function getCurrentUnit()
    {
        /**
         * @var Blog $dataRecord
         */
        $dataRecord = $this->dataRecord;
        $unit = $this->request->param('Unit');
        if ($unit) {
            return $dataRecord->Units()
                ->filter('URLSegment', array($unit, rawurlencode($unit)))
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
