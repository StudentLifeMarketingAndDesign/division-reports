<?php
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\Control\Director;

// remove PasswordValidator for SilverStripe 5.0
$validator = new PasswordValidator();

$validator->minLength(8);
$validator->checkHistoricalPasswords(6);
Member::set_password_validator($validator);

if(Director::isLive()) {
	Director::forceSSL();
}
// HtmlEditorConfig::get('cms')->enablePlugins(array(
//     'aceeditor' => sprintf('../../../codeeditorfield/javascript/tinymce/editor_plugin_src.js')
// ));
HtmlEditorConfig::get('cms')->insertButtonsBefore('fullscreen', 'aceeditor');
HtmlEditorConfig::get('cms')->removeButtons('code');
