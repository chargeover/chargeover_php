<?php

class ChargeOverAPI_Object
{
	protected $_arr;
	
	public function __construct($arr)
	{
		$this->_arr = $arr;
	}
	
	public function toArray()
	{
		return $this->_arr;
	}
}