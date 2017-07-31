<?php

class InfoSlideshowBlock extends Block{
    
    private static $db = array(

    );

    private static $has_one = array(

    );

    private static $many_many = array(
        'Slides' => 'InfoSlide'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $infoSlideFieldConfig = GridFieldConfig_RelationEditor::create();
        $infoSlideGridField = new GridField('InfoSlides', 'InfoSlides', $this->Slides(), $infoSlideFieldConfig);

        $fields->addFieldToTab('Root.Main', $infoSlideGridField);


        return $fields;
    }	
    /**
     * If the singular name is set in a private static $singular_name, it cannot be changed using the translation files
     * for some reason. Fix it by defining a method that handles the translation.
     * @return string
     */
    public function singular_name()
    {
        return _t('TextBlock.SINGULARNAME', 'Info Slideshow Block');
    }

    /**
     * If the plural name is set in a private static $plural_name, it cannot be changed using the translation files
     * for some reason. Fix it by defining a method that handles the translation.
     * @return string
     */
    public function plural_name()
    {
        return _t('TextBlock.PLURALNAME', 'Info Slideshow Blocks');
    }
}