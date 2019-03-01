<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\ORM\ArrayList;
    use DNADesign\Elemental\Models\ElementalArea;
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
		// 'SidebarArea' => ElementalArea::class,
		// 'AfterContentConstrained' => ElementalArea::class,
		// 'BeforeContent' => ElementalArea::class,
		// 'BeforeContentConstrained' => ElementalArea::class,
		// 'AfterContent' => ElementalArea::class,
	);

	public function AllUnits(){

		return DivisionUnit::get()->filter(array('ShowInMenus' => 1));
	}

	public function getCMSFields(){

		$f = parent::getCMSFields();
		// Make sure settings tab is last
		// $formContent = $fields->fieldByName('Root.Blocks');
		// $fields->removeByName('Blocks');

		// $fields->addFieldsToTab('Root.Main', $formContent);
		// $sidebarAreaField = $f->dataFieldByName('SidebarArea');

		// if($sidebarAreaField){
		// 	$sidebarAreaField->setTitle('Sidebar');
		// 	$f->removeByName('SidebarArea');
		// 	$f->addFieldToTab('Root.Blocks', $sidebarAreaField);
		// }

		// $beforecontentField = $f->dataFieldByName('BeforeContent');

		// if($beforecontentField){
		// 	$beforecontentField->setTitle('Before Content');
		// 	$f->remove($beforecontentField);
		// 	$f->addFieldToTab('Root.Blocks', $beforecontentField);
		// }

		// $beforecontentConstrainedField = $f->dataFieldByName('BeforeContentConstrained');

		// if($beforecontentConstrainedField){
		// 	$beforecontentConstrainedField->setTitle('Before Content (Constrained)');
		// 	$f->removeByName('BeforeContentConstrained');
		// 	$f->addFieldToTab('Root.Blocks', $beforecontentConstrainedField);
		// }

		// $aftercontentAreaField = $f->dataFieldByName('AfterContent');

		// if($aftercontentAreaField){

		// 	$f->removeByName('AfterContent');
		// 	$f->addFieldToTab('Root.Blocks', $aftercontentAreaField);
		// 	$aftercontentAreaField->setTitle('After Content');
		// }

		// $aftercontentConstrainedField = $f->dataFieldByName('AfterContentConstrained');

		// if($aftercontentConstrainedField){
		// 	$aftercontentConstrainedField->setTitle('After Content (Constrained)');
		// 	$f->removeByName('AfterContentConstrained');
		// 	$f->addFieldToTab('Root.Blocks', $aftercontentConstrainedField);
		// }
		return $f;
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
}

