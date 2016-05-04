<?php

# NOTE: make sure you change the variables in this file!

$wgSecretKey = getenv("WG_SECRET_KEY");

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = getenv("WG_UPGRADE_KEY");
