<?php

# Anonymous users cannot register account, or view/edit any page
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['read'] = false;

// Allow requests from parsoid and ocg
// if the OCG server make an API request through wiki domain, it will come through the gateway address
if ($_SERVER['REMOTE_ADDR'] === "172.27.1.3" || 
    $_SERVER['REMOTE_ADDR'] === "172.27.1.4" ||
    $_SERVER['REMOTE_ADDR'] === "172.27.1.1"
) {
    $wgGroupPermissions['*']['read'] = true;
    $wgGroupPermissions['*']['edit'] = true;
}

// Allow public access of certain pages by providing a secret read token
$wgSecretReadToken = getenv("WG_SECRET_READ_TOKEN");
if ($wgSecretReadToken !== false && strlen($wgSecretReadToken) >= 4 && $_GET['readtoken'] == $wgSecretReadToken) {
    $wgWhitelistRead = array_merge(array(
        "Main Page", "MediaWiki:Common.css", "MediaWiki:Common.js"
    ), explode("|", getenv("WG_WHITELIST_READ")));
}
