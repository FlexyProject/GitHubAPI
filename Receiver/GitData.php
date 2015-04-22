<?php
namespace Scion\GitHub\Receiver;

/**
 * Class GitData
 * @link https://developer.github.com/v3/git/
 * @package Scion\GitHub\Receiver
 */
class GitData extends AbstractReceiver {

	/** Available sub-Receiver */
	const BLOBS      = 'Blobs';
	const COMMITS    = 'Commits';
	const REFERENCES = 'References';
	const TAGS       = 'Tags';
	const TREES      = 'Trees';
}