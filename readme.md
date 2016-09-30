# Liteview API

[![StyleCI](https://styleci.io/repos/69515926/shield?style=flat&branch=master)](https://styleci.io/repos/69515926)
[![Build Status](https://travis-ci.org/GigaSavvy/liteview-api.svg?branch=master)](https://travis-ci.org/GigaSavvy/liteview-api)
[![Latest Stable Version](https://poser.pugx.org/gigasavvy/liteview-api/v/stable)](https://packagist.org/packages/gigasavvy/liteview-api)
[![Total Downloads](https://poser.pugx.org/gigasavvy/liteview-api/downloads)](https://packagist.org/packages/gigasavvy/liteview-api)
[![Latest Unstable Version](https://poser.pugx.org/gigasavvy/liteview-api/v/unstable)](https://packagist.org/packages/gigasavvy/liteview-api)

Liteview API is a PHP wrapper around the Liteview REST API. It provides a lightweight and flexible interface for communicating with Liteview's ecommerce fulfillment services.

### Installation

Install via composer:

```
composer require gigasavvy/liteview-api
```

### Basic Usage

To make a connection to the API, create a new instance of `Liteview\Connection`, passing in your **username** and **appkey** credentials to the constructor:

```php
use Liteview\Connection;

$connection = new Connection('username', 'key');
```

Behind the scenes, an HTTP client is created with the proper headers and data needed to successfully access the API. To make calls to the API, simply call the supported HTTP verbs as methods of the Connection class. The first parameter is the resource URI to access. The second (optional) parameter is the body to send with the request. This should be a valid XML string.

```php
// Get all supported order methods.
$orderResponse = $connection->get('order/methods');

// Submit a new order
$connection->post('order/submit', $xmlString);
```

### XML Sucks

XML in a REST API is like hamburgers at a Mexican restaurant. Unfortunately, Liteview uses XML for the request and response payload. Fortunately, this package utilizes the [Gestalt Configuration Package](https://github.com/samrap/gestalt), allowing you to define default XML configurations and modify them as objects before sending a request.

To get started, head over to the [Liteview API Documentation](https://liteviewapi.imaginefulfillment.com/) for examples of the XML payload for each resource. You can copy these exmaples into individual XML files and edit them as you would like. Once you have defined the default skeleton of your XML request(s), it is likely you will want to dynamically populate/modify different nodes of the XML document. This is where the `Liteview\Api\Resources\Resource` class comes in.

The `Resource` class extends the `Gestalt\Configuration` object and is intended to represent your XML payloads as a Gestalt Configuration object. It defines an additional `toXml()` method which you should call before passing it to an API request. Let's look at an example of using the `Resource` class to prepare a resource request:

```php
use Liteview\Connection;
use Liteview\Api\Resources\Resource;
use Liteview\Api\Resources\ResourceLoader;

// Create a new Resource instance using the ResourceLoader, which
// converts the given XML file to an associative array.
$order = Resource::create(new ResourceLoader('order_submit.xml'));

$order->set('order_status', 'Active');

$connection = new Connection('username', 'key');
$connection->post('order/submit', $order->toXml());
```

Here we can see a full example of creating a `Resource` object from an XML file using the power of Gestalt's [Custom Loaders](https://github.com/samrap/gestalt-docs/blob/master/loaders.md). We can then use any of the Gestalt Configuration methods to modify our XML configuration before finally sending it off to the connection's `post` method.

With this flexibility we can define our XML once and modify it at runtime without worrying about XML syntax or the headache of working directly with a `SimpleXMLElement` or the like. Have a look at [Gestalt's documentation](https://github.com/samrap/gestalt-docs) for more information on using the package.

### Appendix

#### Helpers

The Liteview API package defines some global helper functions that may be used as well.

---

```php
string array_to_xml(array $data, SimpleXMLElement &$xml)
```

**array_to_xml()** takes an associative array of XML data and parses it into the given `SimpleXMLElement`. 

---

```php
array xml_to_array(mixed $xml)
```

**xml_to_array()** takes a UTF-8 encoded XML string or object and converts it into an associative array.

---

```php
bool is_assoc(array $arr)
```

**is_assoc()** takes an array and determines whether it is associative or not.

---

### Conclusion

More features and documentation coming soon.
