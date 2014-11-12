<?php
namespace Scion\Services\GitHub\Receiver;

class Issues extends AbstractReceiver {

	/** Available sub-Receiver */
	const ASSIGNEES  = 'Assignees';
	const COMMENTS   = 'Comments';
	const EVENTS     = 'Events';
	const LABELS     = 'Labels';
	const MILESTONES = 'Milestones';

} 