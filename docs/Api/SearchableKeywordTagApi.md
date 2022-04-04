# TCR\Client\SearchableKeywordTagApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**deleteTag**](SearchableKeywordTagApi.md#deletetag) | **DELETE** /tag/name/{name}/recordType/{recordType}/recordId/{recordId} | Delete a tag attached to a brand or campaign
[**search**](SearchableKeywordTagApi.md#search) | **GET** /tag | Search existing tags
[**setTag**](SearchableKeywordTagApi.md#settag) | **PUT** /tag | Set a tag on a brand or campaign

# **deleteTag**
> deleteTag($name, $record_type, $record_id)

Delete a tag attached to a brand or campaign

Deleting an existing tag attached to a brand or campaign. Make sure all path parameters are properly URL encoded.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\SearchableKeywordTagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$name = "name_example"; // string | Tag name
$record_type = "record_type_example"; // string | Record type
$record_id = "record_id_example"; // string | Record ID

try {
    $apiInstance->deleteTag($name, $record_type, $record_id);
} catch (Exception $e) {
    echo 'Exception when calling SearchableKeywordTagApi->deleteTag: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **name** | **string**| Tag name |
 **record_type** | **string**| Record type |
 **record_id** | **string**| Record ID |

### Return type

void (empty response body)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \TCR\Client\Model\TagRecordSetCSP search($name, $record_id, $record_type, $page, $records_per_page)

Search existing tags

This API lets you search for tags created under your account. Return paginated list of matching tags based on supplied filter criteria.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\SearchableKeywordTagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$name = "name_example"; // string | Tag name
$record_id = "record_id_example"; // string | Record ID for brand or campaign
$record_type = "record_type_example"; // string | Record type
$page = 1; // int | 
$records_per_page = 10; // int | Number of records per page. Max size is 500

try {
    $result = $apiInstance->search($name, $record_id, $record_type, $page, $records_per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SearchableKeywordTagApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **name** | **string**| Tag name | [optional]
 **record_id** | **string**| Record ID for brand or campaign | [optional]
 **record_type** | **string**| Record type | [optional]
 **page** | **int**|  | [optional] [default to 1]
 **records_per_page** | **int**| Number of records per page. Max size is 500 | [optional] [default to 10]

### Return type

[**\TCR\Client\Model\TagRecordSetCSP**](../Model/TagRecordSetCSP.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **setTag**
> \TCR\Client\Model\Tag setTag($body)

Set a tag on a brand or campaign

CSP is allowed to apply up to 10 tags on a brand registered by themselves. Tag name is limited to 1 and 50 characters. Tag name supports UTF-8, but excludes punctuation marks ( ^!\"#$%&'()*+,-./:;<=>?@[]^_`{|}~ ) and space characters. All tags are stored in the system as lowercase.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\SearchableKeywordTagApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\Tag(); // \TCR\Client\Model\Tag | Tagging object

try {
    $result = $apiInstance->setTag($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SearchableKeywordTagApi->setTag: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\Tag**](../Model/Tag.md)| Tagging object |

### Return type

[**\TCR\Client\Model\Tag**](../Model/Tag.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

