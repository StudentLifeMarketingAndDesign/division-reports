<?php

/**
 * This class is responsible for filtering the SiteTree when necessary and also overlaps into
 * filtering only published posts.
 *
 * @package silverstripe
 * @subpackage blog
 */
class StoryFilter extends BlogFilter
{

    /**
     * {@inheritdoc}
     */
    public function updateCMSFields(FieldList $fields)
    {
        // $fields->removeByName('ChildPages');
        // $excluded = $this->owner->getExcludedSiteTreeClassNames();

        // $member = Member::currentUser();
        // $memberUnits = $member->Units();

        // $pages = new ArrayList();
        // $gridFieldTitle = 'Stories from ';

        // if (!Permission::checkMember($member, 'ADMIN')){
        //     foreach($memberUnits as $unit){
        //         $gridFieldTitle .= $unit->Title;
        //         if($unit === end($memberUnits)){
        //             $gridFieldTitle .= ', ';
        //         }
        //         $unitStories = $unit->Stories()->filter(array('ParentID' => $this->owner->ID));
        //         $pages->merge($unitStories);
        //     }
        // }else{
        //     $gridFieldTitle .= 'all units';
        //     $pages = ReportStory::get()->filter(array('ParentID' => $this->owner->ID));
        // }

        // $gridField = new BlogFilter_GridField(
        //     'ChildPages',
        //     $gridFieldTitle,
        //     $pages,
        //     $this->getLumberjackGridFieldConfig()
        // );

        // $tab = new Tab('ChildPages', $this->getLumberjackTitle(), $gridField);

        // $fields->insertBefore($tab, 'Main');
      
    }
}
