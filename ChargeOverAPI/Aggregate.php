<?php

if (!defined('JSON_PRETTY_PRINT'))
{
	define('JSON_PRETTY_PRINT', null);
}

class ChargeOverAPI_Aggregate
{
	protected $_request;
	
	public function __construct($request = array())
	{
		$this->_request = $this->_massage($request);
	}

	protected function _massage($arr)
	{
		$defaults = array(
			'fields' => array(), 
			'where' => array(), 
			'object' => array(), 
			'group' => '', 
			);

		return array_merge($defaults, $arr);
	}

	public function addWhere($field, $op, $value)
	{
		$this->_request['where'][] = $field . ':' . $op . ':' . $value;
	}

	public function addField($field, $op = null)
	{
		if ($op)
		{
			$field = strtoupper($op) . '(' . $field . ')';
		}

		$this->_request['fields'][] = $field;
	}

	public function addGroup($field)
	{
		$this->_request['group'][] = $field;
	}

	public function setObject($obj)
	{
		$this->_request['object'] = $obj;
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