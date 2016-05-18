<?php

/**
 * Example usage:
 *
 *	<embed>{{PAGENAME}}</embed>
 *	<embed>http://localhost/mw/images/d/de/Sample.pdf</embed>
 *	<embed>Sample.pdf</embed>
 *
 */

$wgExtensionCredits['parserhook'][] = array(
    'name' => 'Embed',
    'author' => 'Kim Eik',
    'version' => '0.1',
    'url' => 'https://www.mediawiki.org/wiki/Extension:SimpleEmbed',
    'description' => 'Allows for embedding files on a page',
);

$wgExtensionFunctions[] = 'registerEmbedHandler';

function registerEmbedHandler ()
{
    global $wgParser;
    $wgParser->setHook( 'embed', 'embed' );
}

function isValidUrl($url){
    return preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url);
}

function parseAsUrlOrWikiText($text,Parser $parser, PPFrame $frame){
    if(isValidUrl($text)){
        return $text;
    }else{
        $text = html_entity_decode($parser->recursiveTagParse($text,$frame));
        if(!isValidUrl($text)){
            $file = wfFindFile($text);
            return $file ? $file->getFullUrl() : false;
        }
        return $text;
    }
}

function embed ( $input, $argv, Parser $parser, PPFrame $frame )
{
    $path = parseAsUrlOrWikiText($input,$parser,$frame);
    if (!$path){
        return "<span style=\"color: red;\">Invalid URI: $input</span>";
    }

    $width = isset($argv['width']) ? htmlspecialchars( $argv['width'] ) : '1000';
    $height = isset($argv['height']) ? htmlspecialchars( $argv['height'] ) : '700';

    return '<iframe src="'.$path.'" width="'.$width.'" height="'.$height.'"></iframe>';
}