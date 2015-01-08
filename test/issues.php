<?php
require 'bootstrap.php';

// Client
$client = new \Github\Client();
//var_dump($client);

// Issues
$issues = $client->getReceiver(\GitHub\Client::ISSUES);
//$issues->listIssues();
//$issues->listUserIssues();
//$issues->listOrganizationIssues('organization');
//$issues->listRepositoryIssues();
//$issues->getIssue(10);
//$issues->createIssue('Issue title');
//$issues->editIssue(10);

// Assignees
$assignees = $issues->getReceiver(\GitHub\Receiver\Issues::ASSIGNEES);
//$assignees->listAssignees();
//$assignees->checkAssignee('username');

// Comments
$comments = $issues->getReceiver(\GitHub\Receiver\Issues::COMMENTS);
//$comments->listIssueComments(1);
//$comments->listRepositoryComments(\GitHub\AbstractApi::SORT_CREATED, \GitHub\AbstractApi::DIRECTION_DESC, 'now');
//$comments->getComment(1);
//$comments->createComment(1, 'a new comment');
//$comments->editComment(1, 'String');
//$comments->deleteComment(1);

// Events
$events = $issues->getReceiver(\GitHub\Receiver\Issues::EVENTS);
//$events->listIssueEvents(1);
//$events->listRepositoryEvents();
//$events->getEvent(1);

// Labels
$labels = $issues->getReceiver(\GitHub\Receiver\Issues::LABELS);
//$labels->listRepositoryLabels();
//$labels->getLabel('bug');
//$labels->createLabel('API', 'FFFFFF');
//$labels->updateLabel('API', 'FFFFFF');
//$labels->deleteLabel('API');
//$labels->listIssueLabels(1);
//$labels->addIssueLabels(1);
//$labels->removeIssueLabel(1, 'bug');
//$labels->replaceIssuesLabels(1);
//$labels->removeIssueLabels(1);
//$labels->getIssueLabelsInMilestone(1);

// Milestones
$milestones = $issues->getReceiver(\GitHub\Receiver\Issues::MILESTONES);
//$milestones->listMilestones(\GitHub\AbstractApi::STATE_OPEN, \GitHub\AbstractApi::SORT_DUE_DATE, \GitHub\AbstractApi::DIRECTION_ASC);
//$milestones->getMilestone(1);
//$milestones->createMilestone('String', \GitHub\AbstractApi::STATE_OPEN, 'String', 'now');
//$milestones->updateMilestone(1, 'String', \GitHub\AbstractApi::STATE_OPEN, 'String', 'now');
//$milestones->deleteMilestone(1);


