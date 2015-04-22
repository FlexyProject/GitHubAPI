<?php
namespace Scion\GitHub\Receiver;

/**
 * Class Activity
 * @link    https://developer.github.com/v3/activity/
 * @package Scion\GitHub\Receiver
 */
class Activity extends AbstractReceiver {

	/** Available sub-Receiver */
	const EVENTS        = 'Events';
	const FEEDS         = 'Feeds';
	const NOTIFICATIONS = 'Notifications';
	const STARRING      = 'Starring';
	const WATCHING      = 'Watching';
}