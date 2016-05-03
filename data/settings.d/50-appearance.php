<?php

wfLoadSkin( 'Vector' );
## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "Vector";

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgResourceBasePath/resources/assets/wiki.png";

# Remove links in the footer, as well as the MediaWiki logo
unset( $wgFooterIcons['poweredby'] );
$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'removeFooterLinks';
function removeFooterLinks( $sk, &$tpl ) {
    $tpl->data['footerlinks']['places'] = [];
    return true;
}

$wgShowExceptionDetails = true;