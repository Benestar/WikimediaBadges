<?php

/**
 * Extension which contains different themes
 * to display badges on Wikimedia projects
 */

/**
 * Entry point for for the WikimediaBadges extension.
 *
 * @see README.md
 * @see https://github.com/wmde/WikimediaBadges
 * @license GNU GPL v2+
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( defined( 'WIKIMEDIA_BADGES_VERSION' ) ) {
	// Do not initialize more than once.
	return 1;
}

define( 'WIKIMEDIA_BADGES_VERSION', '0.1 alpha' );

// This is the path to the autoloader generated by composer in case of a composer install.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	include_once( __DIR__ . '/vendor/autoload.php' );
}

$GLOBALS['wgExtensionFunctions'][] = function() {
	global $wgExtensionCredits, $wgMessagesDirs, $wgHooks, $wgResourceModules;

	if ( !defined( 'WB_VERSION' ) ) {
		throw new Exception( 'The WikimediaBadges extension requires Wikibase to be installed.' );
	}

	$wgExtensionCredits['wikibase'][] = array(
		'path' => __DIR__,
		'name' => 'WikimediaBadges',
		'version' => WIKIMEDIA_BADGES_VERSION,
		'author' => '[[mw:User:Bene*|Bene*]]',
		'url' => 'https://github.com/wmde/WikimediaBadges',
		'descriptionmsg' => 'wikimedia-badges-desc'
	);

	// i18n
	$wgMessagesDirs['WikimediaBadges'] = __DIR__ . '/i18n';

	// Hooks
	$wgHooks['BeforePageDisplay'][] = 'WikimediaBadges\Hooks::onBeforePageDisplay';

	// Resource Loader modules
	$wgResourceModules = array_merge( $wgResourceModules, include( __DIR__ . '/resources/Resources.php' ) );

};
