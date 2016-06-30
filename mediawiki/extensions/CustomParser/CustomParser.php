<?php

# Confirm MediaWiki environment
if (!defined('MEDIAWIKI')) die();

# Credits
$wgExtensionCredits['other'][] = array(
    'name'=>'CustomParser',
    'author'=>'Chunliang Lyu',
    'url'=>'https://www.mediawiki.org/wiki/Extension:CustomParser',
    'description'=>'Custom parser for .json/.md pages',
    'version'=>'0.1'
);

$wgResourceModules['ext.CustomParser'] = array(
	'position' => 'top',
	'styles' => array( 'font-awesome/css/font-awesome.min.css'),
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'CustomParser',
);
 
function endswith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
}

/**
 * Wrapper class for encapsulating AlternateSyntaxParser methods
 */
class AlternateSyntaxParser {

    /**
     * Setup for AlternateSyntaxParser extension.
     */
    function setup( ) {
    }

    /**
     * @param Parser $parser Instance of Parser performing the parse.
     * @param String $text Text to be processed.
     * @return Boolean false if processing suceeded, true otherwise
     */
    function swapOutText( &$parser, &$text ) {
    
        # Short-circuit if we're not processing main article text
        if (
            !$parser->mRevisionId &&
            property_exists($this, 'mEditPreviewFlag') &&
            !$this->mEditPreviewFlag
        ) return true;

       $title = $parser->getTitle()->getText();

       if (endsWith($title, '.md')) {
           $text = '<pre>' . $text . '</pre>';
       } else if (endsWith($title, '.json')) {
           $text = '<syntaxhighlight lang="json">' . $text . '</syntaxhighlight>';
       } else if (endsWith($title, '.yaml')) {
           $text = '<syntaxhighlight lang="yaml">' . $text . '</syntaxhighlight>';
       }
       return true;
    }

    /**
     * Flags when an edit preview is taking place.
     * Usage: $wgHooks['EditPage::showEditForm:initial'][] = 'wfAlternateSyntaxFlagEditPreview';
     * @param EditPage $editpage Instance of EditPage performing a preview.
     * @return Boolean Always true.
     */
    function flagEditPreview( &$editpage ) {
        $this->mEditPreviewFlag = true;
        return true;
    }

    /**
     * Unsets edit preview flag
     * @param EditPage $editpage Instance of EditPage performing a preview.
     * @param OutputPage $out Instance of OutputPage during render ($wgOut).
     * @return Boolean Always true.
     */
    function unflagEditPreview( &$editpage, &$out ) {
        if (isset($this->mEditPreviewFlag)) unset($this->mEditPreviewFlag);
        return true;
    }

    public static function addModule( &$out ) {
	$out->addModules( 'ext.CustomParser' );
	return true;
    }

}

# Create global instance and wire it up!
$wgAlternateSyntaxParser = new AlternateSyntaxParser();
$wgExtensionFunctions[] = array($wgAlternateSyntaxParser, 'setup');

$wgHooks['ParserBeforeStrip'][] = array($wgAlternateSyntaxParser, 'swapOutText');
$wgHooks['EditPage::showEditForm:initial'][] = array($wgAlternateSyntaxParser, 'flagEditPreview');
$wgHooks['EditPage::showEditForm:fields'][] = array($wgAlternateSyntaxParser, 'unflagEditPreview');
$wgHooks['BeforePageDisplay'][] = array($wgAlternateSyntaxParser, 'addModule');

