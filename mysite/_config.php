<?php

global $project;
$project = 'mysite';

global $database;
$database = 'division-reports';

require_once('conf/ConfigureFromEnv.php');

// Set the site locale
i18n::set_locale('en_US');
HtmlEditorConfig::get('cms')->enablePlugins(array(
	'aceeditor' => sprintf('../../../codeeditorfield/javascript/tinymce/editor_plugin_src.js')
));
HtmlEditorConfig::get('cms')->insertButtonsBefore('fullscreen', 'aceeditor');
HtmlEditorConfig::get('cms')->removeButtons('code');
Authenticator::unregister('MemberAuthenticator');
Authenticator::set_default_authenticator('SAMLAuthenticator');
FulltextSearchable::enable();