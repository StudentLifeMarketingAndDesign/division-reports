<?php
class OpenGraphExtension extends DataExtension {
    public static $keys = array(
        'title',
        'type',
        'image',
        'image:width',
        'image:height',
        'url',
        'description',
        'determiner',
        'locale',
        'locale:alternate',
        'site_name',
        'audio',
        'video',
        'video:width',
        'video:height',
        'video:secure_url',
        'video:type'
    );
    private function getCanonicalURL($url) {
        return Director::protocolAndHost() . $url;
    }
    public function getOpenGraph_type() {

        return 'website';
    }
    public function getOpenGraph_locale() {
        return i18n::get_locale();
    }

    public function getOpenGraph_description() {
        $page = $this->owner->data();
        $tries = array(
            'OgDescription',
            'MetaDescription',
            'Content'
        );

        foreach($tries as $t) {
            $i = $page->hasValue($t);

            if($i){
                

                $content = $this->owner->obj($t)->LimitCharacters(300);
                $content = Convert::raw2att($content);
                return $content;
            }
        }

        return SiteConfig::current_site_config()->obj('Tagline');
  
    }
    public function getOpenGraph_site_name() {
        return SiteConfig::current_site_config()->Title;
    }
    public function getOpenGraphImage() {

        $page = $this->owner->data();
        $tries = array(
            'OgImage',
            'FeaturedImage',
            'SectionCover'
        );
        //Try the above image fields
        foreach($tries as $t) {
            // echo $t;
            $i = $page->hasOneComponent($t);
            if($i) {
                if($page->getComponent($t)->exists()){
                    // echo 'component exists: '.$i;
                    return $page->getComponent($t);
                }
            }
        }

        //If no images in the tries array were found, attempt to get the sitewide poster image:
        if(SiteConfig::current_site_config()->obj('PosterImage')->exists()){
            return SiteConfig::current_site_config()->obj('PosterImage');
        }else{
            $ogDefaultImageTest = Image::get()->filter(array('Filename' => 'themes/division-reports/src/images/opengraph-default.png'))->First();

            if($ogDefaultImageTest){
                return $ogDefaultImageTest;
            }else{
                $ogDefaultImage = Image::create();
                $ogDefaultImage->Title = 'Division of Student Life default Og Image';
                $ogDefaultImage->Filename = 'themes/division-reports/src/images/opengraph-default.png';
                $ogDefaultImage->write();
                return $ogDefaultImage;                           
            }
        }  
        return null;
    }
    
    public function getOpenGraph_image_height() {
        $im = $this->owner->getOpenGraphImage();
        if($im && $im->exists()) {
            return $im->Height;
        }
    }
    
    public function getOpenGraph_image_width() {
        $im = $this->owner->getOpenGraphImage();
        if($im && $im->exists()) {
            return $im->Width;
        }
    }
    
    public function getOpenGraph_image() {
        $im = $this->owner->getOpenGraphImage();
        if($im && $im->exists()) {
            return $this->getCanonicalURL($im->URL);
        }
    }
    public function getOpenGraph_title() {
        if($this->owner->URLSegment == "home"){
            return SiteConfig::current_site_config()->Title;
        }else{
            return $this->owner->Title;
        }
        
    }
    public function getOpenGraph_url() {
        $page = $this->owner;
        return $this->getCanonicalUrl($page->XML_val('Link'));
    }
    public function getOpenGraph_determiner() {
        return null;
    }
    public function getOpenGraph_audio() {
        return null;
    }
    public function getOpenGraph_video() {
        return null;
    }
    public function getOpenGraph_video_width() {
        return null;
    }
    public function getOpenGraph_video_height() {
        return null;
    }
    public function getOpenGraph_video_type() {
        return null;
    }
    public function getOpenGraph_video_secure_url() {
        return null;
    }
    public function getOpenGraph_locale_alternate() {
        return null;
    }
    public function getOpenGraph() {
        $tags = '';
        foreach(OpenGraphExtension::$keys as $k) {
            $key = str_replace(':', '_', $k);
            $action = "getOpenGraph_$key";
            $val = $this->owner->$action();
            if($val) {
                $val = Convert::raw2att($val);
                $tags .= "<meta property=\"og:$k\" content=\"$val\" />\n";
            }
        }
        return $tags;
    }
}