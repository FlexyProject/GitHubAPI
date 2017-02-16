<?php
namespace FlexyProject\GitHub\Receiver;

/**
 * This class serving up the �social� in Social Coding, this is a set of APIs providing access to notifications,
 * subscriptions, and timelines.
 *
 * @link    https://developer.github.com/v3/activity/
 * @package FlexyProject\GitHub\Receiver
 */
class Activity extends AbstractReceiver
{

    /** Available sub-Receiver */
    const EVENTS        = 'Events';
    const FEEDS         = 'Feeds';
    const NOTIFICATIONS = 'Notifications';
    const STARRING      = 'Starring';
    const WATCHING      = 'Watching';
}