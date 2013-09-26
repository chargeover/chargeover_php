<?php

define('CHARGEOVERAPI_BASEDIR', dirname(__FILE__));

require_once CHARGEOVERAPI_BASEDIR . '/ChargeOverAPI/Loader.php';

ChargeOverAPI_Loader::load('/ChargeOverAPI/Object.php');

ChargeOverAPI_Loader::import('/ChargeOverAPI/Object/');

class ChargeOverAPI
{
	const AUTHMODE_SIGNATURE_V1 = 'signature-v1';
	const AUTHMODE_HTTP_BASIC = 'http-basic';
	
	const METHOD_CREATE = 'create';
	const METHOD_MODIFY = 'modify';
	const METHOD_DELETE = 'delete';
	const METHOD_GET = 'get';
	const METHOD_FIND = 'find';
	const METHOD_ACTION = 'action';
	
	const STATUS_OK = 'OK';
	const STATUS_ERROR = 'Error';
	
	protected $_url;
	protected $_authmode;
	protected $_username;
	protected $_password;
	
	protected $_last_request;
	protected $_last_response;
	protected $_last_error;
	
	public function __construct($url, $authmode, $username, $password)
	{
		$this->_url = rtrim($url, '/');
		$this->_authmode = $authmode;
		$this->_username = $username;
		$this->_password = $password;
		
		$this->_last_request = null;
		$this->_last_response = null;
		$this->_last_error = null;
		
		
	}
	
	protected function _signature($public, $private, $url, $data)
	{
		$tmp = array_merge(range('a', 'z'), range(0, 9));
		shuffle($tmp);
		$nonce = implode('', array_slice($tmp, 0, 8));
		
		$time = time();
		
		$str = $public . '||' . strtolower($url) . '||' . $nonce . '||' . $time . '||' . $data;
		$signature = hash_hmac('sha256', $str, $private);
		
		return 'Authorization: ChargeOver co_public_key="' . $public . '" co_nonce="' . $nonce . '" co_timestamp="' . $time . '" co_signature_method="HMAC-SHA256" co_version="1.0" co_signature="' . $signature . '" ';
	}
	
	protected function _request($method, $uri, $data = null)
	{
		$public = $this->_username;
		$private = $this->_password;
		
		$endpoint = $this->_url . '/' . ltrim($uri, '/');
		
		/*
		if (false === strpos($endpoint, '?'))
		{
			$endpoint .= '?debug=1';
		}
		else
		{
			$endpoint .= '&debug=1';
		}
		*/
		
		$headers = array();
		$headers[] = 'Content-Type: application/json';
		
		// create a new cURL resource
		$ch = curl_init();
		
		if ($this->_authmode == ChargeOverAPI::AUTHMODE_SIGNATURE_V1)
		{
			// Signed requests
			$signature = $this->_signature($public, $private, $endpoint, $data);
			
			$headers[] = $signature;
		}
		else if ($this->_authmode == ChargeOverAPI::AUTHMODE_HTTP_BASIC)
		{
			// HTTP basic
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, $public . ':' . $private);
		}
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' ));
		
		if ($data)
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		
		// Build last request string
		$this->_last_request = $method . ' ' . $endpoint . "\r\n\r\n";
		if ($data)
		{
			$this->_last_request .= json_encode($data);
		}
		
		$out = curl_exec($ch);
		$info = curl_getinfo($ch);

		curl_close($ch);
		
		// Log last response
		$this->_last_response = $out;
		
		if (!$out)
		{
			$this->_last_error = 'Problem hitting URL [' . $endpoint . ']: ' . print_r(curl_getinfo($ch), true);
			return false;
		}
		
		$data = json_decode($out);

		if (json_last_error() == JSON_ERROR_NONE)
		{
			// We at least got back a valid JSON object
			return $data;
		}

		// The response we got back wasn't valid JSON...? 
		return json_decode(json_encode(array( 
			'code' => 500, 			// let's force this to a 500 error instead, it's non-recoverable    $info['http_code'],
			'status' => ChargeOverAPI::STATUS_ERROR, 
			'message' => 'Server returned an invalid JSON response: ' . $out . ', JSON parser returned error: ' . json_last_error(), 
			'response' => null, 
			)));
	}
	
	public function lastRequest()
	{
		return $this->_last_request;
	}
	
	public function lastResponse()
	{
		return $this->_last_response;
	}
	
	public function lastError()
	{
		return $this->_last_error;
	}
	
	public function isError($Object)
	{
		//print_r($Object);

		if (!is_object($Object))
		{
			return true;
		}
		else if ($Object->status != ChargeOverAPI::STATUS_OK)
		{
			return true;
		}
		
		return false;
	}
	
	protected function _map($method, $id, $Object_or_obj_type)
	{
		if (is_object($Object_or_obj_type))
		{
			$obj_type = '';

			switch (get_class($Object_or_obj_type))
			{
				case 'ChargeOverAPI_Object_Customer':
					$obj_type = ChargeOverAPI_Object::TYPE_CUSTOMER;
					break;
				case 'ChargeOverAPI_Object_User':
					$obj_type = ChargeOverAPI_Object::TYPE_USER;
					break;
				case 'ChargeOverAPI_Object_BillingPackage':
					$obj_type = ChargeOverAPI_Object::TYPE_BILLINGPACKAGE;
					break;
				case 'ChargeOverAPI_Object_CreditCard':
					$obj_type = ChargeOverAPI_Object::TYPE_CREDITCARD;
					break;
				case 'ChargeOverAPI_Object_Invoice':
					$obj_type = ChargeOverAPI_Object::TYPE_INVOICE;
					break;
				case 'ChargeOverAPI_Object_Transaction':
					$obj_type = ChargeOverAPI_Object::TYPE_TRANSACTION;
					break;
				case 'ChargeOverAPI_Object_Ach':
					$obj_type = ChargeOverAPI_Object::TYPE_ACH;
					break;
			}
		}
		else
		{
			$obj_type = $Object_or_obj_type;
		}
		
		if ($method == ChargeOverAPI::METHOD_CREATE)
		{
			$id = null;
		}
		
		if ($id)
		{
			return $obj_type . '/' . $id;
		}
		else
		{
			return $obj_type;
		}
	}
	
	public function rawRequest($method, $uri, $data)
	{
		
	}
	
	public function action($type, $id, $action, $data = array())
	{
		$uri = $this->_map(ChargeOverAPI::METHOD_ACTION, $id, $type);

		if (is_object($data))
		{
			$data = $data->toArray();
		}

		$uri .= '?action=' . $action;

		return $this->_request('POST', $uri, $data);
	}

	public function create($Object)
	{
		$uri = $this->_map(ChargeOverAPI::METHOD_CREATE, null, $Object);
		
		return $this->_request('POST', $uri, $Object->toArray());
	}
	
	public function modify($id, $Object)
	{
		$uri = $this->_map(ChargeOverAPI::METHOD_MODIFY, $id, $Object);

		return $this->_request('PUT', $uri, $Object->toArray());
	}
	
	public function find($type, $where, $offset = 0, $limit = null)
	{
		$uri = $this->_map(ChargeOverAPI::METHOD_FIND, null, $type);

		foreach ($where as $key => $value)
		{
			$where[$key] = urlencode($value);
		}

		$uri .= '?where=' . implode(',', $where);

		if ($offset or $limit)
		{
			$uri .= '&offset=' . ((int) $offset) . '&limit=' . ((int) $limit);
		}

		return $this->_request('GET', $uri);
	}

	public function delete($type, $id)
	{
		$uri = $this->_map(ChargeOverAPI::METHOD_DELETE, $id, $type);

		return $this->_request('DELETE', $uri);
	}

	public function findById($type, $id)
	{
		$uri = $this->_map(ChargeOverAPI::METHOD_FIND, $id, $type);

		return $this->_request('GET', $uri);
	}
}