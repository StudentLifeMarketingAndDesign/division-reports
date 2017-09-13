<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

	public function AllUnits(){

		return DivisionUnit::get()->filter(array('ShowInMenus' => 1));
	}

	public function allSections(){

        $sections = new ArrayList();

        if($this->ClassName == 'ReportStory'){
        	$sections = $this->Parent->Sections();
        }

        else if ($this->ClassName == 'Report'){
        	$sections = $this->Sections();
        }

        else{
			$sections = $this->LatestIssue()->Sections();
        }

        return $sections;

    }

    public function AllReports(){
    	// $redirectors = ReportRedirector::get()->toArray();
    	// $reports = Report::get()->toArray();

    	// $allReports = array_merge($redirectors, $reports);

    	$allReports = SiteTree::get()->filter(array(
    			'ClassName' => array('Report','ReportRedirector')
    		));

    	$allReportsArrayList = new ArrayList();

    	foreach($allReports as $report){
    		$allReportsArrayList->push($report);
    	}

    	$allReportsArrayList->sort('Year DESC');
    	//print_r($allReports->execute());
    	return $allReportsArrayList;
    }

	public function LatestIssue(){
		$home = Page::get()->filter(array('URLSegment' => 'home'))->First();
		return $home->LinkTo();
	}
}
class Page_Controller extends ContentController {

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
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}


}
