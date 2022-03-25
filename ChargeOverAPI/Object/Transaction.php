<?php

class ChargeOverAPI_Object_Transaction extends ChargeOverAPI_Object
{
	const TYPE_PAYMENT = 'pay';
	const TYPE_REFUND = 'ref';
	const TYPE_CREDIT = 'cre';
	const TYPE_SPLIT = 'spl';

	const GATEWAY_METHOD_VISA = 'visa';
	const GATEWAY_METHOD_MASTERCARD = 'mastercard';
	const GATEWAY_METHOD_AMERICANEXPRESS = 'american-express';
	const GATEWAY_METHOD_DISCOVER = 'discover';
	const GATEWAY_METHOD_CHECK = 'check';
	const GATEWAY_METHOD_PAYPAL = 'paypal';
	const GATEWAY_METHOD_CREDIT = 'credit';
	const GATEWAY_METHOD_ACH = 'ach';
}
