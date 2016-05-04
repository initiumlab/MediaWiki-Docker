<?php

require_once "$IP/extensions/VisualEditor/VisualEditor.php";
// Enable by default for everybody
$wgDefaultUserOptions['visualeditor-enable'] = 1;

$wgVirtualRestConfig['modules']['parsoid'] = array(
    // URL to the Parsoid instance
    'url' => 'http://parsoid:8000',
    'domain' => 'mediawiki'
);

$wgSessionsInObjectCache = true;
$wgVirtualRestConfig['modules']['parsoid']['forwardCookies'] = true;