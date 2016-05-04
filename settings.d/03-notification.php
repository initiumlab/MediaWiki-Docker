<?php
$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO
$wgEmailAuthentication = true;
$wgEnotifWatchlist = true;
$wgEnotifUserTalk = true;
$wgUseEnotif = true;
$wgEnotifMinorEdits=true;
$wgSMTP = array(
    'auth'     => true,
    'host'     => getenv("WG_SMTP_HOST"),
    'IDHost'   => getenv("WG_SMTP_IDHOST"),
    'port'     => getenv("WG_SMTP_PORT"),
    'username' => getenv("WG_SMTP_USERNAME"),
    'password' => getenv("WG_SMTP_PASSWORD")
);

$wgEmergencyContact = "apache@192.168.99.100";
$wgPasswordSender = "apache@192.168.99.100";

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
