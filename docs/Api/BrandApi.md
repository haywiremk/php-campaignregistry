# TCR\Client\BrandApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createBrand**](BrandApi.md#createbrand) | **POST** /brand | Create new Brand (Blocking)
[**createBrandNonBlocking**](BrandApi.md#createbrandnonblocking) | **POST** /brand/nonBlocking | Create new Brand (Non-Blocking)
[**deleteBrand**](BrandApi.md#deletebrand) | **DELETE** /brand/{brandId} | Delete brand
[**getBrand**](BrandApi.md#getbrand) | **GET** /brand/{brandId} | Get existing Brand by ID
[**getBrandFeedback**](BrandApi.md#getbrandfeedback) | **GET** /brand/feedback/{brandId} | Get brand feedback by ID
[**importBrandExternalVetting**](BrandApi.md#importbrandexternalvetting) | **PUT** /brand/{brandId}/externalVetting | Import external vetting record
[**listBrands**](BrandApi.md#listbrands) | **GET** /brand | Search brands
[**listExternalVettings**](BrandApi.md#listexternalvettings) | **GET** /brand/{brandId}/externalVetting | Get list of external vetting record for a given brand
[**orderBrandExternalVetting**](BrandApi.md#orderbrandexternalvetting) | **POST** /brand/{brandId}/externalVetting | Order new external vetting for a brand
[**revetBrand**](BrandApi.md#revetbrand) | **PUT** /brand/{brandId}/revet | Revet the brand
[**updateBrand**](BrandApi.md#updatebrand) | **PUT** /brand/{brandId} | Update brand properties

# **createBrand**
> \TCR\Client\Model\Brand createBrand($body)

Create new Brand (Blocking)

Register a brand under your CSP account. Mandatory fields vary depending on the type of entity being registered. See the following table for details.. <br>(GOVERNMENT entity type is for US government entity only. Please use PRIVATE_PROFIT for non-US government entity.) <table style=\"float: left;\" border=\"1\"> <tbody> <tr style=\"height: 61px;\"> <th style=\"height: 61px;\">Property Name</th> <th style=\"height: 61px;\">Description</th> <th style=\"height: 61px;\">Validation</th> <th style=\"height: 61px;\"> <p>Entity</p> <p>SOLE_PROPRIETOR</p> </th> <th style=\"height: 61px;\"> <p>Entity</p> <p>PRIVATE_PROFIT</p> </th> <th style=\"height: 61px;\"> <p>Entity</p> <p>PUBLIC_PROFIT</p> </th> <th style=\"height: 61px;\"> <p>Entity</p> <p>NON_PROFIT</p> </th> <th style=\"height: 61px;\"> <p>Entity</p> <p>GOVERNMENT</p> </th> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">displayName</td> <td style=\"height: 21px;\">Brand/Marketing/DBA&nbsp;name of the business</td> <td style=\"height: 21px;\">Max length 255</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">companyName</td> <td style=\"height: 21px;\">The legal name of the business</td> <td style=\"height: 21px;\">Max length 255</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">ein</td> <td style=\"height: 21px;\">Tax ID of the business</td> <td style=\"height: 21px;\">Max length 21</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">einIssuingCountry</td> <td style=\"height: 21px;\">2 letter ISO-2 country code of Tax ID issuing country. E.g. US, CA</td> <td style=\"height: 21px;\">Default to <em>country</em>. Length 2.</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">altBusinessIdType</td> <td style=\"height: 21px;\">Alternative Business Identifier Type. e.g. DUNS, LEI, GIIN.</td> <td style=\"height: 21px;\">Enumerated values</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">altBusinessId</td> <td style=\"height: 21px;\">Alternative Business Identifier</td> <td style=\"height: 21px;\">Max length 50</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">firstName</td> <td style=\"height: 21px;\">First name of business contact</td> <td style=\"height: 21px;\">Max length 100</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">lastName</td> <td style=\"height: 21px;\">Last name of business contact</td> <td style=\"height: 21px;\">Max length 100</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> </tr> <tr style=\"height: 41px;\"> <td style=\"height: 41px;\">phone</td> <td style=\"height: 41px;\">The support contact telephone in e.164 format. E.g. +12023339999</td> <td style=\"height: 21px;\">Max length 20</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">street</td> <td style=\"height: 21px;\">Street name and house number. E.g. 1000 Sunset Hill Road</td> <td style=\"height: 21px;\">Max length 100</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">city</td> <td style=\"height: 21px;\">City name</td> <td style=\"height: 21px;\">Max length 100</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 41px;\"> <td style=\"height: 41px;\">state</td> <td style=\"height: 41px;\">State or province. For the United States, please use 2 character codes. E.g. 'CA' for California.</td> <td style=\"height: 21px;\">Max length 20</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">postalCode</td> <td style=\"height: 21px;\">Zipcode or postal code. E.g. 21012</td> <td style=\"height: 21px;\">Max length 10</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">country</td> <td style=\"height: 21px;\">2 letter ISO-2 country code. E.g. US, CA</td> <td style=\"height: 21px;\">Length 2</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">email</td> <td style=\"height: 21px;\">The email address of support contact</td> <td style=\"height: 21px;\">Max length 100</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">stockSymbol</td> <td style=\"height: 21px;\">The stock symbol of the brand</td> <td style=\"height: 21px;\">Max length 10</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">stockExchange</td> <td style=\"height: 21px;\">The stock exchange of the brand</td> <td style=\"height: 21px;\">Enumerated values</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">website</td> <td style=\"height: 21px;\">The website of the business</td> <td style=\"height: 21px;\">Max length 100</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> </tr> <tr style=\"height: 41px;\"> <td style=\"height: 41px;\">brandRelationship</td> <td style=\"height: 41px;\">Brand relationship level assessed by CSP</td> <td style=\"height: 21px;\">Enumerated values</td> <td style=\"height: 41px;\">N/A</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> <td style=\"height: 41px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">vertical</td> <td style=\"height: 21px;\">The segment in which the business operates in</td> <td style=\"height: 21px;\">Enumerated values</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Required</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">referenceId</td> <td style=\"height: 21px;\">Customer unique identifier for preventing duplicate brand registration into TCR. Case-insensitive, empty string ignored.</td> <td style=\"height: 21px;\">Max length 50</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">tag</td> <td style=\"height: 21px;\">Tags to be set on the Brand.</td> <td style=\"height: 21px;\">Please refer to the Searchable Keyword Tag</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">mock</td> <td style=\"height: 21px;\">If true, marks the brand as a 'mock' brand that does not incur a billable charge on brand subsequent campaign registration.</td> <td style=\"height: 21px;\">Default to false</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> <td style=\"height: 21px;\">Optional</td> </tr> </tbody> </table>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\BrandRequest(); // \TCR\Client\Model\BrandRequest | Brand to be created

try {
    $result = $apiInstance->createBrand($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->createBrand: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\BrandRequest**](../Model/BrandRequest.md)| Brand to be created |

### Return type

[**\TCR\Client\Model\Brand**](../Model/Brand.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createBrandNonBlocking**
> \TCR\Client\Model\Brand createBrandNonBlocking($body)

Create new Brand (Non-Blocking)

This is the non-blocking version of the brand registration API call. Compared to the blocking version, this API call returns much faster because it does not wait for the initial brand scoring task, which can take more than 10 seconds to complete. The non-blocking version is suitable for an off-line process to register brands in bulk. Since the CSP cannot proceed to register a campaign for an 'unscored' brand, the CSP must wait for the BRAND_SCORE_UPDATE webhook notification event.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\BrandRequest(); // \TCR\Client\Model\BrandRequest | Brand to be created

try {
    $result = $apiInstance->createBrandNonBlocking($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->createBrandNonBlocking: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\BrandRequest**](../Model/BrandRequest.md)| Brand to be created |

### Return type

[**\TCR\Client\Model\Brand**](../Model/Brand.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteBrand**
> deleteBrand($brand_id)

Delete brand

This operation deletes a brand. A brand can be deleted if it does not have active campaigns. Once a brand is deleted the brand is in a DELETED state, and the brand cannot be restored to an ACTIVE state. Deleted brands will remain in the system for a period of TBD time and it can be searched using the GET /brand endpoint with query filter 'status' = ACTIVE. While deleted brands are searchable, all other API endpoints involving a deleted brand will result in a '502' - \"Brand not found\" error.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')

try {
    $apiInstance->deleteBrand($brand_id);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->deleteBrand: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |

### Return type

void (empty response body)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBrand**
> \TCR\Client\Model\BrandCSP getBrand($brand_id)

Get existing Brand by ID

Retrieve the brand record from TCR by the unique identifier assigned to the brand.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')

try {
    $result = $apiInstance->getBrand($brand_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->getBrand: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |

### Return type

[**\TCR\Client\Model\BrandCSP**](../Model/BrandCSP.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBrandFeedback**
> \TCR\Client\Model\BrandFeedbackCSP getBrandFeedback($brand_id)

Get brand feedback by ID

Retrieve the brand feedback details by the unique identifier assigned to the brand. Invoke this API after the brand creation/revet. For the blocking version of brand creation/revet, retrieve feedback details immediately. For the non-blocking version of brand creation/revet, retrieve feedback details after the brand scoring task is complete, which means CSP must wait for the BRAND_SCORE_UPDATE webhook notification event. Following are the applicable category IDs:  * __TAX_ID__ - Data mismatch related to tax id and its associated properties.  * __STOCK_SYMBOL__ - Non public entity registered as a public for profit entity or the stock information mismatch.  * __GOVERNMENT_ENTITY__ - Non government entity registered as a government entity. Must be a U.S. government entity.  * __NONPROFIT__ - No IRS 501c tax-exempt status found.  * __OTHERS__ - Details of the data misrepresentation if any.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')

try {
    $result = $apiInstance->getBrandFeedback($brand_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->getBrandFeedback: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |

### Return type

[**\TCR\Client\Model\BrandFeedbackCSP**](../Model/BrandFeedbackCSP.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **importBrandExternalVetting**
> \TCR\Client\Model\ExternalVetting importBrandExternalVetting($body, $brand_id)

Import external vetting record

This operation can be used to import external vetting record from a TCR approved vetting provider. If vetting provider confirms validity of the vetting record, the vetting record will be saved with the brand in the TCR and the vetting record will be considered for future campaign qualification.   The JSON request body must contain valid 'evpId', the identity of the vetting provider and the 'vettingId', the unique ID of the vetting transaction. The 'vettingToken' field is required by some vetting provider.<table style=\"float: left;\" border=\"1\"> <tbody> <tr style=\"height: 61px;\"> <th style=\"height: 61px;\" rowspan=\"2\">Vetting Provider</th> <th style=\"height: 61px; width: 61px;\" rowspan=\"2\">Evp Id</th> <th style=\"height: 61px;\" colspan=\"2\">Vetting ID</th> <th style=\"height: 61px;\" colspan=\"2\">Vetting Token</th> <th style=\"height: 61px;\" rowspan=\"2\">Supported Vetting Class</th> <th style=\"height: 61px;\" rowspan=\"2\">Notes</th> <tr style=\"height: 16px;\"> <th style=\"height: 50px;\">Alias</th> <th style=\"height: 50px;\">Requirement</th> <th style=\"height: 50px;\">Alias</th> <th style=\"height: 50px;\">Requirement</th> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">Aegis Mobile</td> <td style=\"height: 21px;\">AEGIS</td> <td style=\"height: 21px;\">ID</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">Verification Certificate</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">STANDARD</td> <td style=\"height: 21px;\">Following requirements are checked by TCR when importing an Aegis report:<ul><li>The legal name from Aegis's report and that of the TCR brand must match</li><li>The entity type from Aegis's report and that of the TCR brand must match</li></tr> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">Campaign Verify</td> <td style=\"height: 21px;\">CV</td> <td style=\"height: 21px;\">Authorization Token</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">POLITICAL</td> <td style=\"height: 21px;\">Following requirements are checked by TCR when importing a Campaign Verify report:<ul><li>Brand must be a US-based, NON_PROFIT entity type without a 501c (tax-exempt) status</li><li>Unique CV token required for each brand. In another word, A CV token cannot be imported into two TCR brands even if they are under different CSP accounts</li></tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">WMC Global</td> <td style=\"height: 21px;\">WMC</td> <td style=\"height: 21px;\">Transaction ID</td> <td style=\"height: 21px;\">Required</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">N/A</td> <td style=\"height: 21px;\">STANDARD</td> <td style=\"height: 21px;\">Following requirements are checked by TCR when importing a WMC report:<ul><li>Brand must be a US-based and PRIVATE_PROFIT or PUBLIC_PROFIT entity type</tr> </tbody> </table>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\ExternalVettingImportRequest(); // \TCR\Client\Model\ExternalVettingImportRequest | External vetting record to be imported for a given brand
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')

try {
    $result = $apiInstance->importBrandExternalVetting($body, $brand_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->importBrandExternalVetting: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\ExternalVettingImportRequest**](../Model/ExternalVettingImportRequest.md)| External vetting record to be imported for a given brand |
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |

### Return type

[**\TCR\Client\Model\ExternalVetting**](../Model/ExternalVetting.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listBrands**
> \TCR\Client\Model\BrandRecordSetCSP listBrands($reference_id, $display_name, $entity_type, $identity_status, $status, $state, $country, $ein, $reseller_id, $tag, $mock, $page, $records_per_page)

Search brands

Search for brands you registered by any combination of 'displayName', 'entityType', 'state', 'country'. This operation supports pagination with a maximum of 500 records per fetch. 'state' and 'country' if supplied must be an exact match.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$reference_id = "reference_id_example"; // string | Reference ID.
$display_name = "display_name_example"; // string | DBA or trade name of the business. Partial spelling accepted.
$entity_type = "entity_type_example"; // string | Brand entity type.
$identity_status = "identity_status_example"; // string | Brand identity status.
$status = "ACTIVE"; // string | Brand status. Default value is 'ACTIVE'
$state = "state_example"; // string | State or province. For U.S. input must conforms to 2-letter abbreviation.
$country = "country_example"; // string | ISO2 2-letter abbreveiation of country.
$ein = "ein_example"; // string | Government assigned corporate tax ID. EIN is 9-digits in U.S.
$reseller_id = "reseller_id_example"; // string | Reseller ID.
$tag = array("tag_example"); // string[] | Tag
$mock = true; // bool | Mock brand Default 'null' input returns both real and test brands.
$page = 1; // int | 
$records_per_page = 10; // int | Number of records per page. Max size is 500

try {
    $result = $apiInstance->listBrands($reference_id, $display_name, $entity_type, $identity_status, $status, $state, $country, $ein, $reseller_id, $tag, $mock, $page, $records_per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->listBrands: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **reference_id** | **string**| Reference ID. | [optional]
 **display_name** | **string**| DBA or trade name of the business. Partial spelling accepted. | [optional]
 **entity_type** | **string**| Brand entity type. | [optional]
 **identity_status** | **string**| Brand identity status. | [optional]
 **status** | **string**| Brand status. Default value is &#x27;ACTIVE&#x27; | [optional] [default to ACTIVE]
 **state** | **string**| State or province. For U.S. input must conforms to 2-letter abbreviation. | [optional]
 **country** | **string**| ISO2 2-letter abbreveiation of country. | [optional]
 **ein** | **string**| Government assigned corporate tax ID. EIN is 9-digits in U.S. | [optional]
 **reseller_id** | **string**| Reseller ID. | [optional]
 **tag** | [**string[]**](../Model/string.md)| Tag | [optional]
 **mock** | **bool**| Mock brand Default &#x27;null&#x27; input returns both real and test brands. | [optional]
 **page** | **int**|  | [optional] [default to 1]
 **records_per_page** | **int**| Number of records per page. Max size is 500 | [optional] [default to 10]

### Return type

[**\TCR\Client\Model\BrandRecordSetCSP**](../Model/BrandRecordSetCSP.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listExternalVettings**
> \TCR\Client\Model\ExternalVetting[] listExternalVettings($brand_id, $vetting_status, $evp_id, $vetting_class)

Get list of external vetting record for a given brand

Option to query by vetting partner id, vetting class and status.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$brand_id = "brand_id_example"; // string | Brand ID
$vetting_status = array("vetting_status_example"); // string[] | 
$evp_id = "evp_id_example"; // string | Vetting provider ID
$vetting_class = "vetting_class_example"; // string | Vetting class

try {
    $result = $apiInstance->listExternalVettings($brand_id, $vetting_status, $evp_id, $vetting_class);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->listExternalVettings: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **brand_id** | **string**| Brand ID |
 **vetting_status** | [**string[]**](../Model/string.md)|  |
 **evp_id** | **string**| Vetting provider ID | [optional]
 **vetting_class** | **string**| Vetting class | [optional]

### Return type

[**\TCR\Client\Model\ExternalVetting[]**](../Model/ExternalVetting.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **orderBrandExternalVetting**
> \TCR\Client\Model\ExternalVetting orderBrandExternalVetting($body, $brand_id)

Order new external vetting for a brand

This operation requests the specific vetting provider to perform vetting on a brand. By issuing this operation, the CSP authorizes the vetting provider access to the particular brand information stored in TCR. Vetting process may take anywhere from a minute to 2 days depending on the vetting provider. TCR will attempt to locate pending or unscore vetting record prior to accepting new order.  The JSON request body must contain valid 'evpId', the identity of the vetting provider and the 'vettingClass', the vetting classification(/enum/vettingClass).The following table describes the vendor support for external vetting via TCR based on brand type<table style=\"float: left;\" border=\"1\"> <tbody> <tr style=\"height: 61px;\"> <th style=\"height: 61px;\">Vetting Provider</th> <th style=\"height: 61px;\">Evp ID</th> <th style=\"height: 61px;\"><p>US Brand</p></th> <th style=\"height: 61px;\"><p>Non-US Brand</p></th> <th style=\"height: 61px;\"> <p>Brand Entity</p> <p>SOLE_PROPRIETOR</p> </th> <th style=\"height: 61px;\"> <p>Brand Entity</p> <p>PRIVATE_PROFIT</p> </th> <th style=\"height: 61px;\"> <p>Brand Entity</p> <p>PUBLIC_PROFIT</p> </th> <th style=\"height: 61px;\"> <p>Brand Entity</p> <p>NON_PROFIT</p> </th> <th style=\"height: 61px;\"> <p>Brand Entity</p> <p>GOVERNMENT</p> </th> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">Aegis Mobile</td> <td style=\"height: 21px;\">AEGIS</td> <td style=\"height: 21px;\">Allowed</td> <td style=\"height: 21px;\">Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Allowed</td> <td style=\"height: 21px;\">Allowed</td> <td style=\"height: 21px;\">Allowed</td> <td style=\"height: 21px;\">Allowed</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">Campaign Verify</td> <td style=\"height: 21px;\">CV</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">WMC Global</td> <td style=\"height: 21px;\">WMC</td> <td style=\"height: 21px;\">Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Allowed</td> <td style=\"height: 21px;\">Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> <td style=\"height: 21px;\">Not Allowed</td> </tr> </tbody> </table>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\ExternalVettingOrderRequest(); // \TCR\Client\Model\ExternalVettingOrderRequest | External vetting information to be updated
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')

try {
    $result = $apiInstance->orderBrandExternalVetting($body, $brand_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->orderBrandExternalVetting: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\ExternalVettingOrderRequest**](../Model/ExternalVettingOrderRequest.md)| External vetting information to be updated |
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |

### Return type

[**\TCR\Client\Model\ExternalVetting**](../Model/ExternalVetting.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **revetBrand**
> \TCR\Client\Model\Brand revetBrand($brand_id, $non_blocking)

Revet the brand

This operation allows you to revet the brand.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')
$non_blocking = true; // bool | 

try {
    $result = $apiInstance->revetBrand($brand_id, $non_blocking);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->revetBrand: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |
 **non_blocking** | **bool**|  | [optional] [default to true]

### Return type

[**\TCR\Client\Model\Brand**](../Model/Brand.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateBrand**
> \TCR\Client\Model\Brand updateBrand($body, $brand_id)

Update brand properties

This operation enables the CSP to keep brand details updated in the registry. The following table describes the update policy for each brand property. The re-scoring can be triggered via revet(/brand/{brandId}/revet) API<table style=\"float: left;\" border=\"1\"> <tbody> <tr style=\"height: 61px;\"> <th style=\"height: 61px;\">Property Name</th> <th style=\"height: 61px;\">Update Support</th> <th style=\"height: 61px;\">Re-scoring Required</th> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">ein, einIssuingCountry, entityType</td> <td style=\"height: 21px;\">CSP API or CSP Portal. <b><i>Update allowed if brand has no external vet.</i></b></td> <td style=\"height: 21px;\">Yes</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">fistName, lastName, displayName, companyName, website, street, city, state, postalCode, country, email, phone, vertical, stockSymbol, stockExchange</td> <td style=\"height: 21px;\">CSP API or CSP Portal</td> <td style=\"height: 21px;\">Optional</td> </tr> <tr style=\"height: 21px;\"> <td style=\"height: 21px;\">brandRelationship</td> <td style=\"height: 21px;\">CSP API or CSP Portal. <b><i>Brand relationship can only be updated once every 3 months.</i></b></td> <td style=\"height: 21px;\">Optional</td> </tr> </tbody> </table>

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\BrandApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \TCR\Client\Model\UpdateBrand(); // \TCR\Client\Model\UpdateBrand | Brand properties to be updated
$brand_id = "brand_id_example"; // string | Brand alphanumeric identifier (prefixed with letter 'B')

try {
    $result = $apiInstance->updateBrand($body, $brand_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrandApi->updateBrand: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\TCR\Client\Model\UpdateBrand**](../Model/UpdateBrand.md)| Brand properties to be updated |
 **brand_id** | **string**| Brand alphanumeric identifier (prefixed with letter &#x27;B&#x27;) |

### Return type

[**\TCR\Client\Model\Brand**](../Model/Brand.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

