<?php

wfLoadExtension( 'Cite' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'Renameuser' );
wfLoadExtension( 'SyntaxHighlight_GeSHi' );

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
require_once( "$IP/extensions/Cargo/Cargo.php" );
$wgCargoPageDataColumns[] = CARGO_STORE_CREATION_DATE;
$wgCargoPageDataColumns[] = CARGO_STORE_MODIFICATION_DATE;
$wgCargoPageDataColumns[] = CARGO_STORE_CREATOR;
$wgCargoPageDataColumns[] = CARGO_STORE_FULL_TEXT;
$wgCargoPageDataColumns[] = CARGO_STORE_CATEGORIES;
$wgCargoPageDataColumns[] = CARGO_STORE_NUM_REVISIONS;

# Additional SQL functions
$wgCargoAllowedSQLFunctions[] = 'NOW';

require_once "$IP/extensions/RandomSelection/RandomSelection.php";

require_once "$IP/extensions/ExternalData/ExternalData.php";

require_once("$IP/extensions/Embed/Embed.php");

$GLOBALS['egSPLAutorefresh'] = true;

wfLoadExtension( 'Gadgets' );

require_once "$IP/extensions/MultimediaViewer/MultimediaViewer.php";
