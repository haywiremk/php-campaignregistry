# TCR\Client\MockCVTokenApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createMockCvToken**](MockCVTokenApi.md#createmockcvtoken) | **POST** /brand/{brandId}/externalVetting/mockCvToken | Generate mock CV token for Non-production environments

# **createMockCvToken**
> string createMockCvToken($brand_id, $locale, $valid_until)

Generate mock CV token for Non-production environments

CV token can ONLY be used in QA and STAGING environments. It cannot be used in PRODUCTION environment.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\MockCVTokenApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$brand_id = "brand_id_example"; // string | 
$locale = "locale_example"; // string | 
$valid_until = "valid_until_example"; // string | 

try {
    $result = $apiInstance->createMockCvToken($brand_id, $locale, $valid_until);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MockCVTokenApi->createMockCvToken: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **brand_id** | **string**|  |
 **locale** | **string**|  | [optional]
 **valid_until** | **string**|  | [optional]

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/x-www-form-urlencoded
 - **Accept**: text/plain

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

