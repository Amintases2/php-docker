<?php

namespace PFW\Framework\Http;

class Response
{
	public function __construct(
		private string | array $content = '',
		private int $statusCode = 200,
		private array $headers = []
	) {
		http_response_code($this->statusCode);
	}

	public function send(): void
	{
		header('Access-Control-Allow-Origin', '*');
		header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
		if (is_array($this->content)) {
			header('Content-Type: application/json');
			echo json_encode($this->content);
		} else if (is_string($this->content)) {
			header('Content-Type: text/html');
			echo $this->content;
		}
	}

	public function setContent(string $content): Response
	{
		$this->content = $content;
		return $this;
	}
}
