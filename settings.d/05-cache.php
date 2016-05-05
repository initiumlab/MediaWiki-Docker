<?php

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = array();
$wgUseGzip = true;
$wgEnableSidebarCache = true;

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
$wgCacheDirectory= "/var/www/html/w/cache";
