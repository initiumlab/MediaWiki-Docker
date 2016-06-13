<?php

wfLoadExtension( 'Cite' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'Renameuser' );
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
wfLoadExtension( 'PdfHandler' );

wfLoadExtension( 'Interwiki' );
// To grant sysops permissions to edit interwiki data
$wgGroupPermissions['sysop']['interwiki'] = true;

wfLoadExtension( 'WikiEditor' );
# Enables use of WikiEditor by default but still allows users to disable it in preferences
$wgDefaultUserOptions['usebetatoolbar'] = 1;

# Enables link and table wizards by default but still allows users to disable them in preferences
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;

# Displays the Preview and Changes tabs
$wgDefaultUserOptions['wikieditor-preview'] = 1;

# Displays the Publish and Cancel buttons on the top right side
$wgDefaultUserOptions['wikieditor-publish'] = 1;

require_once "$IP/extensions/News/News.php";

wfLoadExtension( 'ReplaceText' );
$wgGroupPermissions['bureaucrat']['replacetext'] = true;

wfLoadExtension( 'Editcount' );

require_once "$IP/extensions/CustomParser/CustomParser.php";

require_once "$IP/extensions/LookupUser/LookupUser.php";
// Who can use Special:LookupUser?
$wgGroupPermissions['*']['lookupuser'] = false;
$wgGroupPermissions['sysop']['lookupuser'] = true;

require_once "$IP/extensions/Widgets/Widgets.php";

$wgPFEnableStringFunctions = true;

wfLoadExtension( 'Elastica' );
require_once "$IP/extensions/CirrusSearch/CirrusSearch.php";
$wgCirrusSearchServers = array( 'elasticsearch' );
$wgSearchType = 'CirrusSearch';

include_once "$IP/extensions/SemanticForms/SemanticForms.php";

wfLoadExtension( 'Cargo' );
$wgCargoPageDataColumns[] = CARGO_STORE_CREATION_DATE;
$wgCargoPageDataColumns[] = CARGO_STORE_MODIFICATION_DATE;
$wgCargoPageDataColumns[] = CARGO_STORE_CREATOR;
$wgCargoPageDataColumns[] = CARGO_STORE_FULL_TEXT;
$wgCargoPageDataColumns[] = CARGO_STORE_CATEGORIES;
$wgCargoPageDataColumns[] = CARGO_STORE_NUM_REVISIONS;

require_once "$IP/extensions/RandomSelection/RandomSelection.php";

require_once "$IP/extensions/ExternalData/ExternalData.php";

require_once "$IP/extensions/Embed/Embed.php";

# For SubPageList, which is installed via Composer
$GLOBALS['egSPLAutorefresh'] = true;

wfLoadExtension( 'Gadgets' );

require_once "$IP/extensions/MultimediaViewer/MultimediaViewer.php";

require_once "$IP/extensions/UploadWizard/UploadWizard.php";
$wgUploadWizardConfig['tutorial']['skip'] = true;
$wgUploadWizardConfig['enableLicensePreference'] = false;
$wgUploadWizardConfig['licensing']['defaultType'] = 'choice';
$wgUploadWizardConfig['licensing']['ownWorkDefault'] = 'choice';

wfLoadExtension( 'CodeEditor' );

// Collection extension
require_once "$IP/extensions/Collection/Collection.php";
// configuration borrowed from wmf-config/CommonSettings.php in operations/mediawiki-config
$wgCollectionFormatToServeURL['rdf2latex'] = 'http://ocg:17080';

// MediaWiki namespace is not a good default
$wgCommunityCollectionNamespace = NS_PROJECT;

// Sidebar cache doesn't play nice with this
$wgEnableSidebarCache = false;

$wgCollectionFormats = array(
    'rdf2latex' => 'PDF',
);

$wgLicenseURL = "http://creativecommons.org/licenses/by-sa/3.0/";
$wgCollectionPortletFormats = array( 'rdf2latex' );

