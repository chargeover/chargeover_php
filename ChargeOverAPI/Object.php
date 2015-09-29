<?php

if (!defined('JSON_PRETTY_PRINT'))
{
	define('JSON_PRETTY_PRINT', null);
}

class ChargeOverAPI_Object
{
	const TYPE_CUSTOMER = 'customer';
	const TYPE_BILLINGPACKAGE = 'billing_package';
	const TYPE_PACKAGE = 'package';
	const TYPE_PROJECT = 'project';
	const TYPE_USER = 'user';
	const TYPE_ITEM = 'item';
	const TYPE_ITEMCATEGORY = 'item_category';
	const TYPE_INVOICE = 'invoice';
	const TYPE_CREDITCARD = 'creditcard';
	const TYPE_TRANSACTION = 'transaction';
	const TYPE_ACH = 'ach';
	const TYPE_USAGE = 'usage';
	const TYPE_NOTE = 'note';
	const TYPE_COUNTRY = 'country';
	const TYPE_TOKENIZED = 'tokenized';

	const TYPE_RESTHOOK = '_resthook';

	//protected $_arr;
	
	public function __construct($arr = array())
	{
		//$this->_arr = $arr;
		
		if (is_array($arr))
		{
			foreach ($arr as $key => $value)
			{
				$this->$key = $value;
			}
		}
	}
	
	/**
	 * 
	 */
	public static function transformMethodToField($method)
	{
		$strip = array(
			'set', 
			'get', 
			'add', 
			);

		foreach ($strip as $prefix)
		{
			if (substr($method, 0, strlen($prefix)) == $prefix)
			{
				$method = substr($method, strlen($prefix));
				break;
			}
		}

		$last = 0;

		$parts = array();
		$len = strlen($method);
		for ($i = 0; $i < $len; $i++)
		{
			if ($method{$i} >= 'A' and $method{$i} <= 'Z')
			{
				$parts[] = substr($method, $last, $i - $last);
				$last = $i;
			}
		}

		$parts[] = substr($method, $last);

		//print_r($parts);

		return strtolower(trim(implode('_', $parts), '_'));
	}

	public static function transformFieldToMethod($field, $prefix = 'set')
	{
		$last = 0;

		$parts = array();
		$len = strlen($field);
		for ($i = 0; $i < $len; $i++)
		{
			if ($field{$i} == '_')
			{
				$parts[] = ucfirst(substr($field, $last, $i));
				$i++;
				$last = $i;				
			}
		}

		$parts[] = ucfirst(substr($field, $last));

		return $prefix . implode('', $parts);
	}

	public function __call($name, $args)
	{
		if (substr($name, 0, 3) == 'set')
		{
			$field = ChargeOverAPI_Object::transformMethodToField($name);
			//$this->_arr[$field] = current($args);
			$this->$field = current($args);
			return true;
		}
		else if (substr($name, 0, 3) == 'get')
		{
			$field = ChargeOverAPI_Object::transformMethodToField($name);

			//print('transformed [' . $name . ' to ' . $field . ']' . "\n");

			if (array_key_exists(0, $args) and 			// Trying to get a specific element, e.g.   getLineItems(2) 
				is_numeric($args[0]))
			{
				//if (!empty($this->_arr[$field][$args[0]]))
				if (!empty($this->$field[$args[0]]))
				{
					return $this->$field[$args[0]];
					//return $this->_arr[$field][$args[0]];
				}

				return null;
			}
			//else if (array_key_exists($field, $this->_arr))
			else if (property_exists($this, $field))
			{
				return $this->$field;
				//return $this->_arr[$field];
			}

			return null;
		}
		else if (substr($name, 0, 3) == 'add')
		{
			$field = ChargeOverAPI_Object::transformMethodToField($name);

			//if (!isset($this->_arr[$field]))
			if (!isset($this->$field))
			{
				//$this->_arr[$field] = array();
				$this->$field = array();
			}

			$Obj = current($args);
			//$this->_arr[$field][] = $Obj;
			array_push($this->$field, $Obj);
		}
	}

	protected function _massage($val)
	{
		if (is_object($val))
		{
			$val = $val->toArray();
		}
		else if (is_array($val))
		{
			foreach ($val as $key => $value)
			{
				$val[$key] = $this->_massage($value);
			}
		}
	
		return $val;
	}

	protected function toJSON()
	{
		$vars = get_object_vars($this);
		$arr = $this->_massage($vars);
		
		return json_encode($arr, JSON_PRETTY_PRINT);
	}

	public function toArray()
	{
		$vars = get_object_vars($this);
		return $this->_massage($vars);
	}

	public function __toString()
	{
		return $this->toJSON();
	}
}