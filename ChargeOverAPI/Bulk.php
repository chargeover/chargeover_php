<?php

if (!defined('JSON_PRETTY_PRINT'))
{
	define('JSON_PRETTY_PRINT', null);
}

class ChargeOverAPI_Bulk
{
	protected $_request;
	
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
		return json_encode($this->_request, JSON_PRETTY_PRINT);
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