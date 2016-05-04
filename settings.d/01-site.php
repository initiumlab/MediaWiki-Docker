<?php
$wgSitename = "Initium";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "/w";
$wgArticlePath = "/$1";
$wgUsePathInfo = true;

## The protocol and server name to use in fully-qualified URLs
$wgServer = "http://192.168.99.100";

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = "en";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";

#Set Default Timezone
$wgLocaltimezone = "Asia/Hong_Kong";
date_default_timezone_set( $wgLocaltimezone );

# open link in new tab
$wgExternalLinkTarget = '_blank';

# Enables the magic words {{PAGESINNAMESPACE}}
$wgAllowSlowParserFunctions = true;

# Enable subpages in the main namespace
$wgNamespacesWithSubpages[NS_MAIN] = true;

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

