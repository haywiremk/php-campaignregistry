# TCR\Client\WebhookApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**listEventCategories**](WebhookApi.md#listeventcategories) | **GET** /webhook/eventCategory | List all event categories
[**listEventTypes**](WebhookApi.md#listeventtypes) | **GET** /webhook/eventType | List all event types
[**listWebhook**](WebhookApi.md#listwebhook) | **GET** /webhook/subscription | List all webhook subscriptions
[**subscribeWebhook**](WebhookApi.md#subscribewebhook) | **PUT** /webhook/subscription | Subscribe API webhook
[**testWebhook**](WebhookApi.md#testwebhook) | **GET** /webhook/subscription/{eventCategory}/test | Test webhook by event (Deprecated)
[**testWebhook1**](WebhookApi.md#testwebhook1) | **GET** /webhook/subscription/eventType/{eventType}/mock | Send a mock webhook to your endpoint
[**unsubscribeWebhook**](WebhookApi.md#unsubscribewebhook) | **DELETE** /webhook/subscription/{eventCategory} | Unsubscribe webhook by event category

# **listEventCategories**
> string[] listEventCategories()

List all event categories

List all notification event categories available for webhook subscription. After subscribing to an event category, the subscribed endpoint will receive all events from the subscribed event category.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listEventCategories();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->listEventCategories: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string[]**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listEventTypes**
> \TCR\Client\Model\EventType[] listEventTypes()

List all event types

List all notification event types.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listEventTypes();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->listEventTypes: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\EventType[]**](../Model/EventType.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listWebhook**
> \TCR\Client\Model\WebhookSubscription[] listWebhook()

List all webhook subscriptions

List all registered webhook subscriptions

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listWebhook();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->listWebhook: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\WebhookSubscription[]**](../Model/WebhookSubscription.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **subscribeWebhook**
> \TCR\Client\Model\WebhookSubscription subscribeWebhook($body)

Subscribe API webhook

Subscribe to receive notifications of an \"event category\". Make sure your network policy allows HTTP POST to be accepted from internet.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\WebhookSubscription(); // \TCR\Client\Model\WebhookSubscription | WebhookSubscription schema to subscribe event notification

try {
    $result = $apiInstance->subscribeWebhook($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->subscribeWebhook: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\WebhookSubscription**](../Model/WebhookSubscription.md)| WebhookSubscription schema to subscribe event notification |

### Return type

[**\TCR\Client\Model\WebhookSubscription**](../Model/WebhookSubscription.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **testWebhook**
> object testWebhook($event_category)

Test webhook by event (Deprecated)

Test an existing webhook subscription to a particular event category. To get started, you must first subscribe to events from an event category using /webhook/subscription PUT operation. Make sure your network policy allows HTTP POST to be accepted from TCR.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$event_category = "event_category_example"; // string | 

try {
    $result = $apiInstance->testWebhook($event_category);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->testWebhook: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **event_category** | **string**|  |

### Return type

**object**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **testWebhook1**
> \TCR\Client\Model\WebhookResponse testWebhook1($event_type)

Send a mock webhook to your endpoint

Send a mock webhook event to a webhook subscriber endpoint. To get started, you must first subscribe to events from an event category using /webhook/subscription PUT operation. Make sure your network policy allows HTTP POST to be accepted from TCR.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$event_type = "event_type_example"; // string | 

try {
    $result = $apiInstance->testWebhook1($event_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->testWebhook1: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **event_type** | **string**|  |

### Return type

[**\TCR\Client\Model\WebhookResponse**](../Model/WebhookResponse.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **unsubscribeWebhook**
> unsubscribeWebhook($event_category)

Unsubscribe webhook by event category

Stop receiving webhook notifications from a \"event category\".

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\WebhookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$event_category = "event_category_example"; // string | 

try {
    $apiInstance->unsubscribeWebhook($event_category);
} catch (Exception $e) {
    echo 'Exception when calling WebhookApi->unsubscribeWebhook: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **event_category** | **string**|  |

### Return type

void (empty response body)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

