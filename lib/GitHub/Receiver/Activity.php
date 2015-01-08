<?php
namespace GitHub\Receiver;

class Activity extends AbstractReceiver {

	/** Available sub-Receiver */
	const EVENTS        = 'Events';
	const FEEDS         = 'Feeds';
	const NOTIFICATIONS = 'Notifications';
	const STARRING      = 'Starring';
	const WATCHING      = 'Watching';

}