<?php
namespace Scion\Services\GitHub\Receiver;

class Search extends AbstractReceiver {

	/** Available sub-Receiver */
	const REPOSITORIES  = 'Repositories';
	const CODE          = 'Code';
	const ISSUES        = 'Issues';
	const USERS         = 'Users';
	const LEGACY_SEARCH = 'LegacySearch';

} 