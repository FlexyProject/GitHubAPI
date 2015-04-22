<?php
namespace Scion\GitHub\Receiver;

/**
 * Class for GitHub Enterprise
 * @version 2.1
 * @link    https://developer.github.com/v3/enterprise/
 * @package Scion\GitHub\Receiver
 */
class Enterprise extends AbstractReceiver {

	/** Available sub-Receiver */
	const ADMIN_STATS        = 'AdminStats';
	const LICENSE            = 'License';
	const SEARCH_INDEXING    = 'SearchIndexing';
	const MANAGEMENT_CONSOLE = 'ManagementConsole';
}