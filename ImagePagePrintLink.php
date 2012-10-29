<?php
/**
 * Extension ImagePagePrintLink - Adds a ”print this image” link to the image page TOC links, for local files (in compatible browsers).
 * @version 0.5
 *
 * @link http://www.mediawiki.org/wiki/Extension:ImagePagePrintLink Documentation
 *
 * @file ImagePagePrintLink.php
 * @ingroup Extensions
 * @package MediaWiki
 * @author Leo Wallentin (Rotsee)
 * @license http://www.opensource.org/licenses/BSD-2-Clause BSD
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is a MediaWiki extension, it is not a valid entry point' );
}

$wgExtensionMessagesFiles['imagepageprintlink'] = dirname( __FILE__ ) . '/ImagePagePrintLink.i18n.php';

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Image Page Print Link',
	'type' => 'hook',
	'author' => array( '[http://xn--ssongsmat-v2a.nu Leo Wallentin]' ),
	'version' => '0.5',
        'url' => 'http://www.mediawiki.org/wiki/Extension:ImagePagePrintLink',
        'descriptionmsg' => 'ippl-description',
);

$wgResourceModules['ext.ImagePagePrintLink'] = array(
        'scripts' => array( 'js/ext.ImagePagePrintLink.core.js' ),
        'localBasePath' => dirname( __FILE__ ),
        'remoteExtPath' => 'ImagePagePrintLink',
);


$wgHooks['ImagePageShowTOC'][] = 'ipplWritePrintLink';

function ipplWritePrintLink ( $imagePage, &$toc ) {

	/* Get the file on this file page */
	$file = $imagePage->getDisplayedFile();

	/* Only for local files and only for images */
	if ( $file && $file->isLocal() && $file->canRender() ) {

		$imagePage->getContext()->getOutput()->addModules( 'ext.ImagePagePrintLink' );

		$toc[] = '<li style="display:none;" id="printthisimage" data-href="'.$file->getUrl().'"><a href="#" title="'.wfMessage( 'ippl-titletext')->text().'">'.wfMessage( 'ippl-linktext')->text().'</a></li>';

	}

	return true;
}
