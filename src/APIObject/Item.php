<?php

namespace ChargeOver\APIObject;

class Item extends \ChargeOver\APIObject
{
	const TYPE_SERVICE = 'service';
	const TYPE_PRODUCT = 'product';
	const TYPE_DISCOUNT = 'discount';

	const PRICEMODEL_FLAT = 'fla';
	const PRICEMODEL_VOLUME = 'vol';
	const PRICEMODEL_TIERED = 'tie';
	const PRICEMODEL_UNIT = 'uni';
}
