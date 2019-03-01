<?php

use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Control\Controller;
use SilverStripe\Blog\Model\Blog;
use SilverStripe\Security\Permission;
use SilverStripe\ORM\DataObject;
use SilverStripe\Blog\Model\CategorisationObject;
use DNADesign\Elemental\Models\ElementalArea;
use DNADesign\Elemental\Models\BaseElement;
/**
 * A department for keyword descriptions of a job listing location.
 *
 * @package silverstripe
 * @subpackage blog
 *
 * @method Blog Blog()
 *
 * @property string $Title
 * @property string $URLSegment
 * @property int $BlogID
 */

class ReportSection extends DataObject implements CategorisationObject
{

    private static $db = array(
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'ShowInMenus' => 'Boolean',
        'Sort' => 'Int'
    );

    private static $has_one = array(
        'Blog' => 'Report',
        "SectionCover" => Image::class,
        'SidebarArea' => ElementalArea::class,
		'AfterContentConstrained' => ElementalArea::class,
		'BeforeContent' => ElementalArea::class,
		'BeforeContentConstrained' => ElementalArea::class,
		'AfterContent' => ElementalArea::class,
    );

    private static $many_many = array(
        'InfoSlides' => 'InfoSlide'
    );

    private static $belongs_many_many = array(
        'Stories' => 'ReportStory',
    );

    private static $extensions = array(
        'URLSegmentExtension',
    );

 	private static $defaults = array(
		'ShowInMenus' => true
	);

    private static $default_sort = 'Sort';

    // public function Stories()
    // {
    //     $stories = parent::();

    //     $this->extend("updateGetJobListings", $jobListings);

    //     return $jobListings;
    // }

    /**
     * {@inheritdoc}
     */
    public function getCMSFields()
    {

        $infoSlideFieldConfig = GridFieldConfig_RelationEditor::create();
        $infoSlideGridField = new GridField('InfoSlides', 'InfoSlides', $this->owner->InfoSlides(), $infoSlideFieldConfig);

        $fields = new FieldList(
            TextField::create('Title', _t('JobListingDepartment.Title', 'Title')),
            LiteralField::create('URLSegmentLabel', '<a href="'.$this->Link().'">'.$this->Link().'</a>'),
            CheckboxField::create('ShowInMenus', 'Show in menus'),
            $infoSlideGridField,
            UploadField::create('SectionCover', 'Navigation Photo'),
            HTMLEditorField::create('Content', 'Content')
        );

        // if($this->ID){
        //     // Blocks related directly to this Page
        //     $gridConfig = GridFieldConfig_BlockManager::create(true, true, true, true)
        //         ->addExisting($this->class)
        //         //->addBulkEditing()
        //         ->addComponent(new GridFieldOrderableRows())
        //         ;
        //     $gridSource = $this->Blocks();


        // $fields->push(GridField::create('Blocks', _t('Block.PLURALNAME', 'Blocks'), $gridSource, $gridConfig));

        // }else{
        //     $fields->push(ReadonlyField::create('You must save this section before you can add blocks'));
        // }
        // $areas = $this->blockManager->getAreasForPageType($this->owner->ClassName);


        //$this->extend('updateCMSFields', $fields);
        return $fields;
    }

    /**
     * Returns a relative URL for the tag link.
     *
     * @return string
     */
    public function getLink()
    {
        return Controller::join_links($this->Blog()->Link(), 'section', $this->URLSegment);
    }

    public function Link(){
        return $this->getLink();
    }
    /**
     * Inherits from the parent blog or can be overwritten using a DataExtension.
     *
     * @param null|Member $member
     *
     * @return bool
     */
    public function canView($member = null)
    {
        $extended = $this->extendedCan(__FUNCTION__, $member);

        if ($extended !== null) {
            return $extended;
        }

        return $this->Blog()->canView($member);
    }

    /**
     * Inherits from the parent blog or can be overwritten using a DataExtension.
     *
     * @param null|Member $member
     *
     * @return bool
     */
    public function canCreate($member = null, $context = array())
    {
        $extended = $this->extendedCan(__FUNCTION__, $member);

        if ($extended !== null) {
            return $extended;
        }

        $permission = Blog::config()->grant_user_permission;

        return Permission::checkMember($member, $permission);
    }

    /**
     * Inherits from the parent blog or can be overwritten using a DataExtension.
     *
     * @param null|Member $member
     *
     * @return bool
     */
    public function canDelete($member = null)
    {
        $extended = $this->extendedCan(__FUNCTION__, $member);

        if ($extended !== null) {
            return $extended;
        }

        return $this->Blog()->canEdit($member);
    }

    /**
     * Inherits from the parent blog or can be overwritten using a DataExtension.
     *
     * @param null|Member $member
     *
     * @return bool
     */
    public function canEdit($member = null)
    {
        $extended = $this->extendedCan(__FUNCTION__, $member);

        if ($extended !== null) {
            return $extended;
        }

        return $this->Blog()->canEdit($member);
    }
}
