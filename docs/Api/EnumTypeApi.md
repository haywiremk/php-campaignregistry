# TCR\Client\EnumTypeApi

All URIs are relative to */v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getAllDcas**](EnumTypeApi.md#getalldcas) | **GET** /enum/dca | List all DCAs
[**getAllMnos**](EnumTypeApi.md#getallmnos) | **GET** /enum/mno | List all MNOs
[**getAllOptionalAttributeNames**](EnumTypeApi.md#getalloptionalattributenames) | **GET** /enum/optionalAttributeNames | List all brand optional attribute names
[**getAllUsecases**](EnumTypeApi.md#getallusecases) | **GET** /enum/usecase | List all use-cases
[**getAllVerticals**](EnumTypeApi.md#getallverticals) | **GET** /enum/vertical | List all verticals
[**getAltBusinessIdType**](EnumTypeApi.md#getaltbusinessidtype) | **GET** /enum/altBusinessIdType | Get Alternative Business ID types
[**getBrandIdentityStatus**](EnumTypeApi.md#getbrandidentitystatus) | **GET** /enum/brandIdentityStatus | Get brand identity statuses
[**getBrandRelationship**](EnumTypeApi.md#getbrandrelationship) | **GET** /enum/brandRelationship | Get Brand Relationship types
[**getCampaignStatusType**](EnumTypeApi.md#getcampaignstatustype) | **GET** /enum/campaignStatus | Get Campaign status types
[**getEntityType**](EnumTypeApi.md#getentitytype) | **GET** /enum/entityType | Get Entity types
[**getVettingProviders**](EnumTypeApi.md#getvettingproviders) | **GET** /enum/extVettingProvider | Get External vetting providers
[**getVettingStatusTypes**](EnumTypeApi.md#getvettingstatustypes) | **GET** /enum/vettingStatus | Get Vetting status types
[**listBrandStatus**](EnumTypeApi.md#listbrandstatus) | **GET** /enum/brandStatus | List brand statuses
[**listConnectivityPartners**](EnumTypeApi.md#listconnectivitypartners) | **GET** /enum/cnp | List connectivity partners
[**listMnoOperationStatus**](EnumTypeApi.md#listmnooperationstatus) | **GET** /enum/operationStatus | List all MNO campaign operation statuses
[**listPublicCompany**](EnumTypeApi.md#listpubliccompany) | **GET** /enum/approvedPublicCompany | List all TCR approved public companies for use as a Brand
[**listStockExchanges**](EnumTypeApi.md#liststockexchanges) | **GET** /enum/stockExchange | List all stock exchanges
[**listVettingClass**](EnumTypeApi.md#listvettingclass) | **GET** /enum/vettingClass | List all vetting classes

# **getAllDcas**
> \TCR\Client\Model\Dca[] getAllDcas()

List all DCAs

This list contains all direct connect aggregators participating in the TCR ecosystem.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAllDcas();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getAllDcas: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\Dca[]**](../Model/Dca.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAllMnos**
> \TCR\Client\Model\Mno[] getAllMnos()

List all MNOs

This list contains all MNOs or MNO representatives participating in the TCR ecosystem.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAllMnos();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getAllMnos: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\Mno[]**](../Model/Mno.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAllOptionalAttributeNames**
> \TCR\Client\Model\OptionalAttributeName[] getAllOptionalAttributeNames()

List all brand optional attribute names

Some brand attribute names are specific to entity type, country, or other yet to be defined scenarios. For example, the optional attribute name: 'taxExemptStatus' is specific to brand of NON_PROFIT entity type. A '527Status' is unique to US-only political advocacy. The list of optional attribute names returned by this API endpoint will expand as new optional attribute are supported.  Each optional attribute name is defined with a data type. Currently the following data types are supported:  * __INTEGER__  * __DECIMAL__  * __STRING__ Maximum length of 512  * __BOOLEAN__

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAllOptionalAttributeNames();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getAllOptionalAttributeNames: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\OptionalAttributeName[]**](../Model/OptionalAttributeName.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAllUsecases**
> getAllUsecases($valid_sub_usecase)

List all use-cases

This list contains all TCR defined use-cases. Use-cases are grouped into two classes: STANDARD and SPECIAL. STANDARD use-cases are generally available to brand without brand vetting. SPECIAL use-cases, on the other hand, may require brand vetting and/or MNO review.  A brand may not qualify for all STANDARD use-cases. CSP may consider brand vetting to achieve access to broader use-cases.  Some use-cases require additional declaration of sub-usecases. If the chosen use-case's 'minSubUsecase' attribute is greater than 0, then the additional sub-use-case declaration is mandatory during campaign submission. The number of sub-use-cases required must be between 'minSubUsecase' and 'maxSubUsecase'.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$valid_sub_usecase = true; // bool | 

try {
    $apiInstance->getAllUsecases($valid_sub_usecase);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getAllUsecases: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **valid_sub_usecase** | **bool**|  | [optional]

### Return type

void (empty response body)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAllVerticals**
> getAllVerticals()

List all verticals

This list contains all TCR defined verticals or business segments.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->getAllVerticals();
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getAllVerticals: ', $e->getMessage(), PHP_EOL;
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
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAltBusinessIdType**
> string getAltBusinessIdType()

Get Alternative Business ID types

Enumeration of alternative business Identifier types for use in a Brand registration. [   \"NONE\",   \"DUNS\",   \"GIIN\",   \"LEI\" ]

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAltBusinessIdType();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getAltBusinessIdType: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBrandIdentityStatus**
> string getBrandIdentityStatus()

Get brand identity statuses

Enumeration of brand identity statuses. [   \"SELF_DECLARED\",   \"UNVERIFIED\",   \"VERIFIED\",   \"VETTED_VERIFIED\", ]  The 4 statuses are defined as follow:  * __SELF_DECLARED__ - This is for sole proprietors that are declaring information about their identity. Their identity is not validated by TCR.  * __UNVERIFIED__ - For brands that register with TCR, but due to incorrect or incomplete information, TCR is unable to verify the brand identity. Brands can move from unverified to verified by updating their information and going through the verification process again.  * __VERIFIED__ - The brand was registered with TCR and TCR is able to successfully verify the brand information.  * __VETTED_VERIFIED__ - A brand can acquire this status by either applying or importing a 3rd party STANDARD class vet. The vetted and verified status may grant brand access to more use-cases, higher rate limits across participating MNO networks.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getBrandIdentityStatus();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getBrandIdentityStatus: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBrandRelationship**
> string getBrandRelationship()

Get Brand Relationship types

Enumeration of brand relationship levels as assessed by the CSP. [   \"BASIC_ACCOUNT\",   \"SMALL_ACCOUNT\",   \"MEDIUM_ACCOUNT\",   \"LARGE_ACCOUNT\",   \"KEY_ACCOUNT\" ]

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getBrandRelationship();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getBrandRelationship: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCampaignStatusType**
> string getCampaignStatusType()

Get Campaign status types

Enumeration of campaign status types. [   \"ACTIVE\",   \"EXPIRED\" ]

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getCampaignStatusType();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getCampaignStatusType: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEntityType**
> string getEntityType()

Get Entity types

Enumeration of entity types for use in a Brand registration. [   \"PRIVATE_PROFIT\",   \"PUBLIC_PROFIT\",   \"NON_PROFIT\"   \"GOVERNMENT\" ]

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getEntityType();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getEntityType: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getVettingProviders**
> \TCR\Client\Model\ExtVettingProvider[] getVettingProviders()

Get External vetting providers

List all external vetting providers (EVP) recognized by TCR for performing brand vetting.  CSP can order brand vetting directly through TCR if the chosen vetting is TCR billable.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getVettingProviders();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getVettingProviders: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\ExtVettingProvider[]**](../Model/ExtVettingProvider.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getVettingStatusTypes**
> string getVettingStatusTypes()

Get Vetting status types

Enumeration of vetting status types. [   \"PENDING\",   \"UNSCORE\",   \"ACTIVE\",   \"FAILED\"   \"EXPIRED\" ]

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getVettingStatusTypes();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->getVettingStatusTypes: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listBrandStatus**
> string listBrandStatus()

List brand statuses

Enumeration of brand statuses.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listBrandStatus();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->listBrandStatus: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listConnectivityPartners**
> string listConnectivityPartners()

List connectivity partners

List eligible upstream connectivity partners.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listConnectivityPartners();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->listConnectivityPartners: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listMnoOperationStatus**
> string listMnoOperationStatus()

List all MNO campaign operation statuses

This list contains all valid MNO campaign operation statuses.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listMnoOperationStatus();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->listMnoOperationStatus: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listPublicCompany**
> \TCR\Client\Model\PublicCompanyRecordSet listPublicCompany($display_name, $symbol, $exchange, $country, $page, $records_per_page)

List all TCR approved public companies for use as a Brand

If a company isn't listed, please submit them via support ticket for review.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$display_name = "display_name_example"; // string | 
$symbol = "symbol_example"; // string | 
$exchange = "exchange_example"; // string | 
$country = "country_example"; // string | 
$page = 1; // int | 
$records_per_page = 10; // int | 

try {
    $result = $apiInstance->listPublicCompany($display_name, $symbol, $exchange, $country, $page, $records_per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->listPublicCompany: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **display_name** | **string**|  | [optional]
 **symbol** | **string**|  | [optional]
 **exchange** | **string**|  | [optional]
 **country** | **string**|  | [optional]
 **page** | **int**|  | [optional] [default to 1]
 **records_per_page** | **int**|  | [optional] [default to 10]

### Return type

[**\TCR\Client\Model\PublicCompanyRecordSet**](../Model/PublicCompanyRecordSet.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listStockExchanges**
> string listStockExchanges()

List all stock exchanges

This list contains all the stock exchanges.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listStockExchanges();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->listStockExchanges: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

**string**

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listVettingClass**
> \TCR\Client\Model\VettingClass[] listVettingClass()

List all vetting classes

When requesting brand vetting, CSP must elect a vetting class, which determines the scope of vetting to be performed by the vetting provider.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: myBasicAuthSecurity
$config = TCR\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new TCR\Client\Api\EnumTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listVettingClass();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumTypeApi->listVettingClass: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\TCR\Client\Model\VettingClass[]**](../Model/VettingClass.md)

### Authorization

[myBasicAuthSecurity](../../README.md#myBasicAuthSecurity)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

