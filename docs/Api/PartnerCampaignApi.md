# TCR\Client\PartnerCampaignApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**declineSharedPartnerCampaign**](PartnerCampaignApi.md#declinesharedpartnercampaign) | **DELETE** /partnerCampaign/{campaignId}/sharing | Decline partner campaign sharing request
[**getPartnerCampaign**](PartnerCampaignApi.md#getpartnercampaign) | **GET** /partnerCampaign/{campaignId} | Get partner shared campaign details
[**getPartnerCampaignMnoMetadata**](PartnerCampaignApi.md#getpartnercampaignmnometadata) | **GET** /partnerCampaign/{campaignId}/mnoMetadata | Get partner campaign MNO metadata
[**getPartnerCampaignOperationStatus**](PartnerCampaignApi.md#getpartnercampaignoperationstatus) | **GET** /partnerCampaign/{campaignId}/operationStatus | Get partner campaign operation status at MNO level
[**getPartnerCampaignSharingStatus**](PartnerCampaignApi.md#getpartnercampaignsharingstatus) | **GET** /partnerCampaign/{campaignId}/sharing | Get partner campaign sharing status
[**getPartnerCampaignsByDownstreamCNP**](PartnerCampaignApi.md#getpartnercampaignsbydownstreamcnp) | **GET** /partnerCampaign/sharedWithMe | Search partner shared campaigns filtered by downstream connectivity partner
[**getPartnerCampaignsByUpstreamCNP**](PartnerCampaignApi.md#getpartnercampaignsbyupstreamcnp) | **GET** /partnerCampaign/sharedByMe | Search partner shared campaigns filtered by upstream connectivity partner
[**sharePartnerCampaign**](PartnerCampaignApi.md#sharepartnercampaign) | **PUT** /partnerCampaign/{campaignId}/sharing/{upstreamCnpId} | Share partner campaign with an upstream connectivity partner

# **declineSharedPartnerCampaign**
> \TCR\Client\Model\CampaignSharingStatus declineSharedPartnerCampaign($campaign_id, $explanation)

Decline partner campaign sharing request

This method let you decline a shared campaign request from a downstream partner. This API call is not idenpotent. Once you decline a partner campaign sharing request it longer exist.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PartnerCampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')
$explanation = "explanation_example"; // string | Explanation for declining campaign. Maximum length 2000 chars.

try {
    $result = $apiInstance->declineSharedPartnerCampaign($campaign_id, $explanation);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerCampaignApi->declineSharedPartnerCampaign: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |
 **explanation** | **string**| Explanation for declining campaign. Maximum length 2000 chars. | [optional]

### Return type

[**\TCR\Client\Model\CampaignSharingStatus**](../Model/CampaignSharingStatus.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPartnerCampaign**
> \TCR\Client\Model\SharedCampaign getPartnerCampaign($campaign_id)

Get partner shared campaign details

Retrieve a campaign shared with me by downstream CNP.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PartnerCampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getPartnerCampaign($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerCampaignApi->getPartnerCampaign: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **campaign_id** | **string**| Campaign alphanumeric identifier (prefixed with letter &#x27;C&#x27;) |

### Return type

[**\TCR\Client\Model\SharedCampaign**](../Model/SharedCampaign.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPartnerCampaignMnoMetadata**
> object getPartnerCampaignMnoMetadata($campaign_id)

Get partner campaign MNO metadata

The JSON resonse is a MAP data structure holding campaign metaData for each MNO network campaign is submitted. MAP key contains MNO ID and MAP value contains the campaign metadata for corresponding MNO.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PartnerCampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getPartnerCampaignMnoMetadata($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerCampaignApi->getPartnerCampaignMnoMetadata: ', $e->getMessage(), PHP_EOL;
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

# **getPartnerCampaignOperationStatus**
> object getPartnerCampaignOperationStatus($campaign_id)

Get partner campaign operation status at MNO level

This operation returns a map of campaign operation status at each participating MNO. The key is MNO ID and the value corresponds to the campaign operation status. Valid statuses are 'APPROVED', 'REVIEW', 'REJECTED' and 'SUSPENDED'. Note: MNOs are encouraged, but not obligated to report campaign operation status to TCR.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PartnerCampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getPartnerCampaignOperationStatus($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerCampaignApi->getPartnerCampaignOperationStatus: ', $e->getMessage(), PHP_EOL;
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

# **getPartnerCampaignSharingStatus**
> \TCR\Client\Model\CampaignSharingChain getPartnerCampaignSharingStatus($campaign_id)

Get partner campaign sharing status

Retrieves the sharing identity and status of a partner campaign sharing from both downstream (sharedWithMe) and upstream (sharedByMe) perspective. The sharing status can be in one of two states: PENDING or ACCEPTED.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PartnerCampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')

try {
    $result = $apiInstance->getPartnerCampaignSharingStatus($campaign_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerCampaignApi->getPartnerCampaignSharingStatus: ', $e->getMessage(), PHP_EOL;
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

# **getPartnerCampaignsByDownstreamCNP**
> \TCR\Client\Model\SharedCampaignRecordSet getPartnerCampaignsByDownstreamCNP($downstream_cnp_id, $brand_id, $sharing_status, $start_date, $end_date, $page, $records_per_page)

Search partner shared campaigns filtered by downstream connectivity partner

This query search for campaigns shared by downstream CNP, optionally filter by downstream CNP. Example: CNP1 --> ME --> CNP2. This query lets me query for campaigns I shared filter by CNP1.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PartnerCampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$downstream_cnp_id = "downstream_cnp_id_example"; // string | Alphanumeric identifier of the downstream connectivity partner who shared campaign with you.
$brand_id = "brand_id_example"; // string | Alphanumeric identifier of the Brand tied to the campaign.
$sharing_status = array("sharing_status_example"); // string[] | Filter by sharing status
$start_date = "start_date_example"; // string | Shared date in yyyy-MM-dd format
$end_date = "end_date_example"; // string | Shared date in yyyy-MM-dd format
$page = 1; // int | 
$records_per_page = 10; // int | Number of records per page. Max size is 500

try {
    $result = $apiInstance->getPartnerCampaignsByDownstreamCNP($downstream_cnp_id, $brand_id, $sharing_status, $start_date, $end_date, $page, $records_per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerCampaignApi->getPartnerCampaignsByDownstreamCNP: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **downstream_cnp_id** | **string**| Alphanumeric identifier of the downstream connectivity partner who shared campaign with you. | [optional]
 **brand_id** | **string**| Alphanumeric identifier of the Brand tied to the campaign. | [optional]
 **sharing_status** | [**string[]**](../Model/string.md)| Filter by sharing status | [optional]
 **start_date** | **string**| Shared date in yyyy-MM-dd format | [optional]
 **end_date** | **string**| Shared date in yyyy-MM-dd format | [optional]
 **page** | **int**|  | [optional] [default to 1]
 **records_per_page** | **int**| Number of records per page. Max size is 500 | [optional] [default to 10]

### Return type

[**\TCR\Client\Model\SharedCampaignRecordSet**](../Model/SharedCampaignRecordSet.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPartnerCampaignsByUpstreamCNP**
> \TCR\Client\Model\SharedCampaignRecordSet getPartnerCampaignsByUpstreamCNP($upstream_cnp_id, $brand_id, $sharing_status, $start_date, $end_date, $page, $records_per_page)

Search partner shared campaigns filtered by upstream connectivity partner

This query search for campaigns shared by downstream CNP, optionally filter by upstream CNP. Example: CNP1 --> ME --> CNP2. This query lets me query for campaigns I shared filter by CNP2.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PartnerCampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$upstream_cnp_id = "upstream_cnp_id_example"; // string | Alphanumeric identifier of your upstream connectivity partner.
$brand_id = "brand_id_example"; // string | Alphanumeric identifier of the Brand tied to the campaign.
$sharing_status = array("sharing_status_example"); // string[] | Filter by sharing status
$start_date = "start_date_example"; // string | Shared date in yyyy-MM-dd format
$end_date = "end_date_example"; // string | Shared date in yyyy-MM-dd format
$page = 1; // int | 
$records_per_page = 10; // int | Number of records per page. Max size is 500

try {
    $result = $apiInstance->getPartnerCampaignsByUpstreamCNP($upstream_cnp_id, $brand_id, $sharing_status, $start_date, $end_date, $page, $records_per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerCampaignApi->getPartnerCampaignsByUpstreamCNP: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **upstream_cnp_id** | **string**| Alphanumeric identifier of your upstream connectivity partner. | [optional]
 **brand_id** | **string**| Alphanumeric identifier of the Brand tied to the campaign. | [optional]
 **sharing_status** | [**string[]**](../Model/string.md)| Filter by sharing status | [optional]
 **start_date** | **string**| Shared date in yyyy-MM-dd format | [optional]
 **end_date** | **string**| Shared date in yyyy-MM-dd format | [optional]
 **page** | **int**|  | [optional] [default to 1]
 **records_per_page** | **int**| Number of records per page. Max size is 500 | [optional] [default to 10]

### Return type

[**\TCR\Client\Model\SharedCampaignRecordSet**](../Model/SharedCampaignRecordSet.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **sharePartnerCampaign**
> \TCR\Client\Model\CampaignSharingStatus sharePartnerCampaign($campaign_id, $upstream_cnp_id)

Share partner campaign with an upstream connectivity partner

This method let you share a partner campaign with an upstream connectivity partner. The upstream connectivity partner, identified as 'upstreamCnpId' will be given role-based readonly view of campaign properties to facilitate MNO onboarding. The upstream connectivity partner (if a CSP) will be obliged to share the campaign with their connectivity partner until the campaign reaches a DCA.  Note that once the campaign is shared by the downstream CNP, the invitation cannot be rescended or changed unless the upstream CNP declines the sharing request.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\PartnerCampaignApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campaign_id = "campaign_id_example"; // string | Campaign alphanumeric identifier (prefixed with letter 'C')
$upstream_cnp_id = "upstream_cnp_id_example"; // string | Alphanumeric identifier of your upstream connectivity partner.

try {
    $result = $apiInstance->sharePartnerCampaign($campaign_id, $upstream_cnp_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PartnerCampaignApi->sharePartnerCampaign: ', $e->getMessage(), PHP_EOL;
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

