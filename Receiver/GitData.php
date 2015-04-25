<?php
namespace Scion\GitHub\Receiver;

/**
 * This class provides access to The Git Database API gives you access to read and write raw Git objects to your Git database on GitHub and to list and update your references (branch heads and tags).
 * @link    https://developer.github.com/v3/git/
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