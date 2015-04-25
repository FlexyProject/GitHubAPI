<?php
namespace Scion\GitHub\Receiver;

/**
 * This class is for GitHub Enterprise, this supports the same powerful API available on GitHub.com as well as its own set of API endpoints.
 * @link    https://developer.github.com/v3/enterprise/
 * @version 2.1
 * @package Scion\GitHub\Receiver
 */
class Enterprise extends AbstractReceiver {

	/** Available sub-Receiver */
	const ADMIN_STATS        = 'AdminStats';
	const LICENSE            = 'License';
	const SEARCH_INDEXING    = 'SearchIndexing';
	const MANAGEMENT_CONSOLE = 'ManagementConsole';
}