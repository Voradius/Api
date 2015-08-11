# Voradius API

This library is aimed at wrapping the Voradius API in a simple package. 

## Table Of Content

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [General Example](#general)

<a name="requirements"></a>
## Requirements

This library uses PHP 5.4+.

To use the API, you have to request an access key from Voradius. For every request, you will have to provide the Access Key.

<a name="installation"></a>
## Installation

It is recommended that you install the PHP API Wrapper library [through composer](http://getcomposer.org/). To do so,
add the following lines to your ``composer.json`` file.

```JSON
{
    "require": {
        "Voradius/api": "dev-master"
    }
}
```

<a name="general"></a>
## General example

All Entity classes need a Client object supplied on creating an object, with both the API Key and Environment supplied, as below.

Valid environments for external usage are:
* SANDBOX (for testing)
* LIVE

`````
$client = new Voradius\Client('API_KEY_HERE', Voradius\Client::SANDBOX]);
$productApi = new Entity\Product($client);
````

After creating the entity object it is possible to use the several methods provided in this entity, e.g.:

````
$product = $productApi->getById(1000);
````

All entities check for valid input and build the request to the Voradius API for you. Errors are thrown by the Guzzle library, else the content is just returned directly to you. In most cases this will be a JSON formatted string. We don't manipulate the data on return, giving you all the freedom to perform caching and/or manipulate the data before usage.

