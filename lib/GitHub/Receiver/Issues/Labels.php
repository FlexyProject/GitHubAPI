<?php
namespace FlexyProject\GitHub\Receiver\Issues;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Trees API class provides access to Issues's labels.
 *
 * @link    https://developer.github.com/v3/issues/labels/
 * @package FlexyProject\GitHub\Receiver\Issues
 */
class Labels extends AbstractIssues
{

    /**
     * List all labels for this repository
     *
     * @link https://developer.github.com/v3/issues/labels/#list-all-labels-for-this-repository
     * @return array
     */
    public function listRepositoryLabels(): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf(
                                                 '/repos/:owner/:repo/labels',
                                                 $this->getIssues()->getOwner(),
                                                 $this->getIssues()->getRepo()
                                             ));
    }

    /**
     * Get a single label
     *
     * @link https://developer.github.com/v3/issues/labels/#get-a-single-label
     *
     * @param string $name
     *
     * @return array
     */
    public function getLabel(string $name): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/labels/:name',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $name
        ));
    }

    /**
     * Create a label
     *
     * @link https://developer.github.com/v3/issues/labels/#create-a-label
     *
     * @param string $name
     * @param string $color
     *
     * @return array
     */
    public function createLabel(string $name, string $color): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf(
                                                 '/repos/:owner/:repo/labels',
                                                 $this->getIssues()->getOwner(),
                                                 $this->getIssues()->getRepo()
                                             ), Request::METHOD_POST, [
                'name'  => $name,
                'color' => $color
                                                 ]);
    }

    /**
     * Update a label
     *
     * @link https://developer.github.com/v3/issues/labels/#update-a-label
     *
     * @param string $name
     * @param string $color
     *
     * @return array
     */
    public function updateLabel(string $name, string $color): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/labels/:name',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $name
        ), Request::METHOD_PATCH, [
                'color' => $color
            ]);
    }

    /**
     * Delete a label
     *
     * @link https://developer.github.com/v3/issues/labels/#delete-a-label
     *
     * @param string $name
     *
     * @return bool
     */
    public function deleteLabel(string $name): bool
    {
        $this->getApi()->request($this->getApi()
                                      ->sprintf(
                                          '/repos/:owner/:repo/labels/:name',
                                          $this->getIssues()->getOwner(),
                                          $this->getIssues()->getRepo(),
                                          $name
                                      ));

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * List labels on an issue
     *
     * @link https://developer.github.com/v3/issues/labels/#list-labels-on-an-issue
     *
     * @param int $number
     *
     * @return array
     */
    public function listIssueLabels(int $number): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/issues/:number/labels',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $number
        ));
    }

    /**
     * Add labels to an issue
     *
     * @link https://developer.github.com/v3/issues/labels/#add-labels-to-an-issue
     *
     * @param int $number
     *
     * @return array
     */
    public function addIssueLabels(int $number): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/issues/:number/labels',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $number
        ), Request::METHOD_POST);
    }

    /**
     * Remove a label from an issue
     *
     * @link https://developer.github.com/v3/issues/labels/#remove-a-label-from-an-issue
     *
     * @param int    $number
     * @param string $name
     *
     * @return bool
     */
    public function removeIssueLabel(int $number, string $name): bool
    {
        $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/issues/:number/labels/:name',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $number,
            $name
        ), Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Replace all labels for an issue
     *
     * @link https://developer.github.com/v3/issues/labels/#replace-all-labels-for-an-issue
     *
     * @param int $number
     *
     * @return array
     */
    public function replaceIssuesLabels(int $number): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/issues/:number/labels',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $number
        ), Request::METHOD_PUT);
    }

    /**
     * Remove all labels from an issue
     *
     * @link https://developer.github.com/v3/issues/labels/#remove-all-labels-from-an-issue
     *
     * @param int $number
     *
     * @return bool
     */
    public function removeIssueLabels(int $number): bool
    {
        $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/issues/:number/labels',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $number
        ), Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Get labels for every issue in a milestone
     *
     * @link https://developer.github.com/v3/issues/labels/#get-labels-for-every-issue-in-a-milestone
     *
     * @param int $number
     *
     * @return array
     */
    public function getIssueLabelsInMilestone(int $number): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/milestones/:number/labels',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $number
        ));
    }
}
