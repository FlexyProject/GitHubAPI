<?php
namespace FlexyProject\GitHub\Receiver\GitData;

use Symfony\Component\HttpFoundation\Request;

/**
 * This tags API only deals with tag objects - so only annotated tags, not lightweight tags.
 * @link    https://developer.github.com/v3/git/tags/
 * @package FlexyProject\GitHub\Receiver\GitData
 */
class Tags extends AbstractGitData {

	/**
	 * Get a Tag
	 * @link https://developer.github.com/v3/git/tags/#get-a-tag
	 * @param string $sha
	 * @return array
	 * @throws \Exception
	 */
	public function get(string $sha): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/git/tags/:sha', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $sha)
		);
	}

	/**
	 * Create a Tag Object
	 * @link https://developer.github.com/v3/git/tags/#create-a-tag-object
	 * @param string $tag
	 * @param string $message
	 * @param string $object
	 * @param string $type
	 * @param array  $tagger
	 * @return array
	 * @throws \Exception
	 */
	public function create(string $tag, string $message, string $object, string $type, array $tagger = []): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/git/tags', $this->getGitData()->getOwner(), $this->getGitData()->getRepo()),
			Request::METHOD_POST,
			[
				'tag'     => $tag,
				'message' => $message,
				'object'  => $object,
				'type'    => $type,
				'tagger'  => $tagger
			]
		);
	}
} 