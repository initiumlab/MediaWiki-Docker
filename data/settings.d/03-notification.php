<?php
$wgEnableEmail = false;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "apache@192.168.99.100";
$wgPasswordSender = "apache@192.168.99.100";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

require_once "$IP/extensions/Echo/Echo.php";
$wgEchoDefaultNotificationTypes=array(
    'all' => array(
        'web' => true,
        'email' => true,
    )
);

require_once "$IP/extensions/Flow/Flow.php";
// These lines enable Flow on the "talk" and "User talk" namespaces
$wgNamespaceContentModels[NS_TALK] = CONTENT_MODEL_FLOW_BOARD;
$wgNamespaceContentModels[NS_USER_TALK] = CONTENT_MODEL_FLOW_BOARD;
$wgNamespaceContentModels[NS_CATEGORY_TALK] = CONTENT_MODEL_FLOW_BOARD;
