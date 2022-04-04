# TCR\Client\ResellerApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createReseller**](ResellerApi.md#createreseller) | **POST** /reseller | Create a new reseller
[**deleteReseller**](ResellerApi.md#deletereseller) | **DELETE** /reseller/{resellerId} | Delete reseller
[**getReseller**](ResellerApi.md#getreseller) | **GET** /reseller/{resellerId} | Get reseller details
[**listResellers**](ResellerApi.md#listresellers) | **GET** /reseller | Search resellers
[**updateReseller**](ResellerApi.md#updatereseller) | **PUT** /reseller/{resellerId} | Update reseller

# **createReseller**
> \TCR\Client\Model\Reseller createReseller($body)

Create a new reseller

Create a reseller/large account which helps csp to identify campaigns that belong to this reseller.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\ResellerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\Reseller(); // \TCR\Client\Model\Reseller | Reseller to be created

try {
    $result = $apiInstance->createReseller($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResellerApi->createReseller: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\Reseller**](../Model/Reseller.md)| Reseller to be created |

### Return type

[**\TCR\Client\Model\Reseller**](../Model/Reseller.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteReseller**
> deleteReseller($reseller_id)

Delete reseller

Delete reseller profile from TCR by the unique identifier assigned to it. Reseller can not be deleted if the profile is associated with one or more campaigns.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\ResellerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$reseller_id = "reseller_id_example"; // string | Alphanumeric identifier (prefixed with letter 'R') returned from the reseller creation operation.

try {
    $apiInstance->deleteReseller($reseller_id);
} catch (Exception $e) {
    echo 'Exception when calling ResellerApi->deleteReseller: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **reseller_id** | **string**| Alphanumeric identifier (prefixed with letter &#x27;R&#x27;) returned from the reseller creation operation. |

### Return type

void (empty response body)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getReseller**
> \TCR\Client\Model\Reseller getReseller($reseller_id)

Get reseller details

Retrieve reseller record from TCR by the unique identifier assigned to it.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\ResellerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$reseller_id = "reseller_id_example"; // string | Alphanumeric identifier (prefixed with letter 'R') returned from the reseller creation operation.

try {
    $result = $apiInstance->getReseller($reseller_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResellerApi->getReseller: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **reseller_id** | **string**| Alphanumeric identifier (prefixed with letter &#x27;R&#x27;) returned from the reseller creation operation. |

### Return type

[**\TCR\Client\Model\Reseller**](../Model/Reseller.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listResellers**
> \TCR\Client\Model\ResellerRecordSet listResellers($company_name, $page, $records_per_page)

Search resellers

Search for existing reseller by an optional 'companyName'. This operation supports pagination with a maximum of 500 records per fetch.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\ResellerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_name = "company_name_example"; // string | Business name of the reseller or DBA. Partial spelling accepted.
$page = 1; // int | 
$records_per_page = 10; // int | Number of records per page. Max size is 500

try {
    $result = $apiInstance->listResellers($company_name, $page, $records_per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResellerApi->listResellers: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **company_name** | **string**| Business name of the reseller or DBA. Partial spelling accepted. | [optional]
 **page** | **int**|  | [optional] [default to 1]
 **records_per_page** | **int**| Number of records per page. Max size is 500 | [optional] [default to 10]

### Return type

[**\TCR\Client\Model\ResellerRecordSet**](../Model/ResellerRecordSet.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateReseller**
> \TCR\Client\Model\Reseller updateReseller($body, $reseller_id)

Update reseller

Update reseller contact information.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\ResellerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\UpdateReseller(); // \TCR\Client\Model\UpdateReseller | Reseller properties to be updated
$reseller_id = "reseller_id_example"; // string | Alphanumeric identifier (prefixed with letter 'R') returned from reseller creation operation.

try {
    $result = $apiInstance->updateReseller($body, $reseller_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ResellerApi->updateReseller: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\UpdateReseller**](../Model/UpdateReseller.md)| Reseller properties to be updated |
 **reseller_id** | **string**| Alphanumeric identifier (prefixed with letter &#x27;R&#x27;) returned from reseller creation operation. |

### Return type

[**\TCR\Client\Model\Reseller**](../Model/Reseller.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

