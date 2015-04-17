<?php
namespace Scion\GitHub\Receiver\Miscellaneous;

use Scion\GitHub\AbstractApi;
use Scion\Http\Request;

/**
 * The Markdown API class lets you render Markdown documents.
 * @link    https://developer.github.com/v3/markdown/
 * @package Scion\GitHub\Receiver\Miscellaneous
 */
class Markdown extends AbstractMiscellaneous {

	/**
	 * Render an arbitrary Markdown document
	 * @link https://developer.github.com/v3/markdown/#render-an-arbitrary-markdown-document
	 * @param string $text    The Markdown text to render
	 * @param string $mode    The rendering mode.
	 * @param string $context The repository context. Only taken into account when rendering as gfm
	 * @return string
	 */
	public function render($text, $mode = AbstractApi::MODE_MARKDOWN, $context = '') {
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
	 * @return string
	 */
	public function renderRaw($file) {
		return $this->getApi()->setAccept('text/plain')->request(
			'/markdown/raw',
			Request::METHOD_POST,
			['file' => $file]
		);
	}
}