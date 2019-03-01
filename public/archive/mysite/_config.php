<?php

global $project;
$project = 'mysite';

global $database;
$database = 'annualreport13';
 
// Use _ss_environment.php file for configuration
require_once("conf/ConfigureFromEnv.php");
MySQLDatabase::set_connection_charset('utf8');
// add a button to remove formatting
HtmlEditorConfig::get('cms')->insertButtonsBefore(
	'styleselect',
	'removeformat'
);

// tell the button which tags it may remove
HtmlEditorConfig::get('cms')->setOption(
	'removeformat_selector',
	'b,strong,em,i,span,ins'
);

//remove font->span conversion

HtmlEditorConfig::get('cms')->setOption(
	'convert_fonts_to_spans', 'false,'
);

HtmlEditorConfig::get('cms')->setOptions(array(
	'extended_valid_elements' => "img[class|src|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|usemap],#iframe[src|name|width|height|align|frameborder|marginwidth|marginheight|scrolling],object[width|height|data|type],param[name|value],map[class|name|id],area[shape|coords|href|target|alt],script[language|type|src]",
));
// Set the site locale
i18n::set_locale('en_US');

if(Director::isLive()) {
	Director::forceSSL();
}
