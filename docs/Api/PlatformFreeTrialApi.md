# TCR\Client\PlatformFreeTrialApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getPftBrand**](PlatformFreeTrialApi.md#getpftbrand) | **GET** /pft/brand | Get my Platform Free Trial brand
[**insertPlatformFreeTrialParticipant**](PlatformFreeTrialApi.md#insertplatformfreetrialparticipant) | **POST** /pft/participant | Report new platform free trial account provisioning event

# **getPftBrand**
> \TCR\Client\Model\BrandCSP getPftBrand()

Get my Platform Free Trial brand

This brand ID is to be used exclusively for registering TRIAL use-case campaigns. This PFT brand is provisioned by the TCR team. If this API endpoint returns error code 502, then it means the PFT-brand has not been provisioned by the TCR team.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PlatformFreeTrialApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getPftBrand();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlatformFreeTrialApi->getPftBrand: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\BrandCSP**](../Model/BrandCSP.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **insertPlatformFreeTrialParticipant**
> insertPlatformFreeTrialParticipant($body)

Report new platform free trial account provisioning event

CSP must report users participating in the platform free trial program. This information should be reported on a real-time basis when a 10DLC/long code is assigned to the participating trial user. There is no need to report de-provisioning activities. If the CSP is reporting platform free trial provisioning activities for a CSP managed ISV account, the ISV must be registered as a 'reseller' and identified through the 'resellerId' parameter.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PlatformFreeTrialApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\NewPlatformFreeTrialParticipant(); // \TCR\Client\Model\NewPlatformFreeTrialParticipant | Platform Free Trial Provisioning Participant

try {
    $apiInstance->insertPlatformFreeTrialParticipant($body);
} catch (Exception $e) {
    echo 'Exception when calling PlatformFreeTrialApi->insertPlatformFreeTrialParticipant: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\NewPlatformFreeTrialParticipant**](../Model/NewPlatformFreeTrialParticipant.md)| Platform Free Trial Provisioning Participant |

### Return type

void (empty response body)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

