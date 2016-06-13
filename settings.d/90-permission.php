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
