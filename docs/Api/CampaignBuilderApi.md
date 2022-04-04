# TCR\Client\CampaignBuilderApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**qualifyAllUsecases**](CampaignBuilderApi.md#qualifyallusecases) | **GET** /campaignBuilder/brand/{brandId} | Campaign builder Step 1: Qualify brand for all usecases
[**qualifyByUsecase**](CampaignBuilderApi.md#qualifybyusecase) | **GET** /campaignBuilder/brand/{brandId}/usecase/{usecase} | Campaign builder Step 1: Qualify brand by usecase
[**submitCampaign**](CampaignBuilderApi.md#submitcampaign) | **POST** /campaignBuilder | Campaign builder Step 2: Create new campaign

# **qualifyAllUsecases**
> \TCR\Client\Model\UsecaseMetadata[] qualifyAllUsecases($brand_id)

Campaign builder Step 1: Qualify brand for all usecases

This operation determines if a brand is qualified to run a campaign across participating MNOs for all use-case types. If the brand qualifies to run the campaign on one or more MNOs, this API call returns restrictions (i.e. no embedded link), process (i.e. manual review), pricing (e.g. surcharge) and MNO specific attributes (e.g. AT&T message class). If the brand is not qualified to run the desired usecase on any MNO, CSP may consider having brand vetted to achieve access to broader usecases.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignBuilderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')

try {
    $result = $apiInstance->qualifyAllUsecases($brand_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignBuilderApi->qualifyAllUsecases: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |

### Return type

[**\TCR\Client\Model\UsecaseMetadata[]**](../Model/UsecaseMetadata.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **qualifyByUsecase**
> object qualifyByUsecase($brand_id, $usecase)

Campaign builder Step 1: Qualify brand by usecase

This operation determines if a brand is qualified to run a campaign of a desired usecase across participating MNOs.  If the brand qualifies to run the campaign on one or more MNOs, this API call returns restrictions (i.e. no embedded link), process (i.e. manual review), pricing (e.g. surcharge) and MNO specific attributes (e.g. AT&T message class). If the brand is not qualified to run the desired usecase on any MNO, CSP may consider having brand vetted to achieve access to broader usecases.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignBuilderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')
$usecase = "usecase_example"; // string | Campaign usecase. E.g. 2FA

try {
    $result = $apiInstance->qualifyByUsecase($brand_id, $usecase);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignBuilderApi->qualifyByUsecase: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |
 **usecase** | **string**| Campaign usecase. E.g. 2FA |

### Return type

**object**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **submitCampaign**
> object submitCampaign($body)

Campaign builder Step 2: Create new campaign

Creates a new TCR campaign and optionally sets tags on it. If the submitted campaign request meets the requirement for at least one MNO, the Campaign is provisioned in TCR and the campaign registration fee will be charged to the CSP account. The newly created campaign is assigned a 'campaign_id' in TCR. Additionally, the JSON response contains MNO metadata pertaining to the submitted campaign. Please refer to the response JSON data structure description for more information about MNO metadata. Standard use-case campaigns are approved upon submission while some special use-case campaigns require manual approval by MNOs. You can query for campaign MNO operation status via an API call to GET /campaign/{campaignId}/operationStatus. Campaigns created from mock brands are not functional campaigns. They cannot be shared upstream to CNP and are not registered in NetNumber OSR. All mock brands will be automatically deleted 30 days after initial registration. Deletion will cascade across all campaigns created from mock brands.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignBuilderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\CampaignRequest(); // \TCR\Client\Model\CampaignRequest | Campaign request to be submitted

try {
    $result = $apiInstance->submitCampaign($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignBuilderApi->submitCampaign: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\CampaignRequest**](../Model/CampaignRequest.md)| Campaign request to be submitted |

### Return type

**object**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

