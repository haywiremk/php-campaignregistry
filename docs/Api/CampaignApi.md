# TCR\Client\CampaignApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**deactivateMyCampaign**](CampaignApi.md#deactivatemycampaign) | **DELETE** /campaign/{campaignId} | Deactivate my campaign
[**getMyCampaign**](CampaignApi.md#getmycampaign) | **GET** /campaign/{campaignId} | Get my campaign details
[**getMyCampaignMnoMetadata**](CampaignApi.md#getmycampaignmnometadata) | **GET** /campaign/{campaignId}/mnoMetadata | Get my campaign MNO metadata
[**getMyCampaignOperationStatus**](CampaignApi.md#getmycampaignoperationstatus) | **GET** /campaign/{campaignId}/operationStatus | Get campaign operation status at MNO level
[**getMyCampaignSharingStatus**](CampaignApi.md#getmycampaignsharingstatus) | **GET** /campaign/{campaignId}/sharing | Get my campaign sharing status
[**getMyOsrCampaignAttributes**](CampaignApi.md#getmyosrcampaignattributes) | **GET** /campaign/{campaignId}/osr/attributes | Get my campaign attributes from OSR
[**listMyCampaigns**](CampaignApi.md#listmycampaigns) | **GET** /campaign | Search my campaigns
[**shareMyCampaign**](CampaignApi.md#sharemycampaign) | **PUT** /campaign/{campaignId}/sharing/{upstreamCnpId} | Share my campaign to an upstream connectivity partner. ** Replaces elect primary DCA for campaign **
[**updateMyCampaign**](CampaignApi.md#updatemycampaign) | **PUT** /campaign/{campaignId} | Update my campaign properties

# **deactivateMyCampaign**
> deactivateMyCampaign($campaign_id)

Deactivate my campaign

Terminate an active campaign by removing the campaign from registry and OSR. A campaign cannot be restored once it is deactivated. CSP must apply for a new campaign. This API call is idenpotent.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $apiInstance->deactivateMyCampaign($campaign_id);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->deactivateMyCampaign: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |

### Return type

void (empty response body)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getMyCampaign**
> \TCR\Client\Model\CampaignCSP getMyCampaign($campaign_id)

Get my campaign details

Retrieve a campaign you registerd from TCR by a campaign ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getMyCampaign($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->getMyCampaign: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |

### Return type

[**\TCR\Client\Model\CampaignCSP**](../Model/CampaignCSP.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getMyCampaignMnoMetadata**
> object getMyCampaignMnoMetadata($campaign_id)

Get my campaign MNO metadata

The JSON resonse is a MAP data structure holding campaign MNO metaData for each MNO network campaign is submitted. MAP key contains MNO ID and MAP value contains the campaign metadata for corresponding MNO.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getMyCampaignMnoMetadata($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->getMyCampaignMnoMetadata: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |

### Return type

**object**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getMyCampaignOperationStatus**
> object getMyCampaignOperationStatus($campaign_id)

Get campaign operation status at MNO level

This operation returns a map of campaign operation status at each participating MNO. The key is MNO ID and the value corresponds to the campaign operation status. Valid statuses are 'APPROVED', 'REVIEW', 'REJECTED' and 'SUSPENDED'. Note: MNOs are encouraged, but not obligated to report campaign operation status to TCR.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getMyCampaignOperationStatus($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->getMyCampaignOperationStatus: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |

### Return type

**object**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getMyCampaignSharingStatus**
> \TCR\Client\Model\CampaignSharingChain getMyCampaignSharingStatus($campaign_id)

Get my campaign sharing status

Retrieves the sharing identity and status of my campaign to an upstream connectivity partner.The sharing status can be in one of several states: PENDING, ACCEPTED, or DECLINED

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getMyCampaignSharingStatus($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->getMyCampaignSharingStatus: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |

### Return type

[**\TCR\Client\Model\CampaignSharingChain**](../Model/CampaignSharingChain.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getMyOsrCampaignAttributes**
> object getMyOsrCampaignAttributes($campaign_id)

Get my campaign attributes from OSR

Get my campaign attributes published to NetNumber OSR system.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getMyOsrCampaignAttributes($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->getMyOsrCampaignAttributes: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |

### Return type

**object**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listMyCampaigns**
> \TCR\Client\Model\CampaignRecordSetCSP listMyCampaigns($reference_id, $brand_id, $status, $usecase, $vertical, $reseller_id, $auto_renewal, $upstream_cnp_id, $tag, $mock, $page, $records_per_page)

Search my campaigns

Search for campaigns you registered by any combination of 'brandId', 'resellerId', 'status', 'usecase', 'vertical'. This operation supports pagination with a maximum of 500 records per fetch. 'brandUid', 'resellerId', 'usecase' and 'vertical' if supplied must be an exact match.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$reference_id = "reference_id_example"; // string | Reference ID.
$brand_id = "brand_id_example"; // string | Must be an exact match if present
$status = "status_example"; // string | 
$usecase = "usecase_example"; // string | Must be an exact match if present
$vertical = "vertical_example"; // string | Must be an exact match if present
$reseller_id = "reseller_id_example"; // string | Must be an exact match if present
$auto_renewal = true; // bool | Campaign auto-renewal status
$upstream_cnp_id = "upstream_cnp_id_example"; // string | Upstream CNP whom you shared campaign
$tag = array("tag_example"); // string[] | Tag
$mock = true; // bool | Mock brand Default 'null' input returns both real and test campaigns.
$page = 1; // int | 
$records_per_page = 10; // int | Number of records per page. Max size is 500

try {
    $result = $apiInstance->listMyCampaigns($reference_id, $brand_id, $status, $usecase, $vertical, $reseller_id, $auto_renewal, $upstream_cnp_id, $tag, $mock, $page, $records_per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->listMyCampaigns: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **reference_id** | **string**| Reference ID. | [optional]
 **brand_id** | **string**| Must be an exact match if present | [optional]
 **status** | **string**|  | [optional]
 **usecase** | **string**| Must be an exact match if present | [optional]
 **vertical** | **string**| Must be an exact match if present | [optional]
 **reseller_id** | **string**| Must be an exact match if present | [optional]
 **auto_renewal** | **bool**| Campaign auto-renewal status | [optional]
 **upstream_cnp_id** | **string**| Upstream CNP whom you shared campaign | [optional]
 **tag** | [**string[]**](../Model/string.md)| Tag | [optional]
 **mock** | **bool**| Mock brand Default &#x27;null&#x27; input returns both real and test campaigns. | [optional]
 **page** | **int**|  | [optional] [default to 1]
 **records_per_page** | **int**| Number of records per page. Max size is 500 | [optional] [default to 10]

### Return type

[**\TCR\Client\Model\CampaignRecordSetCSP**](../Model/CampaignRecordSetCSP.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **shareMyCampaign**
> \TCR\Client\Model\CampaignSharingStatus shareMyCampaign($campaign_id, $upstream_cnp_id)

Share my campaign to an upstream connectivity partner. ** Replaces elect primary DCA for campaign **

This method is used to share my campaign with an upstream CNP. The upstream CNP, identified as 'upstreamCnpId' is given role-based readonly view of campaign properties to facilitate MNO onboarding. The upstream CNP may share the campaign with additional CNPs until a DCA is identified at the end of the chain. Once the campaign is shared by the downstream CNP, the invitation cannot be rescended or changed unless the upstream CNP declines the sharing request.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')
$upstream_cnp_id = "upstream_cnp_id_example"; // string | Alphanumeric identifier of your upstream connectivity partner.

try {
    $result = $apiInstance->shareMyCampaign($campaign_id, $upstream_cnp_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->shareMyCampaign: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |
 **upstream_cnp_id** | **string**| Alphanumeric identifier of your upstream connectivity partner. |

### Return type

[**\TCR\Client\Model\CampaignSharingStatus**](../Model/CampaignSharingStatus.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateMyCampaign**
> \TCR\Client\Model\Campaign updateMyCampaign($body, $campaign_id)

Update my campaign properties

This operation let's you update a campaign you registered. Not all fields are updateable.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\CampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\UpdateCampaign(); // \TCR\Client\Model\UpdateCampaign | Campaign properties to be updated.  Only subset of campaign properties can be updated.
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->updateMyCampaign($body, $campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CampaignApi->updateMyCampaign: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\UpdateCampaign**](../Model/UpdateCampaign.md)| Campaign properties to be updated.  Only subset of campaign properties can be updated. |
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |

### Return type

[**\TCR\Client\Model\Campaign**](../Model/Campaign.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

