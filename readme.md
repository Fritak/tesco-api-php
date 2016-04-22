Library for communication with TESCO api.
========================

This code is for communication with NEW tescolabs API.

I will update this library when they add new features.

INSTALLATION
------------

```
composer require "fritak/tesco-api-php"
```

REQUIREMENTS
------------
The minimum requirement is PHP 5.4 on your Web Server.
Account on tescolabs page: https://devportal.tescolabs.com/signin


## SETUP
```php
// For Grocery
$api = new TescoApi(new Config('first_key', 'second_key'));
```

## SIMPLE USAGE
```php
// Find product based on you QUERY.
$result = $api->findGroceryProduct('pizza');

foreach($result->getProducts() AS $product)
{
    // your code for product...
}
```

## USAGE
```php
// Find product based on you QUERY with limit 25, starting on 10.
$result = $api->findGroceryProduct('pizza', 25, 10);

// Total products
$result->getGrocery()->products->totals->all;
```

