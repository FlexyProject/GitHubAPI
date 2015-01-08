<?php
namespace GitHub\Receiver;

class GitData extends AbstractReceiver {

	/** Available sub-Receiver */
	const BLOBS      = 'Blobs';
	const COMMITS    = 'Commits';
	const REFERENCES = 'References';
	const TAGS       = 'Tags';
	const TREES      = 'Trees';

} 