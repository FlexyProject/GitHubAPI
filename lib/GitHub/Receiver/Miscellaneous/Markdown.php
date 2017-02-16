<?php
namespace FlexyProject\GitHub\Receiver\Miscellaneous;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Markdown API class lets you render Markdown documents.
 * @link    https://developer.github.com/v3/markdown/
 * @package FlexyProject\GitHub\Receiver\Miscellaneous
 */
class Markdown extends AbstractMiscellaneous {

	/**
	 * Render an arbitrary Markdown document
	 * @link https://developer.github.com/v3/markdown/#render-an-arbitrary-markdown-document
	 * @param string $text    The Markdown text to render
	 * @param string $mode    The rendering mode.
	 * @param string $context The repository context. Only taken into account when rendering as gfm
	 * @return array
	 */
	public function render(string $text, string $mode = AbstractApi::MODE_MARKDOWN, string $context = ''): array {
		return $this->getApi()->request(
			'/markdown',
			Request::METHOD_POST,
			[
				'text'    => $text,
				'mode'    => $mode,
				'context' => $context
			]
		);
	}

	/**
	 * Render a Markdown document in raw mode
	 * @link https://developer.github.com/v3/markdown/#render-a-markdown-document-in-raw-mode
	 * @param string $file
	 * @return array
	 */
	public function renderRaw(string $file): array {
		return $this->getApi()->setAccept('text/plain')->request(
			'/markdown/raw',
			Request::METHOD_POST,
			['file' => $file]
		);
	}
}