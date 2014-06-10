<?php

class ChargeOverAPI_Object_Package extends ChargeOverAPI_Object
{
	const PAYMETHOD_CREDITCARD = 'crd';
	const PAYMETHOD_ACH = 'ach';
	const PAYMENTHOD_INVOICE = 'inv';

	const PAYCYCLE_WEEKLY = '1wk';
	const PAYCYCLE_EVERYOTHERWEEK = '2wk';
	const PAYCYCLE_TWOWEEKS = '2wk';
	const PAYCYCLE_TWOMONTHS = '2mn';
	const PAYCYCLE_MONTHLY = 'mon';
	const PAYCYCLE_QUARTERLY = 'qtr';
	const PAYCYCLE_YEARLY = 'yrl';
	const PAYCYCLE_SIXMONTHS = 'six';
}