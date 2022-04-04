# SwaggerClient-php
## Overview The Campaign Registry (TCR) data model contains 3 key entities†: * **_Campaign Service Provider_** (CSP), who is contracted with Direct Connect Aggregator (DCA or 0-Hop)) and TCR. CSP is typically the party hosting the campaign on its own technology platform. CSP account creation in TCR requires manual vetting and reference checks. * **_Brand_** is the legal entity or role responsible for the messaging content in a campaign. A brand depends on the CSP for submitting a campaign request to TCR. TCR will perform Cyber and Identity verifications against every brand registered by CSP.  * **_Campaign_** is an encompassing entity that ties together the _who_ (CSP and Brand) and the _what_ (Use Case) for all 10DLC messaging campaigns. A campaign can only be submitted by the CSP.    † TCR also supports Reseller(Large account). CSP manages the resellers and identify campaigns that belong to a reseller. Reseller can be set **ONLY ONCE** while creating or updating campaign.  ### Identifier A unique identifier is assigned to each above-referenced entity. CSP, Brand, and Campaign are assigned unique 7-char upper alphanumeric identity prefixed with the letter 'S', 'B' and 'C' respectively. These identities are used throughout this API operations.  ### Blocking vs Non-Blocking Brand Registration There are two API endpoints available for registering brands: Blocking vs Non-Blocking. The blocking flavor will 'block' until TCR completes the initial brand scoring task, which may take more than 10 seconds. The non-blocking version does not wait for the brand scoring task and returns much quicker.  The non-blocking version is suitable for CSP who wish to register a number of brands in an offline process. Brands registered via non-blocking API are not immediately ready for campaign registration. The CSP must be notified (via webhook event BRAND_SCORE_UPDATE) before a campaign can be registered for the brand. Under a non-queuing steady-state operation, the expected wait time is under 2 minutes.  ### Brand Identity Status When a Non-Sole Prop brand is registered, TCR will attempt to verify the identity of the brand based on the supplied information. The brand is assigned a `VERIFIED` or `UNVERIFIED` status upon registration completion. If the brand has the `UNVERIFIED` identity status, then the brand will not qualify to run campaign on any MNO network.   #### Levels of Brand Identity Statuses * **_SELF_DECLARED_** Applicable to Sole-Proprietor entity type. TCR does not make attempt to verify the brand information. * **_UNVERIFIED_** TCR is unable to verify or identify the existence of the brand. An UNVERIFIED brand is not permitted to run a 10DLC campaign. * **_VERIFIED_** TCR is able to verify the information and identify the existence of the organization. A VERIFIED brand is permitted to run standard 10DLC campaigns across all MNO networks. * **_VETTED_VERIFIED_** Brand with an external STANDARD class vet. A VETTED_VERIFIED brand may potentially gain access to higher throughput and additional use-cases across some MNO networks.    If a brand is assigned an UNVERIFIED status, the CSP can make corrections based on the hints from the brand feedback API. The below table summarizes the possible brand feedback issues by entity type and potential course of actions:  | Entity Type     | Potential causes for UNVERIFIED status                                                                               | Recourse                                               | |-----------------|----------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------| | PRIVATE_PROFIT  | Invalid ein, or mismatch between ein and companyName.                                                                | 1)Revet w/ correction. 2)External vet with correction. | | PUBLIC_PROFIT   | Invalid ein, or mismatch between ein and companyName.                                                                | 1)Revet w/ correction. 2)External vet with correction. | | NON_PROFIT      | Invalid ein, mismatch between ein and companyName.                                                                   | 1)Revet w/ correction. 2)External vet with correction. | | GOVERNMENT      | Invalid ein, mismatch between ein and companyName.                                                                   | 1)Revet w/ correction. 2)External vet with correction. | | SOLE_PROPRIETOR | -- Not applicable --                                                                                                 | -- Not applicable --                                   |  ### Brand Optional Attributes Brand optional attributes are a collection of non-standard attributes applicable to some brands based on characteristics not limited to entity types. The brand optional attributes (_optionalAttributes_) is a property of Brand object. Some examples of optional attributes: * **_russell3000_** Recognizes public companies that are in the Russell 3000 index. The said brand may be granted higher throughput on some MNO networks. * **_taxExemptStatus_** Identifies the tax-exempt 501c status for a non-profit brand. A '501c3' status is mandatory for accessing CHARITY use-case on some MNO networks. * **_politicalCommitteeLocale_** Political committee Locale identified by a Campaign Verify vet. Possible values are federal, state, local and tribal. * **_section527_** Section 527 status identified by a Campaign Verify vet. A 527 group is a type of U.S. tax-exempt organization organized under Section 527 of the U.S. Internal Revenue Code. The said brand may be granted higher throughput on some MNO networks.  * **_governmentEntity_** Confirmation that the brand is a closely affiliated, generally by government ownership or control, with federal, state or local governments. The said brand may be granted higher throughput on some MNO networks.  The list of defined optional attributes can be retrieved through the `GET /enum/optionalAttributeNames` API endpoint.  ### Brand External Vetting  Some special campaign use-cases require the brand to be vetted by a participating vetting provider. TCR can either accept existing vetting records from a TCR approved vetting provider, or accept a new vetting request to be placed via an API call. The steps for both workflows are detailed as follow:  #### Existing Vet 1. CSP to create a brand in TCR. (Skip if the brand is already in TCR) 2. CSP to invoke `PUT /brand/{brand}/externalVetting` operation to confirm the vetting credential `evpId` (Vetting Identifier) and optionally required for some vetting provider the `vettingToken` are passed into the API call. This API call will return synchronously with the latest vetting record status.   #### Order New External Vet  1. CSP to create a brand in TCR. (Skip if the brand is already in TCR) 2. CSP to invoke `POST /brand/{brand}/externalVetting` operation to initiate a brand vetting through the desired EVP. This API call is not expected to return vetting results.  3. Vetting results may take anywhere from 30 seconds to 24 hours depending on the vetting provider. When the vetting provider completes vetting, the results are recorded in TCR. Vetting status can either be pushed to CSP via webhook or polled by CSP via API call.  ### Brand Deletion Here are some business rules around brand deletion: * Brand deletion is an irreversible action. * Brand can be deleted from a CSP account if the brand does not have any active campaigns.  * Deleted brands remain searchable in `GET /brand` API endpoint. However, `GET /brand/{brandId}` API for deleted brand will results in error 502 - \"Brand not found\". * Expired campaigns associated with deleted brands remain searchable in `GET /campaign` API endpoint.   ### Campaign Lifecycle  1. **_Register brand:_** Every campaign must be associated with a brand. CSP can register the brand using the **_Brand Operations_**.  2. **_Register campaign:_** CSP can use the **_Campaign Builder Operations_**. Most registered brands will qualify for a majority of standard campaign use-cases. There are some special use-cases that require proof of brand-vetting and/or Mobile Network Operator (MNO) approval.  TCR can track campaign approval status across individual participating MNO networks. CSP can pull (via API call) and/or receive push (via webhook) on campaign MNO operation status changes. 3. **_Share campaign:_** CSP can use the **_Campaign Sharing Operations_** to share campaign with upstream connectivity partner (CNP) for campaign on-boarding with MNO. CNP assigns phone number to campaign.     4. **_Sunset campaign:_** Campaign registration is paid on a quarterly basis. CSP can cancel auto-renewal or deactivate to terminate the campaign immediately.   <img src=\"/assets/images/csp_api_std_flow_v1.jpg\" />  ### Campaign Sharing While registering a campaign, the CSP is required to share with an upstream Connectivity Partner (CNP) who they work with to provision the campaign. A Connectivity Partner may be an TCR CSP or DCA. The sharing process continue up the stream until the campaign reaches a DCA.   <img src=\"/assets/images/cnp_chain.jpeg\" />  #### Campaign Sharing Principles 1. The term 'Downstream Connectivity Partner' a.k.a. 'Downstream CNP' describes the CNP sharing campaign with you. Conversely, the term 'Upstream CNP' identifies the CNP with whom the campaign is shared. 2. The campaign CSP may share campaigns directly to a DCA. This is the most direct way to on-board a campaign.   3. Once a campaign is shared with an upstream CNP, the sharing status is marked `PENDING`. While the sharing status is in the `PENDING` state, the downstream CNP cannot rescind the sharing request nor change the upstream CNP. 4. Upstream CNP can decline a sharing request from downstream CNP. Action to decline a sharing request will mark the sharing status to a `DECLINED` state. At this point, the downstream CNP is allowed to share campaigns with a different upstream CNP. 5. The sharing status is updated to `ACCEPTED` state under the following circumstances: 1)Upstream CNP is a CSP and shares the campaign to another CNP, taking the campaign further up the chain, 2)Upstream CNP is a DCA.   6. The adjacent downstream CNP is notified of sharing status change via the webhook mechanism.  7. When a campaign is shared with an upstream CNP, campaign details are shared based on a needed basis. When sharing the campaign with another CSP, the majority of the campaign details are obfuscated or hidden from the upstream CSP. However, when a campaign is shared with a DCA, the entire campaign details, including the CNP chain formation/hops are visible to the DCA.   ## API Interactions API includes both a pull model and push (aka webhook) model communication between CSP and TCR. Depending on the specific requirements, CSP may choose to implement one or both. More specifically, pull model API calls are intended for querying or updating TCR entities, while webhook is intended for CSP to be notified of events or updates that occurred in TCR. For example, CSP can query campaign details by issuing a pull query against TCR. CSP can be notified via webhook when a new campaign or brand is registered in TCR.  ### Webhook Event Types and Event Categories TCR produces several events grouped into categories. CSP can subscribe to receive notification of events by category. A subscription can be created by associating a CSP webhook endpoint to an event category.  Webhook event is expected to be in form of a flat-map JSON data structure. Webhook event contains an `eventType` along with other JSON properties. Here are the possible list of JSON attributes:  | JSON Attribute     | Description                                                                        | Mandatory | Data Type | |--------------------|------------------------------------------------------------------------------------|-----------|-----------| | eventType          | Webhook event type                                                                 | Yes       | String    | | cspId              | CSP ID                                                                             | No        | String    | | cnpId              | CNP ID                                                                             | No        | String    | | cspName            | CSP display name                                                                   | No        | String    | | brandId            | Brand ID                                                                           | No        | String    | | brandName          | Brand display name                                                                 | No        | String    | | brandReferenceId   | Brand reference ID (Visible to brand creator)                                      | No        | String    | | brandIdentityStatus| Updated brand identity status. Applicable to BRAND_IDENTITY_STATUS_UPDATE event    | No        | String    | | campaignId         | Campaign ID                                                                        | No        | String    | | campaignReferenceId| Campaign reference ID (Visible to campaign creator)                                | No        | String    | | dcaId              | DCA ID                                                                             | No        | String    | | dcaName            | DCA display name                                                                   | No        | String    | | description        | Description                                                                        | No        | String    | | evpId              | External Vetting Provider ID                                                       | No        | String    | | evpName            | External Vetting Provider display name                                             | No        | String    | | vettingId          | External vetting ID                                                                | No        | String    | | mnoId              | Mobile Network Operator ID\\. Please refer to Network resource for list of all MNOs | No        | Long      | | mnoName            | Mobile Network Operator display name                                               | No        | String    | | mock              | Event associated with a mock brand if attribute exists and value is 'true'         | No        | Boolean   |   #### Webhook Example - Notification of campaign suspension by AT&T   ```sh POST / HTTP/1.1 Host: tcr.requestcatcher.com Accept: *.* Connection: keep-alive Content-Length: 226 Content-Type: application/json; utf-8 X-Registry-Signature: SmqzLvP6uQDM6DD2lfdLqwiJJbo=  {   \"cspId\" : \"SUEKBB\",   \"brandName\" : \"Microsoft\",   \"brandName\" : \"Microsoft\",   \"mnoName\" : \"AT&T\",   \"campaignId\" : \"CRMKK5Y\",   \"campaignReferenceId\" : \"C-00388\",   \"brandId\" : \"BFHXANR\",   \"brandReferenceId\" : \"Q-29393332\",   \"mnoId\" : 10017,   \"eventType\" : \"MNO_CAMPAIGN_OPERATION_SUSPENDED\",   \"cspName\" : \"ACME\" } ```  ### Webhook Authentication To ensure secure communication between TCR and the subscriber application, all the webhook notifications sent out from TCR will have HMAC-SHA1 signed \"X-Registry-Signature\" authentication header. Steps to verify the signed signature by every subscriber: 1. Canonicalize the JSON raw content (webhook notification body) into a string. Refer <a href=\"https://github.com/cyberphone/json-canonicalization\">JCS defined canonicalization</a>. 2. Build string to be signed, stringToSign = webhook URL + canonicalized string. 3. AuthKey = subscriber's TCR account SECRET key. 4. Apply HMAC-SHA1 algorithm on the stringToSign with authKey and get the signedString. Refer to the 'How to Validate a Webhook Signature using HMAC' section in <a href=\"https://drive.google.com/file/d/1RcYnV8J2KAC08A4P2f1vV_g3SBe1GhEq/view\">Webhook Instructions for CSP API</a>. 5. Compare the X-Registry-Signature value with the signedString to determine the authenticity of the webhook notification.  #### Webhook IP Addresses The IP addresses that TCR uses to make webhooks to your server are limited to following the addresses:  * Production: `52.44.59.112` * QA/Sandbox and Staging: `107.23.98.23`  ### API Authentication TCR REST API operations are only accessible via HTTPS to ensure API call data is encrypted between the registry server and your application.  To protect against unauthorized access, the TCR server requires call level authentication for CSP identity.  CSP Registry REST API supports Basic Authentication. Basic Authentication is an industry-standard for enforcing access control to the HTTP resources.  CSP account must be provisioned for REST API access. Once provisioned, CSP will be assigned a pair of authentication tokens: `APIKEY` and `SECRET`.  `APIKEY` and `SECRET` tokens are passed as User and Password elements of the basic authentication header.  ```sh $ curl --user [APIKEY]:[SECRET] GET \"http://[SERVER]/v1/enum/entityType\" -H \"accept: application/json\" ```  ### API Rate Limiting A rate limit is the number of API calls a CSP account can make within a given time period. If this limit is exceeded, API requests made by the CSP will fail with an HTTP status 429 code. Unless specified otherwise, all GET operations are rate-limited at 20 requests per second, while all PUT, POST, and DELETE operations are rate-limited at 20 requests per 10 seconds.  ### Platform Free Trial (PFT) Feature CSP can register platform-free-trial campaigns to support trial customer messaging activities. The PFT feature requires MNO approval. Please contact TCR support for the approval process.  CSP can check for the PFT feature status by issuing an API call against the `GET /csp/profile` endpoint.  #### Registering PFT Campaigns Upon approval by MNO, the CSP will be assigned a PFT-enabled brand by the TCR team. You can retrieve the Brand ID by issuing an API call against the `GET /pft/brand` endpoint.  Here are some business rules surrounding PFT campaigns: * A single PFT-enabled brand is assigned to the CSP account.  * This PFT-enabled brand is used for registering all PFT campaigns with use-case type: TRIAL.  * CSP is allowed to register one campaign for its own use plus one campaign per ISV/reseller.  * When registering a PFT campaign for an ISV, the said ISV must be identified by the 'resellerId' parameter in the `POST /campaignBuilder` API request. * The registration and sharing processes for the PFT type campaign are otherwise identical to a standard use-case type.  <img src=\"/assets/images/pft_flow.jpg\" />  NOTE: The Platform Free Trial feature is not enabled by default for CSP accounts. Please contact TCR support for more information.  #### Reporting PFT User Provisioning MNOs mandate CSP to report user-provisioning events to TCR. A user-provisioning event is recognized when the CSP (or CSP's ISV) assigns a 10DLC long code to a free trial user account.  The CSP must report this event on a real-time basis as trial account users are assigned 10DLC long codes. There is no need to report deactivation or de-provisioning of the trial user account to TCR.  Please refer to the `POST /pft/participant` endpoint for more usage details.  ### Sole Proprietor Type/Feature Brand without a business EIN can be registered into TCR under the new SOLE_PROPRIETOR entity designation. Here are some key limitations of SOLE_PRPRIETOR entity type: * Has lower message throughput.  * Is limited to a single campaign of SOLE_PROPRIETOR use-case, supporting mixed messaging content. * Is limited to 5 10DLC numbers provisioned to the campaign. * Is not eligible for external vet to gain higher messaging throughput.  <img src=\"/assets/images/sp_flow.jpg\" />  NOTE: The Sole proprietor feature is not enabled by default for CSP accounts. Please contact TCR support for more information.  ### Mock Brand and Campaign Mock brand and campaign are used to test applications without actually registering records into NetNumber OSR or incur any billable charges. Here are some additional business rules surrounding mock brands and campaigns: * All mock brands will be automatically deleted 30 days after initial registration. Deletion will cascade across all campaigns created from mock brands. * Mock brands and campaigns are only visible privately to the CSP.  * Mock brands can be externally vetted to access special use cases. * Campaigns created from mock brands are mock campaigns. * Mock campaigns are not functional campaigns. You cannot run SMS traffic over mock campaigns. * Mock campaigns cannot be shared upstream to CNP and are not registered in NetNumber OSR.  * Webhook events associated with mock brands or campaigns are identified with JSON attribute 'mock' = true.     ## How To Use This Interactive API Doc This interactive API doc enables a developer to test API operations in the API suite. To invoke the API call in the interactive console,  you must first log-in by clicking on the green **Authorize** button. Use your assigned authentication tokens `APIKEY` in **Username** field and `SECRET` in **Password** field of the login dialog box.  ## API Version and Changelog The API version number can be accessed via `GET /version` operation. The changelog is available <a href=\"https://release.campaignregistry.com/changelogs\">here</a>.

This PHP package is automatically generated by the [Swagger Codegen](https://github.com/swagger-api/swagger-codegen) project:

- API version: 1.0
- Build package: io.swagger.codegen.v3.generators.php.PhpClientCodegen

## Requirements

PHP 5.5 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/SwaggerClient-php/vendor/autoload.php');
```

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## Documentation for API Endpoints

All URIs are relative to */v1*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*BrandApi* | [**createBrand**](docs/Api/BrandApi.md#createbrand) | **POST** /brand | Create new Brand (Blocking)
*BrandApi* | [**createBrandNonBlocking**](docs/Api/BrandApi.md#createbrandnonblocking) | **POST** /brand/nonBlocking | Create new Brand (Non-Blocking)
*BrandApi* | [**deleteBrand**](docs/Api/BrandApi.md#deletebrand) | **DELETE** /brand/{brandId} | Delete brand
*BrandApi* | [**getBrand**](docs/Api/BrandApi.md#getbrand) | **GET** /brand/{brandId} | Get existing Brand by ID
*BrandApi* | [**getBrandFeedback**](docs/Api/BrandApi.md#getbrandfeedback) | **GET** /brand/feedback/{brandId} | Get brand feedback by ID
*BrandApi* | [**importBrandExternalVetting**](docs/Api/BrandApi.md#importbrandexternalvetting) | **PUT** /brand/{brandId}/externalVetting | Import external vetting record
*BrandApi* | [**listBrands**](docs/Api/BrandApi.md#listbrands) | **GET** /brand | Search brands
*BrandApi* | [**listExternalVettings**](docs/Api/BrandApi.md#listexternalvettings) | **GET** /brand/{brandId}/externalVetting | Get list of external vetting record for a given brand
*BrandApi* | [**orderBrandExternalVetting**](docs/Api/BrandApi.md#orderbrandexternalvetting) | **POST** /brand/{brandId}/externalVetting | Order new external vetting for a brand
*BrandApi* | [**revetBrand**](docs/Api/BrandApi.md#revetbrand) | **PUT** /brand/{brandId}/revet | Revet the brand
*BrandApi* | [**updateBrand**](docs/Api/BrandApi.md#updatebrand) | **PUT** /brand/{brandId} | Update brand properties
*CampaignApi* | [**deactivateMyCampaign**](docs/Api/CampaignApi.md#deactivatemycampaign) | **DELETE** /campaign/{campaignId} | Deactivate my campaign
*CampaignApi* | [**getMyCampaign**](docs/Api/CampaignApi.md#getmycampaign) | **GET** /campaign/{campaignId} | Get my campaign details
*CampaignApi* | [**getMyCampaignMnoMetadata**](docs/Api/CampaignApi.md#getmycampaignmnometadata) | **GET** /campaign/{campaignId}/mnoMetadata | Get my campaign MNO metadata
*CampaignApi* | [**getMyCampaignOperationStatus**](docs/Api/CampaignApi.md#getmycampaignoperationstatus) | **GET** /campaign/{campaignId}/operationStatus | Get campaign operation status at MNO level
*CampaignApi* | [**getMyCampaignSharingStatus**](docs/Api/CampaignApi.md#getmycampaignsharingstatus) | **GET** /campaign/{campaignId}/sharing | Get my campaign sharing status
*CampaignApi* | [**getMyOsrCampaignAttributes**](docs/Api/CampaignApi.md#getmyosrcampaignattributes) | **GET** /campaign/{campaignId}/osr/attributes | Get my campaign attributes from OSR
*CampaignApi* | [**listMyCampaigns**](docs/Api/CampaignApi.md#listmycampaigns) | **GET** /campaign | Search my campaigns
*CampaignApi* | [**shareMyCampaign**](docs/Api/CampaignApi.md#sharemycampaign) | **PUT** /campaign/{campaignId}/sharing/{upstreamCnpId} | Share my campaign to an upstream connectivity partner. ** Replaces elect primary DCA for campaign **
*CampaignApi* | [**updateMyCampaign**](docs/Api/CampaignApi.md#updatemycampaign) | **PUT** /campaign/{campaignId} | Update my campaign properties
*CampaignBuilderApi* | [**qualifyAllUsecases**](docs/Api/CampaignBuilderApi.md#qualifyallusecases) | **GET** /campaignBuilder/brand/{brandId} | Campaign builder Step 1: Qualify brand for all usecases
*CampaignBuilderApi* | [**qualifyByUsecase**](docs/Api/CampaignBuilderApi.md#qualifybyusecase) | **GET** /campaignBuilder/brand/{brandId}/usecase/{usecase} | Campaign builder Step 1: Qualify brand by usecase
*CampaignBuilderApi* | [**submitCampaign**](docs/Api/CampaignBuilderApi.md#submitcampaign) | **POST** /campaignBuilder | Campaign builder Step 2: Create new campaign
*EnumTypeApi* | [**getAllDcas**](docs/Api/EnumTypeApi.md#getalldcas) | **GET** /enum/dca | List all DCAs
*EnumTypeApi* | [**getAllMnos**](docs/Api/EnumTypeApi.md#getallmnos) | **GET** /enum/mno | List all MNOs
*EnumTypeApi* | [**getAllOptionalAttributeNames**](docs/Api/EnumTypeApi.md#getalloptionalattributenames) | **GET** /enum/optionalAttributeNames | List all brand optional attribute names
*EnumTypeApi* | [**getAllUsecases**](docs/Api/EnumTypeApi.md#getallusecases) | **GET** /enum/usecase | List all use-cases
*EnumTypeApi* | [**getAllVerticals**](docs/Api/EnumTypeApi.md#getallverticals) | **GET** /enum/vertical | List all verticals
*EnumTypeApi* | [**getAltBusinessIdType**](docs/Api/EnumTypeApi.md#getaltbusinessidtype) | **GET** /enum/altBusinessIdType | Get Alternative Business ID types
*EnumTypeApi* | [**getBrandIdentityStatus**](docs/Api/EnumTypeApi.md#getbrandidentitystatus) | **GET** /enum/brandIdentityStatus | Get brand identity statuses
*EnumTypeApi* | [**getBrandRelationship**](docs/Api/EnumTypeApi.md#getbrandrelationship) | **GET** /enum/brandRelationship | Get Brand Relationship types
*EnumTypeApi* | [**getCampaignStatusType**](docs/Api/EnumTypeApi.md#getcampaignstatustype) | **GET** /enum/campaignStatus | Get Campaign status types
*EnumTypeApi* | [**getEntityType**](docs/Api/EnumTypeApi.md#getentitytype) | **GET** /enum/entityType | Get Entity types
*EnumTypeApi* | [**getVettingProviders**](docs/Api/EnumTypeApi.md#getvettingproviders) | **GET** /enum/extVettingProvider | Get External vetting providers
*EnumTypeApi* | [**getVettingStatusTypes**](docs/Api/EnumTypeApi.md#getvettingstatustypes) | **GET** /enum/vettingStatus | Get Vetting status types
*EnumTypeApi* | [**listBrandStatus**](docs/Api/EnumTypeApi.md#listbrandstatus) | **GET** /enum/brandStatus | List brand statuses
*EnumTypeApi* | [**listConnectivityPartners**](docs/Api/EnumTypeApi.md#listconnectivitypartners) | **GET** /enum/cnp | List connectivity partners
*EnumTypeApi* | [**listMnoOperationStatus**](docs/Api/EnumTypeApi.md#listmnooperationstatus) | **GET** /enum/operationStatus | List all MNO campaign operation statuses
*EnumTypeApi* | [**listPublicCompany**](docs/Api/EnumTypeApi.md#listpubliccompany) | **GET** /enum/approvedPublicCompany | List all TCR approved public companies for use as a Brand
*EnumTypeApi* | [**listStockExchanges**](docs/Api/EnumTypeApi.md#liststockexchanges) | **GET** /enum/stockExchange | List all stock exchanges
*EnumTypeApi* | [**listVettingClass**](docs/Api/EnumTypeApi.md#listvettingclass) | **GET** /enum/vettingClass | List all vetting classes
*ErrorCodeApi* | [**listErrorCodes**](docs/Api/ErrorCodeApi.md#listerrorcodes) | **GET** /error | List all error codes
*MockCVTokenApi* | [**createMockCvToken**](docs/Api/MockCVTokenApi.md#createmockcvtoken) | **POST** /brand/{brandId}/externalVetting/mockCvToken | Generate mock CV token for Non-production environments
*PartnerCampaignApi* | [**declineSharedPartnerCampaign**](docs/Api/PartnerCampaignApi.md#declinesharedpartnercampaign) | **DELETE** /partnerCampaign/{campaignId}/sharing | Decline partner campaign sharing request
*PartnerCampaignApi* | [**getPartnerCampaign**](docs/Api/PartnerCampaignApi.md#getpartnercampaign) | **GET** /partnerCampaign/{campaignId} | Get partner shared campaign details
*PartnerCampaignApi* | [**getPartnerCampaignMnoMetadata**](docs/Api/PartnerCampaignApi.md#getpartnercampaignmnometadata) | **GET** /partnerCampaign/{campaignId}/mnoMetadata | Get partner campaign MNO metadata
*PartnerCampaignApi* | [**getPartnerCampaignOperationStatus**](docs/Api/PartnerCampaignApi.md#getpartnercampaignoperationstatus) | **GET** /partnerCampaign/{campaignId}/operationStatus | Get partner campaign operation status at MNO level
*PartnerCampaignApi* | [**getPartnerCampaignSharingStatus**](docs/Api/PartnerCampaignApi.md#getpartnercampaignsharingstatus) | **GET** /partnerCampaign/{campaignId}/sharing | Get partner campaign sharing status
*PartnerCampaignApi* | [**getPartnerCampaignsByDownstreamCNP**](docs/Api/PartnerCampaignApi.md#getpartnercampaignsbydownstreamcnp) | **GET** /partnerCampaign/sharedWithMe | Search partner shared campaigns filtered by downstream connectivity partner
*PartnerCampaignApi* | [**getPartnerCampaignsByUpstreamCNP**](docs/Api/PartnerCampaignApi.md#getpartnercampaignsbyupstreamcnp) | **GET** /partnerCampaign/sharedByMe | Search partner shared campaigns filtered by upstream connectivity partner
*PartnerCampaignApi* | [**sharePartnerCampaign**](docs/Api/PartnerCampaignApi.md#sharepartnercampaign) | **PUT** /partnerCampaign/{campaignId}/sharing/{upstreamCnpId} | Share partner campaign with an upstream connectivity partner
*PlatformApi* | [**getProfile**](docs/Api/PlatformApi.md#getprofile) | **GET** /csp/profile | Get current profile
*PlatformApi* | [**getVersion**](docs/Api/PlatformApi.md#getversion) | **GET** /version | Software version
*PlatformFreeTrialApi* | [**getPftBrand**](docs/Api/PlatformFreeTrialApi.md#getpftbrand) | **GET** /pft/brand | Get my Platform Free Trial brand
*PlatformFreeTrialApi* | [**insertPlatformFreeTrialParticipant**](docs/Api/PlatformFreeTrialApi.md#insertplatformfreetrialparticipant) | **POST** /pft/participant | Report new platform free trial account provisioning event
*ResellerApi* | [**createReseller**](docs/Api/ResellerApi.md#createreseller) | **POST** /reseller | Create a new reseller
*ResellerApi* | [**deleteReseller**](docs/Api/ResellerApi.md#deletereseller) | **DELETE** /reseller/{resellerId} | Delete reseller
*ResellerApi* | [**getReseller**](docs/Api/ResellerApi.md#getreseller) | **GET** /reseller/{resellerId} | Get reseller details
*ResellerApi* | [**listResellers**](docs/Api/ResellerApi.md#listresellers) | **GET** /reseller | Search resellers
*ResellerApi* | [**updateReseller**](docs/Api/ResellerApi.md#updatereseller) | **PUT** /reseller/{resellerId} | Update reseller
*SearchableKeywordTagApi* | [**deleteTag**](docs/Api/SearchableKeywordTagApi.md#deletetag) | **DELETE** /tag/name/{name}/recordType/{recordType}/recordId/{recordId} | Delete a tag attached to a brand or campaign
*SearchableKeywordTagApi* | [**search**](docs/Api/SearchableKeywordTagApi.md#search) | **GET** /tag | Search existing tags
*SearchableKeywordTagApi* | [**setTag**](docs/Api/SearchableKeywordTagApi.md#settag) | **PUT** /tag | Set a tag on a brand or campaign
*WebhookApi* | [**listEventCategories**](docs/Api/WebhookApi.md#listeventcategories) | **GET** /webhook/eventCategory | List all event categories
*WebhookApi* | [**listEventTypes**](docs/Api/WebhookApi.md#listeventtypes) | **GET** /webhook/eventType | List all event types
*WebhookApi* | [**listWebhook**](docs/Api/WebhookApi.md#listwebhook) | **GET** /webhook/subscription | List all webhook subscriptions
*WebhookApi* | [**subscribeWebhook**](docs/Api/WebhookApi.md#subscribewebhook) | **PUT** /webhook/subscription | Subscribe API webhook
*WebhookApi* | [**testWebhook**](docs/Api/WebhookApi.md#testwebhook) | **GET** /webhook/subscription/{eventCategory}/test | Test webhook by event (Deprecated)
*WebhookApi* | [**testWebhook1**](docs/Api/WebhookApi.md#testwebhook1) | **GET** /webhook/subscription/eventType/{eventType}/mock | Send a mock webhook to your endpoint
*WebhookApi* | [**unsubscribeWebhook**](docs/Api/WebhookApi.md#unsubscribewebhook) | **DELETE** /webhook/subscription/{eventCategory} | Unsubscribe webhook by event category

## Documentation For Models

 - [ApiError](docs/Model/ApiError.md)
 - [ApiErrorCSP](docs/Model/ApiErrorCSP.md)
 - [Brand](docs/Model/Brand.md)
 - [BrandCSP](docs/Model/BrandCSP.md)
 - [BrandFeedbackCSP](docs/Model/BrandFeedbackCSP.md)
 - [BrandRecordSetCSP](docs/Model/BrandRecordSetCSP.md)
 - [BrandRequest](docs/Model/BrandRequest.md)
 - [Campaign](docs/Model/Campaign.md)
 - [CampaignCSP](docs/Model/CampaignCSP.md)
 - [CampaignRecordSetCSP](docs/Model/CampaignRecordSetCSP.md)
 - [CampaignRequest](docs/Model/CampaignRequest.md)
 - [CampaignSharingChain](docs/Model/CampaignSharingChain.md)
 - [CampaignSharingStatus](docs/Model/CampaignSharingStatus.md)
 - [CampaignSubmissionResponse](docs/Model/CampaignSubmissionResponse.md)
 - [CspProfile](docs/Model/CspProfile.md)
 - [Dca](docs/Model/Dca.md)
 - [EventType](docs/Model/EventType.md)
 - [ExtVettingProvider](docs/Model/ExtVettingProvider.md)
 - [ExternalVetting](docs/Model/ExternalVetting.md)
 - [ExternalVettingImportRequest](docs/Model/ExternalVettingImportRequest.md)
 - [ExternalVettingMockCvTokenBody](docs/Model/ExternalVettingMockCvTokenBody.md)
 - [ExternalVettingOrderRequest](docs/Model/ExternalVettingOrderRequest.md)
 - [FeedbackCategoryCSP](docs/Model/FeedbackCategoryCSP.md)
 - [Metadata](docs/Model/Metadata.md)
 - [MetadataCSP](docs/Model/MetadataCSP.md)
 - [Mno](docs/Model/Mno.md)
 - [NewPlatformFreeTrialParticipant](docs/Model/NewPlatformFreeTrialParticipant.md)
 - [OptionalAttributeName](docs/Model/OptionalAttributeName.md)
 - [PlatformFreeTrialParticipant](docs/Model/PlatformFreeTrialParticipant.md)
 - [PublicCompany](docs/Model/PublicCompany.md)
 - [PublicCompanyRecordSet](docs/Model/PublicCompanyRecordSet.md)
 - [RecordSetBrandCSP](docs/Model/RecordSetBrandCSP.md)
 - [RecordSetCampaignCSP](docs/Model/RecordSetCampaignCSP.md)
 - [RecordSetPublicCompany](docs/Model/RecordSetPublicCompany.md)
 - [RecordSetReseller](docs/Model/RecordSetReseller.md)
 - [RecordSetSharedCampaign](docs/Model/RecordSetSharedCampaign.md)
 - [RecordSetTagCSP](docs/Model/RecordSetTagCSP.md)
 - [Reseller](docs/Model/Reseller.md)
 - [ResellerRecordSet](docs/Model/ResellerRecordSet.md)
 - [SharedCampaign](docs/Model/SharedCampaign.md)
 - [SharedCampaignRecordSet](docs/Model/SharedCampaignRecordSet.md)
 - [Tag](docs/Model/Tag.md)
 - [TagCSP](docs/Model/TagCSP.md)
 - [TagRecordSetCSP](docs/Model/TagRecordSetCSP.md)
 - [UpdateBrand](docs/Model/UpdateBrand.md)
 - [UpdateCampaign](docs/Model/UpdateCampaign.md)
 - [UpdateReseller](docs/Model/UpdateReseller.md)
 - [UsecaseMetadata](docs/Model/UsecaseMetadata.md)
 - [VettingClass](docs/Model/VettingClass.md)
 - [WebhookResponse](docs/Model/WebhookResponse.md)
 - [WebhookSubscription](docs/Model/WebhookSubscription.md)

## Documentation For Authorization


## myBasicAuthSecurity

- **Type**: HTTP basic authentication


## Author

support@campaignregistry.com

