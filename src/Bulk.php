<?php

namespace ChargeOver;

class Bulk
{
	protected $_request;
    protected $_prettyPrint = false;

	public function __construct()
	{
		$this->_request = array();
	}

	public function bulk($method, $uri, $payload = null)
	{
		$this->_request[] = array(
			'request_method' => $method,
			'uri' => $uri,
			'payload' => $payload,
			);
	}

	protected function toJSON()
	{
		return json_encode($this->_request, $this->_prettyPrint);
	}

	public function toArray()
	{
		return $this->_request;
	}

	public function __toString()
	{
		return $this->toJSON();
	}
}
