<?php
namespace Scion\GitHub\Receiver;

/**
 * This class is a miscellaneous set of APIs which provide access to top level GitHub resources and info.
 * @link    https://developer.github.com/v3/misc/
 * @package Scion\GitHub\Receiver
 */
class Miscellaneous extends AbstractReceiver {

	/** Available sub-Receiver */
	const EMOJIS     = 'Emojis';
	const GITIGNORE  = 'Gitignore';
	const MARKDOWN   = 'Markdown';
	const META       = 'Meta';
	const RATE_LIMIT = 'RateLimit';
	const LICENSES   = 'Licenses';
}