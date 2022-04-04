# TCR\Client\PlatformApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getProfile**](PlatformApi.md#getprofile) | **GET** /csp/profile | Get current profile
[**getVersion**](PlatformApi.md#getversion) | **GET** /version | Software version

# **getProfile**
> \TCR\Client\Model\CspProfile getProfile()

Get current profile

Retrieve current profile information.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PlatformApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getProfile();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlatformApi->getProfile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\CspProfile**](../Model/CspProfile.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getVersion**
> getVersion()

Software version

Get software version of this API

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PlatformApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->getVersion();
} catch (Exception $e) {
    echo 'Exception when calling PlatformApi->getVersion: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: text/plain

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

