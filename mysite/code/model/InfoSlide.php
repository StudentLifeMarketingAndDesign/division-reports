<?php


class InfoSlide extends DataObject
{
    private static $db = array(

       'Title' => 'Varchar(155)',
       'MediaType' => "Enum('Image,Video')",
       'LayoutType' => 'Varchar(155)',
       'Quote' => 'Text',
       'QuoteCaption' => 'Text',

       'Stat1Number' => 'Text',
       'Stat1Label' => 'Text',
       'Stat1IsCircle' => 'Boolean',

       'Stat2Number' => 'Text',
       'Stat2Label' => 'Text',
       'Stat2IsCircle' => 'Boolean',

       'Stat3Number' => 'Text',
       'Stat3Label' => 'Text',
       'Stat3IsCircle' => 'Boolean',

       'ArbitraryStatsHTML' => 'HTMLText',

       'ButtonTitle' => 'Varchar(155)',
       'ButtonLink' => 'Varchar(155)'


    );

    private static $belongs_many_many = array(
        'ReportSections' => 'ReportSection',
        'InfoSlideshowBlocks' => 'InfoSlideshowBlock'
    );

    private static $has_one = array(
        'BackgroundImage' => 'Image',
        'BackgroundVideo' =>  'File'
    );

    private static $layout_types = array(
        'ArbitraryStatsHTML' => 'Arbitrary Stats HTML Editor',
        'SingleQuote' => 'Single Quote',
        'SingleStat' => 'Single Statistic & Label',
        'TwoStats' => 'Two Statistics & Labels',
        'ThreeStats' => 'Three Statistics & Labels',
        'FourStats' => 'Four Statistics & Labels',
        
    );

    private static $summary_fields = array(
        'Title',
        'BackgroundImage.CMSThumbnail'
    );


    public function LayoutTypes(){
        return $this->stat('layout_types');
    }
    public function getCMSFields(){
    
        $f = new FieldList();

        $f->push(TextField::create('Title', 'Title / Heading'));

        $mediaType = DropdownField::create(
          'MediaType',
          'Background media type',
          singleton('InfoSlide')->dbObject('MediaType')->enumValues()
        );

        $f->push($mediaType);

        $f->push(DisplayLogicWrapper::create(UploadField::create('BackgroundVideo', 'Background Video'))->displayIf('MediaType')->isEqualTo('Video')->end());
        $f->push(DisplayLogicWrapper::create(UploadField::create('BackgroundImage', 'Background Image'))->displayIf('MediaType')->isEqualTo('Image')->end());

        $f->push(TextField::create('ButtonTitle', 'Button Title'));
        $f->push(TextField::create('ButtonLink', 'Button Link'));

        $layoutOptionsField = DropdownField::create(
            'LayoutType',
            'Layout Type',
            $this->LayoutTypes()
        );
       $f->push($layoutOptionsField);

        //$f->push($codeField);

        $singleQuoteFields = DisplayLogicWrapper::create(
            TextField::create('Quote'),
            TextField::create('QuoteCaption')
        )->displayIf('LayoutType')->isEqualTo('SingleQuote')->end();

        $f->push($singleQuoteFields);


        $codeField = CodeEditorField::create('ArbitraryStatsHTML');
        $codeField->addExtraClass('stacked');
        $codeField->setRows(30);

        $arbitraryHtmlFields = DisplayLogicWrapper::create(
            $codeField
        )->displayIf('LayoutType')->isEqualTo('ArbitraryStatsHTML')->end();

        $f->push($arbitraryHtmlFields);

        return $f;
    }
}
