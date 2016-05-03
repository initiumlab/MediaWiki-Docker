<?php

# Remove links in the footer, as well as the MediaWiki logo
unset( $wgFooterIcons['poweredby'] );
$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'removeFooterLinks';
function removeFooterLinks( $sk, &$tpl ) {
    $tpl->data['footerlinks']['places'] = [];
    return true;
}

$wgShowExceptionDetails = true;