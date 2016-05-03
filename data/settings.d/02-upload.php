<?php

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

$wgFileExtensions = array(
    'png', 'gif', 'jpg', 'jpeg',
    'pdf',
    'ppt', 'pptx', 'key',
    'pages', 'doc', 'docx',
    'xls', 'xlsx', 'numbers'
);
