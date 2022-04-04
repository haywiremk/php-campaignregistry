<?php
/**
 * BrandCSP
 *
 * PHP version 5
 *
 * @category Class
 * @package  TCR\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * CSP Registry API
 *
 * ## Overview The Campaign Registry (TCR) data model contains 3 key entities†: * **_Campaign Service Provider_** (CSP), who is contracted with Direct Connect Aggregator (DCA or 0-Hop)) and TCR. CSP is typically the party hosting the campaign on its own technology platform. CSP account creation in TCR requires manual vetting and reference checks. * **_Brand_** is the legal entity or role responsible for the messaging content in a campaign. A brand depends on the CSP for submitting a campaign request to TCR. TCR will perform Cyber and Identity verifications against every brand registered by CSP.  * **_Campaign_** is an encompassing entity that ties together the _who_ (CSP and Brand) and the _what_ (Use Case) for all 10DLC messaging campaigns. A campaign can only be submitted by the CSP.    † TCR also supports Reseller(Large account). CSP manages the resellers and identify campaigns that belong to a reseller. Reseller can be set **ONLY ONCE** while creating or updating campaign.  ### Identifier A unique identifier is assigned to each above-referenced entity. CSP, Brand, and Campaign are assigned unique 7-char upper alphanumeric identity prefixed with the letter 'S', 'B' and 'C' respectively. These identities are used throughout this API operations.  ### Blocking vs Non-Blocking Brand Registration There are two API endpoints available for registering brands: Blocking vs Non-Blocking. The blocking flavor will 'block' until TCR completes the initial brand scoring task, which may take more than 10 seconds. The non-blocking version does not wait for the brand scoring task and returns much quicker.  The non-blocking version is suitable for CSP who wish to register a number of brands in an offline process. Brands registered via non-blocking API are not immediately ready for campaign registration. The CSP must be notified (via webhook event BRAND_SCORE_UPDATE) before a campaign can be registered for the brand. Under a non-queuing steady-state operation, the expected wait time is under 2 minutes.  ### Brand Identity Status When a Non-Sole Prop brand is registered, TCR will attempt to verify the identity of the brand based on the supplied information. The brand is assigned a `VERIFIED` or `UNVERIFIED` status upon registration completion. If the brand has the `UNVERIFIED` identity status, then the brand will not qualify to run campaign on any MNO network.   #### Levels of Brand Identity Statuses * **_SELF_DECLARED_** Applicable to Sole-Proprietor entity type. TCR does not make attempt to verify the brand information. * **_UNVERIFIED_** TCR is unable to verify or identify the existence of the brand. An UNVERIFIED brand is not permitted to run a 10DLC campaign. * **_VERIFIED_** TCR is able to verify the information and identify the existence of the organization. A VERIFIED brand is permitted to run standard 10DLC campaigns across all MNO networks. * **_VETTED_VERIFIED_** Brand with an external STANDARD class vet. A VETTED_VERIFIED brand may potentially gain access to higher throughput and additional use-cases across some MNO networks.    If a brand is assigned an UNVERIFIED status, the CSP can make corrections based on the hints from the brand feedback API. The below table summarizes the possible brand feedback issues by entity type and potential course of actions:  | Entity Type     | Potential causes for UNVERIFIED status                                                                               | Recourse                                               | |-----------------|----------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------| | PRIVATE_PROFIT  | Invalid ein, or mismatch between ein and companyName.                                                                | 1)Revet w/ correction. 2)External vet with correction. | | PUBLIC_PROFIT   | Invalid ein, or mismatch between ein and companyName.                                                                | 1)Revet w/ correction. 2)External vet with correction. | | NON_PROFIT      | Invalid ein, mismatch between ein and companyName.                                                                   | 1)Revet w/ correction. 2)External vet with correction. | | GOVERNMENT      | Invalid ein, mismatch between ein and companyName.                                                                   | 1)Revet w/ correction. 2)External vet with correction. | | SOLE_PROPRIETOR | -- Not applicable --                                                                                                 | -- Not applicable --                                   |  ### Brand Optional Attributes Brand optional attributes are a collection of non-standard attributes applicable to some brands based on characteristics not limited to entity types. The brand optional attributes (_optionalAttributes_) is a property of Brand object. Some examples of optional attributes: * **_russell3000_** Recognizes public companies that are in the Russell 3000 index. The said brand may be granted higher throughput on some MNO networks. * **_taxExemptStatus_** Identifies the tax-exempt 501c status for a non-profit brand. A '501c3' status is mandatory for accessing CHARITY use-case on some MNO networks. * **_politicalCommitteeLocale_** Political committee Locale identified by a Campaign Verify vet. Possible values are federal, state, local and tribal. * **_section527_** Section 527 status identified by a Campaign Verify vet. A 527 group is a type of U.S. tax-exempt organization organized under Section 527 of the U.S. Internal Revenue Code. The said brand may be granted higher throughput on some MNO networks.  * **_governmentEntity_** Confirmation that the brand is a closely affiliated, generally by government ownership or control, with federal, state or local governments. The said brand may be granted higher throughput on some MNO networks.  The list of defined optional attributes can be retrieved through the `GET /enum/optionalAttributeNames` API endpoint.  ### Brand External Vetting  Some special campaign use-cases require the brand to be vetted by a participating vetting provider. TCR can either accept existing vetting records from a TCR approved vetting provider, or accept a new vetting request to be placed via an API call. The steps for both workflows are detailed as follow:  #### Existing Vet 1. CSP to create a brand in TCR. (Skip if the brand is already in TCR) 2. CSP to invoke `PUT /brand/{brand}/externalVetting` operation to confirm the vetting credential `evpId` (Vetting Identifier) and optionally required for some vetting provider the `vettingToken` are passed into the API call. This API call will return synchronously with the latest vetting record status.   #### Order New External Vet  1. CSP to create a brand in TCR. (Skip if the brand is already in TCR) 2. CSP to invoke `POST /brand/{brand}/externalVetting` operation to initiate a brand vetting through the desired EVP. This API call is not expected to return vetting results.  3. Vetting results may take anywhere from 30 seconds to 24 hours depending on the vetting provider. When the vetting provider completes vetting, the results are recorded in TCR. Vetting status can either be pushed to CSP via webhook or polled by CSP via API call.  ### Brand Deletion Here are some business rules around brand deletion: * Brand deletion is an irreversible action. * Brand can be deleted from a CSP account if the brand does not have any active campaigns.  * Deleted brands remain searchable in `GET /brand` API endpoint. However, `GET /brand/{brandId}` API for deleted brand will results in error 502 - \"Brand not found\". * Expired campaigns associated with deleted brands remain searchable in `GET /campaign` API endpoint.   ### Campaign Lifecycle  1. **_Register brand:_** Every campaign must be associated with a brand. CSP can register the brand using the **_Brand Operations_**.  2. **_Register campaign:_** CSP can use the **_Campaign Builder Operations_**. Most registered brands will qualify for a majority of standard campaign use-cases. There are some special use-cases that require proof of brand-vetting and/or Mobile Network Operator (MNO) approval.  TCR can track campaign approval status across individual participating MNO networks. CSP can pull (via API call) and/or receive push (via webhook) on campaign MNO operation status changes. 3. **_Share campaign:_** CSP can use the **_Campaign Sharing Operations_** to share campaign with upstream connectivity partner (CNP) for campaign on-boarding with MNO. CNP assigns phone number to campaign.     4. **_Sunset campaign:_** Campaign registration is paid on a quarterly basis. CSP can cancel auto-renewal or deactivate to terminate the campaign immediately.   <img src=\"/assets/images/csp_api_std_flow_v1.jpg\" />  ### Campaign Sharing While registering a campaign, the CSP is required to share with an upstream Connectivity Partner (CNP) who they work with to provision the campaign. A Connectivity Partner may be an TCR CSP or DCA. The sharing process continue up the stream until the campaign reaches a DCA.   <img src=\"/assets/images/cnp_chain.jpeg\" />  #### Campaign Sharing Principles 1. The term 'Downstream Connectivity Partner' a.k.a. 'Downstream CNP' describes the CNP sharing campaign with you. Conversely, the term 'Upstream CNP' identifies the CNP with whom the campaign is shared. 2. The campaign CSP may share campaigns directly to a DCA. This is the most direct way to on-board a campaign.   3. Once a campaign is shared with an upstream CNP, the sharing status is marked `PENDING`. While the sharing status is in the `PENDING` state, the downstream CNP cannot rescind the sharing request nor change the upstream CNP. 4. Upstream CNP can decline a sharing request from downstream CNP. Action to decline a sharing request will mark the sharing status to a `DECLINED` state. At this point, the downstream CNP is allowed to share campaigns with a different upstream CNP. 5. The sharing status is updated to `ACCEPTED` state under the following circumstances: 1)Upstream CNP is a CSP and shares the campaign to another CNP, taking the campaign further up the chain, 2)Upstream CNP is a DCA.   6. The adjacent downstream CNP is notified of sharing status change via the webhook mechanism.  7. When a campaign is shared with an upstream CNP, campaign details are shared based on a needed basis. When sharing the campaign with another CSP, the majority of the campaign details are obfuscated or hidden from the upstream CSP. However, when a campaign is shared with a DCA, the entire campaign details, including the CNP chain formation/hops are visible to the DCA.   ## API Interactions API includes both a pull model and push (aka webhook) model communication between CSP and TCR. Depending on the specific requirements, CSP may choose to implement one or both. More specifically, pull model API calls are intended for querying or updating TCR entities, while webhook is intended for CSP to be notified of events or updates that occurred in TCR. For example, CSP can query campaign details by issuing a pull query against TCR. CSP can be notified via webhook when a new campaign or brand is registered in TCR.  ### Webhook Event Types and Event Categories TCR produces several events grouped into categories. CSP can subscribe to receive notification of events by category. A subscription can be created by associating a CSP webhook endpoint to an event category.  Webhook event is expected to be in form of a flat-map JSON data structure. Webhook event contains an `eventType` along with other JSON properties. Here are the possible list of JSON attributes:  | JSON Attribute     | Description                                                                        | Mandatory | Data Type | |--------------------|------------------------------------------------------------------------------------|-----------|-----------| | eventType          | Webhook event type                                                                 | Yes       | String    | | cspId              | CSP ID                                                                             | No        | String    | | cnpId              | CNP ID                                                                             | No        | String    | | cspName            | CSP display name                                                                   | No        | String    | | brandId            | Brand ID                                                                           | No        | String    | | brandName          | Brand display name                                                                 | No        | String    | | brandReferenceId   | Brand reference ID (Visible to brand creator)                                      | No        | String    | | brandIdentityStatus| Updated brand identity status. Applicable to BRAND_IDENTITY_STATUS_UPDATE event    | No        | String    | | campaignId         | Campaign ID                                                                        | No        | String    | | campaignReferenceId| Campaign reference ID (Visible to campaign creator)                                | No        | String    | | dcaId              | DCA ID                                                                             | No        | String    | | dcaName            | DCA display name                                                                   | No        | String    | | description        | Description                                                                        | No        | String    | | evpId              | External Vetting Provider ID                                                       | No        | String    | | evpName            | External Vetting Provider display name                                             | No        | String    | | vettingId          | External vetting ID                                                                | No        | String    | | mnoId              | Mobile Network Operator ID\\. Please refer to Network resource for list of all MNOs | No        | Long      | | mnoName            | Mobile Network Operator display name                                               | No        | String    | | mock              | Event associated with a mock brand if attribute exists and value is 'true'         | No        | Boolean   |   #### Webhook Example - Notification of campaign suspension by AT&T   ```sh POST / HTTP/1.1 Host: tcr.requestcatcher.com Accept: *.* Connection: keep-alive Content-Length: 226 Content-Type: application/json; utf-8 X-Registry-Signature: SmqzLvP6uQDM6DD2lfdLqwiJJbo=  {   \"cspId\" : \"SUEKBB\",   \"brandName\" : \"Microsoft\",   \"brandName\" : \"Microsoft\",   \"mnoName\" : \"AT&T\",   \"campaignId\" : \"CRMKK5Y\",   \"campaignReferenceId\" : \"C-00388\",   \"brandId\" : \"BFHXANR\",   \"brandReferenceId\" : \"Q-29393332\",   \"mnoId\" : 10017,   \"eventType\" : \"MNO_CAMPAIGN_OPERATION_SUSPENDED\",   \"cspName\" : \"ACME\" } ```  ### Webhook Authentication To ensure secure communication between TCR and the subscriber application, all the webhook notifications sent out from TCR will have HMAC-SHA1 signed \"X-Registry-Signature\" authentication header. Steps to verify the signed signature by every subscriber: 1. Canonicalize the JSON raw content (webhook notification body) into a string. Refer <a href=\"https://github.com/cyberphone/json-canonicalization\">JCS defined canonicalization</a>. 2. Build string to be signed, stringToSign = webhook URL + canonicalized string. 3. AuthKey = subscriber's TCR account SECRET key. 4. Apply HMAC-SHA1 algorithm on the stringToSign with authKey and get the signedString. Refer to the 'How to Validate a Webhook Signature using HMAC' section in <a href=\"https://drive.google.com/file/d/1RcYnV8J2KAC08A4P2f1vV_g3SBe1GhEq/view\">Webhook Instructions for CSP API</a>. 5. Compare the X-Registry-Signature value with the signedString to determine the authenticity of the webhook notification.  #### Webhook IP Addresses The IP addresses that TCR uses to make webhooks to your server are limited to following the addresses:  * Production: `52.44.59.112` * QA/Sandbox and Staging: `107.23.98.23`  ### API Authentication TCR REST API operations are only accessible via HTTPS to ensure API call data is encrypted between the registry server and your application.  To protect against unauthorized access, the TCR server requires call level authentication for CSP identity.  CSP Registry REST API supports Basic Authentication. Basic Authentication is an industry-standard for enforcing access control to the HTTP resources.  CSP account must be provisioned for REST API access. Once provisioned, CSP will be assigned a pair of authentication tokens: `APIKEY` and `SECRET`.  `APIKEY` and `SECRET` tokens are passed as User and Password elements of the basic authentication header.  ```sh $ curl --user [APIKEY]:[SECRET] GET \"http://[SERVER]/v1/enum/entityType\" -H \"accept: application/json\" ```  ### API Rate Limiting A rate limit is the number of API calls a CSP account can make within a given time period. If this limit is exceeded, API requests made by the CSP will fail with an HTTP status 429 code. Unless specified otherwise, all GET operations are rate-limited at 20 requests per second, while all PUT, POST, and DELETE operations are rate-limited at 20 requests per 10 seconds.  ### Platform Free Trial (PFT) Feature CSP can register platform-free-trial campaigns to support trial customer messaging activities. The PFT feature requires MNO approval. Please contact TCR support for the approval process.  CSP can check for the PFT feature status by issuing an API call against the `GET /csp/profile` endpoint.  #### Registering PFT Campaigns Upon approval by MNO, the CSP will be assigned a PFT-enabled brand by the TCR team. You can retrieve the Brand ID by issuing an API call against the `GET /pft/brand` endpoint.  Here are some business rules surrounding PFT campaigns: * A single PFT-enabled brand is assigned to the CSP account.  * This PFT-enabled brand is used for registering all PFT campaigns with use-case type: TRIAL.  * CSP is allowed to register one campaign for its own use plus one campaign per ISV/reseller.  * When registering a PFT campaign for an ISV, the said ISV must be identified by the 'resellerId' parameter in the `POST /campaignBuilder` API request. * The registration and sharing processes for the PFT type campaign are otherwise identical to a standard use-case type.  <img src=\"/assets/images/pft_flow.jpg\" />  NOTE: The Platform Free Trial feature is not enabled by default for CSP accounts. Please contact TCR support for more information.  #### Reporting PFT User Provisioning MNOs mandate CSP to report user-provisioning events to TCR. A user-provisioning event is recognized when the CSP (or CSP's ISV) assigns a 10DLC long code to a free trial user account.  The CSP must report this event on a real-time basis as trial account users are assigned 10DLC long codes. There is no need to report deactivation or de-provisioning of the trial user account to TCR.  Please refer to the `POST /pft/participant` endpoint for more usage details.  ### Sole Proprietor Type/Feature Brand without a business EIN can be registered into TCR under the new SOLE_PROPRIETOR entity designation. Here are some key limitations of SOLE_PRPRIETOR entity type: * Has lower message throughput.  * Is limited to a single campaign of SOLE_PROPRIETOR use-case, supporting mixed messaging content. * Is limited to 5 10DLC numbers provisioned to the campaign. * Is not eligible for external vet to gain higher messaging throughput.  <img src=\"/assets/images/sp_flow.jpg\" />  NOTE: The Sole proprietor feature is not enabled by default for CSP accounts. Please contact TCR support for more information.  ### Mock Brand and Campaign Mock brand and campaign are used to test applications without actually registering records into NetNumber OSR or incur any billable charges. Here are some additional business rules surrounding mock brands and campaigns: * All mock brands will be automatically deleted 30 days after initial registration. Deletion will cascade across all campaigns created from mock brands. * Mock brands and campaigns are only visible privately to the CSP.  * Mock brands can be externally vetted to access special use cases. * Campaigns created from mock brands are mock campaigns. * Mock campaigns are not functional campaigns. You cannot run SMS traffic over mock campaigns. * Mock campaigns cannot be shared upstream to CNP and are not registered in NetNumber OSR.  * Webhook events associated with mock brands or campaigns are identified with JSON attribute 'mock' = true.     ## How To Use This Interactive API Doc This interactive API doc enables a developer to test API operations in the API suite. To invoke the API call in the interactive console,  you must first log-in by clicking on the green **Authorize** button. Use your assigned authentication tokens `APIKEY` in **Username** field and `SECRET` in **Password** field of the login dialog box.  ## API Version and Changelog The API version number can be accessed via `GET /version` operation. The changelog is available <a href=\"https://release.campaignregistry.com/changelogs\">here</a>.
 *
 * OpenAPI spec version: 1.0
 * Contact: support@campaignregistry.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.33
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace TCR\Client\Model;

use \ArrayAccess;
use \TCR\Client\ObjectSerializer;

/**
 * BrandCSP Class Doc Comment
 *
 * @category Class
 * @description A brand is a business identity behind the campaign.
 * @package  TCR\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class BrandCSP implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Brand_CSP';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'entity_type' => 'string',
'csp_id' => 'string',
'brand_id' => 'string',
'first_name' => 'string',
'last_name' => 'string',
'display_name' => 'string',
'company_name' => 'string',
'ein' => 'string',
'ein_issuing_country' => 'string',
'phone' => 'string',
'street' => 'string',
'city' => 'string',
'state' => 'string',
'postal_code' => 'string',
'country' => 'string',
'email' => 'string',
'stock_symbol' => 'string',
'stock_exchange' => 'string',
'ip_address' => 'string',
'website' => 'string',
'brand_relationship' => 'string',
'vertical' => 'string',
'alt_business_id' => 'string',
'alt_business_id_type' => 'string',
'universal_ein' => 'string',
'reference_id' => 'string',
'optional_attributes' => 'map[string,object]',
'mock' => 'bool',
'identity_status' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'entity_type' => null,
'csp_id' => null,
'brand_id' => null,
'first_name' => null,
'last_name' => null,
'display_name' => null,
'company_name' => null,
'ein' => null,
'ein_issuing_country' => null,
'phone' => null,
'street' => null,
'city' => null,
'state' => null,
'postal_code' => null,
'country' => null,
'email' => null,
'stock_symbol' => null,
'stock_exchange' => null,
'ip_address' => null,
'website' => null,
'brand_relationship' => null,
'vertical' => null,
'alt_business_id' => null,
'alt_business_id_type' => null,
'universal_ein' => null,
'reference_id' => null,
'optional_attributes' => null,
'mock' => null,
'identity_status' => null    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'entity_type' => 'entityType',
'csp_id' => 'cspId',
'brand_id' => 'brandId',
'first_name' => 'firstName',
'last_name' => 'lastName',
'display_name' => 'displayName',
'company_name' => 'companyName',
'ein' => 'ein',
'ein_issuing_country' => 'einIssuingCountry',
'phone' => 'phone',
'street' => 'street',
'city' => 'city',
'state' => 'state',
'postal_code' => 'postalCode',
'country' => 'country',
'email' => 'email',
'stock_symbol' => 'stockSymbol',
'stock_exchange' => 'stockExchange',
'ip_address' => 'ipAddress',
'website' => 'website',
'brand_relationship' => 'brandRelationship',
'vertical' => 'vertical',
'alt_business_id' => 'altBusinessId',
'alt_business_id_type' => 'altBusinessIdType',
'universal_ein' => 'universalEin',
'reference_id' => 'referenceId',
'optional_attributes' => 'optionalAttributes',
'mock' => 'mock',
'identity_status' => 'identityStatus'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'entity_type' => 'setEntityType',
'csp_id' => 'setCspId',
'brand_id' => 'setBrandId',
'first_name' => 'setFirstName',
'last_name' => 'setLastName',
'display_name' => 'setDisplayName',
'company_name' => 'setCompanyName',
'ein' => 'setEin',
'ein_issuing_country' => 'setEinIssuingCountry',
'phone' => 'setPhone',
'street' => 'setStreet',
'city' => 'setCity',
'state' => 'setState',
'postal_code' => 'setPostalCode',
'country' => 'setCountry',
'email' => 'setEmail',
'stock_symbol' => 'setStockSymbol',
'stock_exchange' => 'setStockExchange',
'ip_address' => 'setIpAddress',
'website' => 'setWebsite',
'brand_relationship' => 'setBrandRelationship',
'vertical' => 'setVertical',
'alt_business_id' => 'setAltBusinessId',
'alt_business_id_type' => 'setAltBusinessIdType',
'universal_ein' => 'setUniversalEin',
'reference_id' => 'setReferenceId',
'optional_attributes' => 'setOptionalAttributes',
'mock' => 'setMock',
'identity_status' => 'setIdentityStatus'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'entity_type' => 'getEntityType',
'csp_id' => 'getCspId',
'brand_id' => 'getBrandId',
'first_name' => 'getFirstName',
'last_name' => 'getLastName',
'display_name' => 'getDisplayName',
'company_name' => 'getCompanyName',
'ein' => 'getEin',
'ein_issuing_country' => 'getEinIssuingCountry',
'phone' => 'getPhone',
'street' => 'getStreet',
'city' => 'getCity',
'state' => 'getState',
'postal_code' => 'getPostalCode',
'country' => 'getCountry',
'email' => 'getEmail',
'stock_symbol' => 'getStockSymbol',
'stock_exchange' => 'getStockExchange',
'ip_address' => 'getIpAddress',
'website' => 'getWebsite',
'brand_relationship' => 'getBrandRelationship',
'vertical' => 'getVertical',
'alt_business_id' => 'getAltBusinessId',
'alt_business_id_type' => 'getAltBusinessIdType',
'universal_ein' => 'getUniversalEin',
'reference_id' => 'getReferenceId',
'optional_attributes' => 'getOptionalAttributes',
'mock' => 'getMock',
'identity_status' => 'getIdentityStatus'    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    const ENTITY_TYPE_PRIVATE_PROFIT = 'PRIVATE_PROFIT';
const ENTITY_TYPE_PUBLIC_PROFIT = 'PUBLIC_PROFIT';
const ENTITY_TYPE_NON_PROFIT = 'NON_PROFIT';
const ENTITY_TYPE_GOVERNMENT = 'GOVERNMENT';
const ENTITY_TYPE_SOLE_PROPRIETOR = 'SOLE_PROPRIETOR';
const STOCK_EXCHANGE_NONE = 'NONE';
const STOCK_EXCHANGE_NASDAQ = 'NASDAQ';
const STOCK_EXCHANGE_NYSE = 'NYSE';
const STOCK_EXCHANGE_AMEX = 'AMEX';
const STOCK_EXCHANGE_AMX = 'AMX';
const STOCK_EXCHANGE_ASX = 'ASX';
const STOCK_EXCHANGE_B3 = 'B3';
const STOCK_EXCHANGE_BME = 'BME';
const STOCK_EXCHANGE_BSE = 'BSE';
const STOCK_EXCHANGE_FRA = 'FRA';
const STOCK_EXCHANGE_ICEX = 'ICEX';
const STOCK_EXCHANGE_JPX = 'JPX';
const STOCK_EXCHANGE_JSE = 'JSE';
const STOCK_EXCHANGE_KRX = 'KRX';
const STOCK_EXCHANGE_LON = 'LON';
const STOCK_EXCHANGE_NSE = 'NSE';
const STOCK_EXCHANGE_OMX = 'OMX';
const STOCK_EXCHANGE_SEHK = 'SEHK';
const STOCK_EXCHANGE_SGX = 'SGX';
const STOCK_EXCHANGE_SSE = 'SSE';
const STOCK_EXCHANGE_STO = 'STO';
const STOCK_EXCHANGE_SWX = 'SWX';
const STOCK_EXCHANGE_SZSE = 'SZSE';
const STOCK_EXCHANGE_TSX = 'TSX';
const STOCK_EXCHANGE_TWSE = 'TWSE';
const STOCK_EXCHANGE_VSE = 'VSE';
const STOCK_EXCHANGE_OTHER = 'OTHER';
const BRAND_RELATIONSHIP_BASIC_ACCOUNT = 'BASIC_ACCOUNT';
const BRAND_RELATIONSHIP_SMALL_ACCOUNT = 'SMALL_ACCOUNT';
const BRAND_RELATIONSHIP_MEDIUM_ACCOUNT = 'MEDIUM_ACCOUNT';
const BRAND_RELATIONSHIP_LARGE_ACCOUNT = 'LARGE_ACCOUNT';
const BRAND_RELATIONSHIP_KEY_ACCOUNT = 'KEY_ACCOUNT';
const ALT_BUSINESS_ID_TYPE_NONE = 'NONE';
const ALT_BUSINESS_ID_TYPE_DUNS = 'DUNS';
const ALT_BUSINESS_ID_TYPE_GIIN = 'GIIN';
const ALT_BUSINESS_ID_TYPE_LEI = 'LEI';
const IDENTITY_STATUS_SELF_DECLARED = 'SELF_DECLARED';
const IDENTITY_STATUS_UNVERIFIED = 'UNVERIFIED';
const IDENTITY_STATUS_VERIFIED = 'VERIFIED';
const IDENTITY_STATUS_VETTED_VERIFIED = 'VETTED_VERIFIED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEntityTypeAllowableValues()
    {
        return [
            self::ENTITY_TYPE_PRIVATE_PROFIT,
self::ENTITY_TYPE_PUBLIC_PROFIT,
self::ENTITY_TYPE_NON_PROFIT,
self::ENTITY_TYPE_GOVERNMENT,
self::ENTITY_TYPE_SOLE_PROPRIETOR,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStockExchangeAllowableValues()
    {
        return [
            self::STOCK_EXCHANGE_NONE,
self::STOCK_EXCHANGE_NASDAQ,
self::STOCK_EXCHANGE_NYSE,
self::STOCK_EXCHANGE_AMEX,
self::STOCK_EXCHANGE_AMX,
self::STOCK_EXCHANGE_ASX,
self::STOCK_EXCHANGE_B3,
self::STOCK_EXCHANGE_BME,
self::STOCK_EXCHANGE_BSE,
self::STOCK_EXCHANGE_FRA,
self::STOCK_EXCHANGE_ICEX,
self::STOCK_EXCHANGE_JPX,
self::STOCK_EXCHANGE_JSE,
self::STOCK_EXCHANGE_KRX,
self::STOCK_EXCHANGE_LON,
self::STOCK_EXCHANGE_NSE,
self::STOCK_EXCHANGE_OMX,
self::STOCK_EXCHANGE_SEHK,
self::STOCK_EXCHANGE_SGX,
self::STOCK_EXCHANGE_SSE,
self::STOCK_EXCHANGE_STO,
self::STOCK_EXCHANGE_SWX,
self::STOCK_EXCHANGE_SZSE,
self::STOCK_EXCHANGE_TSX,
self::STOCK_EXCHANGE_TWSE,
self::STOCK_EXCHANGE_VSE,
self::STOCK_EXCHANGE_OTHER,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getBrandRelationshipAllowableValues()
    {
        return [
            self::BRAND_RELATIONSHIP_BASIC_ACCOUNT,
self::BRAND_RELATIONSHIP_SMALL_ACCOUNT,
self::BRAND_RELATIONSHIP_MEDIUM_ACCOUNT,
self::BRAND_RELATIONSHIP_LARGE_ACCOUNT,
self::BRAND_RELATIONSHIP_KEY_ACCOUNT,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAltBusinessIdTypeAllowableValues()
    {
        return [
            self::ALT_BUSINESS_ID_TYPE_NONE,
self::ALT_BUSINESS_ID_TYPE_DUNS,
self::ALT_BUSINESS_ID_TYPE_GIIN,
self::ALT_BUSINESS_ID_TYPE_LEI,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getIdentityStatusAllowableValues()
    {
        return [
            self::IDENTITY_STATUS_SELF_DECLARED,
self::IDENTITY_STATUS_UNVERIFIED,
self::IDENTITY_STATUS_VERIFIED,
self::IDENTITY_STATUS_VETTED_VERIFIED,        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['entity_type'] = isset($data['entity_type']) ? $data['entity_type'] : null;
        $this->container['csp_id'] = isset($data['csp_id']) ? $data['csp_id'] : null;
        $this->container['brand_id'] = isset($data['brand_id']) ? $data['brand_id'] : null;
        $this->container['first_name'] = isset($data['first_name']) ? $data['first_name'] : null;
        $this->container['last_name'] = isset($data['last_name']) ? $data['last_name'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['company_name'] = isset($data['company_name']) ? $data['company_name'] : null;
        $this->container['ein'] = isset($data['ein']) ? $data['ein'] : null;
        $this->container['ein_issuing_country'] = isset($data['ein_issuing_country']) ? $data['ein_issuing_country'] : null;
        $this->container['phone'] = isset($data['phone']) ? $data['phone'] : null;
        $this->container['street'] = isset($data['street']) ? $data['street'] : null;
        $this->container['city'] = isset($data['city']) ? $data['city'] : null;
        $this->container['state'] = isset($data['state']) ? $data['state'] : null;
        $this->container['postal_code'] = isset($data['postal_code']) ? $data['postal_code'] : null;
        $this->container['country'] = isset($data['country']) ? $data['country'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['stock_symbol'] = isset($data['stock_symbol']) ? $data['stock_symbol'] : null;
        $this->container['stock_exchange'] = isset($data['stock_exchange']) ? $data['stock_exchange'] : null;
        $this->container['ip_address'] = isset($data['ip_address']) ? $data['ip_address'] : null;
        $this->container['website'] = isset($data['website']) ? $data['website'] : null;
        $this->container['brand_relationship'] = isset($data['brand_relationship']) ? $data['brand_relationship'] : null;
        $this->container['vertical'] = isset($data['vertical']) ? $data['vertical'] : null;
        $this->container['alt_business_id'] = isset($data['alt_business_id']) ? $data['alt_business_id'] : null;
        $this->container['alt_business_id_type'] = isset($data['alt_business_id_type']) ? $data['alt_business_id_type'] : null;
        $this->container['universal_ein'] = isset($data['universal_ein']) ? $data['universal_ein'] : null;
        $this->container['reference_id'] = isset($data['reference_id']) ? $data['reference_id'] : null;
        $this->container['optional_attributes'] = isset($data['optional_attributes']) ? $data['optional_attributes'] : null;
        $this->container['mock'] = isset($data['mock']) ? $data['mock'] : null;
        $this->container['identity_status'] = isset($data['identity_status']) ? $data['identity_status'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['entity_type'] === null) {
            $invalidProperties[] = "'entity_type' can't be null";
        }
        $allowedValues = $this->getEntityTypeAllowableValues();
        if (!is_null($this->container['entity_type']) && !in_array($this->container['entity_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'entity_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['display_name'] === null) {
            $invalidProperties[] = "'display_name' can't be null";
        }
        if ($this->container['phone'] === null) {
            $invalidProperties[] = "'phone' can't be null";
        }
        if ($this->container['country'] === null) {
            $invalidProperties[] = "'country' can't be null";
        }
        if ($this->container['email'] === null) {
            $invalidProperties[] = "'email' can't be null";
        }
        $allowedValues = $this->getStockExchangeAllowableValues();
        if (!is_null($this->container['stock_exchange']) && !in_array($this->container['stock_exchange'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'stock_exchange', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['brand_relationship'] === null) {
            $invalidProperties[] = "'brand_relationship' can't be null";
        }
        $allowedValues = $this->getBrandRelationshipAllowableValues();
        if (!is_null($this->container['brand_relationship']) && !in_array($this->container['brand_relationship'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'brand_relationship', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['vertical'] === null) {
            $invalidProperties[] = "'vertical' can't be null";
        }
        $allowedValues = $this->getAltBusinessIdTypeAllowableValues();
        if (!is_null($this->container['alt_business_id_type']) && !in_array($this->container['alt_business_id_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'alt_business_id_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['mock'] === null) {
            $invalidProperties[] = "'mock' can't be null";
        }
        if ($this->container['identity_status'] === null) {
            $invalidProperties[] = "'identity_status' can't be null";
        }
        $allowedValues = $this->getIdentityStatusAllowableValues();
        if (!is_null($this->container['identity_status']) && !in_array($this->container['identity_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'identity_status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets entity_type
     *
     * @return string
     */
    public function getEntityType()
    {
        return $this->container['entity_type'];
    }

    /**
     * Sets entity_type
     *
     * @param string $entity_type Entity type behind the brand. This is the form of business establishment.
     *
     * @return $this
     */
    public function setEntityType($entity_type)
    {
        $allowedValues = $this->getEntityTypeAllowableValues();
        if (!in_array($entity_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'entity_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['entity_type'] = $entity_type;

        return $this;
    }

    /**
     * Gets csp_id
     *
     * @return string
     */
    public function getCspId()
    {
        return $this->container['csp_id'];
    }

    /**
     * Sets csp_id
     *
     * @param string $csp_id Unique identifier assigned to the csp by the registry.
     *
     * @return $this
     */
    public function setCspId($csp_id)
    {
        $this->container['csp_id'] = $csp_id;

        return $this;
    }

    /**
     * Gets brand_id
     *
     * @return string
     */
    public function getBrandId()
    {
        return $this->container['brand_id'];
    }

    /**
     * Sets brand_id
     *
     * @param string $brand_id Unique identifier assigned to the brand by the registry.
     *
     * @return $this
     */
    public function setBrandId($brand_id)
    {
        $this->container['brand_id'] = $brand_id;

        return $this;
    }

    /**
     * Gets first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param string $first_name First or given name.
     *
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     *
     * @param string $last_name Last or Surname.
     *
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->container['last_name'] = $last_name;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string $display_name Display or marketing name of the brand.
     *
     * @return $this
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets company_name
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name
     *
     * @param string $company_name (Required for Non-profit/private/public) Legal company name.
     *
     * @return $this
     */
    public function setCompanyName($company_name)
    {
        $this->container['company_name'] = $company_name;

        return $this;
    }

    /**
     * Gets ein
     *
     * @return string
     */
    public function getEin()
    {
        return $this->container['ein'];
    }

    /**
     * Sets ein
     *
     * @param string $ein (Required for Non-profit) Government assigned corporate tax ID. EIN is 9-digits in U.S.
     *
     * @return $this
     */
    public function setEin($ein)
    {
        $this->container['ein'] = $ein;

        return $this;
    }

    /**
     * Gets ein_issuing_country
     *
     * @return string
     */
    public function getEinIssuingCountry()
    {
        return $this->container['ein_issuing_country'];
    }

    /**
     * Sets ein_issuing_country
     *
     * @param string $ein_issuing_country ISO2 2 characters country code. Example: US - United States
     *
     * @return $this
     */
    public function setEinIssuingCountry($ein_issuing_country)
    {
        $this->container['ein_issuing_country'] = $ein_issuing_country;

        return $this;
    }

    /**
     * Gets phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->container['phone'];
    }

    /**
     * Sets phone
     *
     * @param string $phone Valid phone number in e.164 international format.
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->container['street'];
    }

    /**
     * Sets street
     *
     * @param string $street Street number and name.
     *
     * @return $this
     */
    public function setStreet($street)
    {
        $this->container['street'] = $street;

        return $this;
    }

    /**
     * Gets city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->container['city'];
    }

    /**
     * Sets city
     *
     * @param string $city City name
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->container['city'] = $city;

        return $this;
    }

    /**
     * Gets state
     *
     * @return string
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param string $state State. Must be 2 letters code for United States.
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->container['state'] = $state;

        return $this;
    }

    /**
     * Gets postal_code
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->container['postal_code'];
    }

    /**
     * Sets postal_code
     *
     * @param string $postal_code Postal codes. Use 5 digit zipcode for United States
     *
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        $this->container['postal_code'] = $postal_code;

        return $this;
    }

    /**
     * Gets country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->container['country'];
    }

    /**
     * Sets country
     *
     * @param string $country ISO2 2 characters country code. Example: US - United States
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->container['country'] = $country;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string $email Valid email address of brand support contact.
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets stock_symbol
     *
     * @return string
     */
    public function getStockSymbol()
    {
        return $this->container['stock_symbol'];
    }

    /**
     * Sets stock_symbol
     *
     * @param string $stock_symbol (Required for public company) stock symbol.
     *
     * @return $this
     */
    public function setStockSymbol($stock_symbol)
    {
        $this->container['stock_symbol'] = $stock_symbol;

        return $this;
    }

    /**
     * Gets stock_exchange
     *
     * @return string
     */
    public function getStockExchange()
    {
        return $this->container['stock_exchange'];
    }

    /**
     * Sets stock_exchange
     *
     * @param string $stock_exchange (Required for public company) stock exchange.
     *
     * @return $this
     */
    public function setStockExchange($stock_exchange)
    {
        $allowedValues = $this->getStockExchangeAllowableValues();
        if (!is_null($stock_exchange) && !in_array($stock_exchange, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'stock_exchange', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['stock_exchange'] = $stock_exchange;

        return $this;
    }

    /**
     * Gets ip_address
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->container['ip_address'];
    }

    /**
     * Sets ip_address
     *
     * @param string $ip_address IP address of the browser requesting to create brand identity.
     *
     * @return $this
     */
    public function setIpAddress($ip_address)
    {
        $this->container['ip_address'] = $ip_address;

        return $this;
    }

    /**
     * Gets website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->container['website'];
    }

    /**
     * Sets website
     *
     * @param string $website Brand website URL.
     *
     * @return $this
     */
    public function setWebsite($website)
    {
        $this->container['website'] = $website;

        return $this;
    }

    /**
     * Gets brand_relationship
     *
     * @return string
     */
    public function getBrandRelationship()
    {
        return $this->container['brand_relationship'];
    }

    /**
     * Sets brand_relationship
     *
     * @param string $brand_relationship Brand relationship to the CSP
     *
     * @return $this
     */
    public function setBrandRelationship($brand_relationship)
    {
        $allowedValues = $this->getBrandRelationshipAllowableValues();
        if (!in_array($brand_relationship, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'brand_relationship', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['brand_relationship'] = $brand_relationship;

        return $this;
    }

    /**
     * Gets vertical
     *
     * @return string
     */
    public function getVertical()
    {
        return $this->container['vertical'];
    }

    /**
     * Sets vertical
     *
     * @param string $vertical Vertical or industry segment of the brand.
     *
     * @return $this
     */
    public function setVertical($vertical)
    {
        $this->container['vertical'] = $vertical;

        return $this;
    }

    /**
     * Gets alt_business_id
     *
     * @return string
     */
    public function getAltBusinessId()
    {
        return $this->container['alt_business_id'];
    }

    /**
     * Sets alt_business_id
     *
     * @param string $alt_business_id Alternate business identifier such as DUNS, LEI, or GIIN
     *
     * @return $this
     */
    public function setAltBusinessId($alt_business_id)
    {
        $this->container['alt_business_id'] = $alt_business_id;

        return $this;
    }

    /**
     * Gets alt_business_id_type
     *
     * @return string
     */
    public function getAltBusinessIdType()
    {
        return $this->container['alt_business_id_type'];
    }

    /**
     * Sets alt_business_id_type
     *
     * @param string $alt_business_id_type alt_business_id_type
     *
     * @return $this
     */
    public function setAltBusinessIdType($alt_business_id_type)
    {
        $allowedValues = $this->getAltBusinessIdTypeAllowableValues();
        if (!is_null($alt_business_id_type) && !in_array($alt_business_id_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'alt_business_id_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['alt_business_id_type'] = $alt_business_id_type;

        return $this;
    }

    /**
     * Gets universal_ein
     *
     * @return string
     */
    public function getUniversalEin()
    {
        return $this->container['universal_ein'];
    }

    /**
     * Sets universal_ein
     *
     * @param string $universal_ein Universal EIN of Brand, Read Only.
     *
     * @return $this
     */
    public function setUniversalEin($universal_ein)
    {
        $this->container['universal_ein'] = $universal_ein;

        return $this;
    }

    /**
     * Gets reference_id
     *
     * @return string
     */
    public function getReferenceId()
    {
        return $this->container['reference_id'];
    }

    /**
     * Sets reference_id
     *
     * @param string $reference_id Caller supplied brand reference ID. If supplied, the value must be unique across all submitted brands. Can be used to prevent duplicate brand registrations.
     *
     * @return $this
     */
    public function setReferenceId($reference_id)
    {
        $this->container['reference_id'] = $reference_id;

        return $this;
    }

    /**
     * Gets optional_attributes
     *
     * @return map[string,object]
     */
    public function getOptionalAttributes()
    {
        return $this->container['optional_attributes'];
    }

    /**
     * Sets optional_attributes
     *
     * @param map[string,object] $optional_attributes Optional brand attributes. Please refer to GET /enum/optionalAttributeNames for dictionary of optional attribute names.
     *
     * @return $this
     */
    public function setOptionalAttributes($optional_attributes)
    {
        $this->container['optional_attributes'] = $optional_attributes;

        return $this;
    }

    /**
     * Gets mock
     *
     * @return bool
     */
    public function getMock()
    {
        return $this->container['mock'];
    }

    /**
     * Sets mock
     *
     * @param bool $mock Test brand.
     *
     * @return $this
     */
    public function setMock($mock)
    {
        $this->container['mock'] = $mock;

        return $this;
    }

    /**
     * Gets identity_status
     *
     * @return string
     */
    public function getIdentityStatus()
    {
        return $this->container['identity_status'];
    }

    /**
     * Sets identity_status
     *
     * @param string $identity_status TCR assessment of the brand identification status.
     *
     * @return $this
     */
    public function setIdentityStatus($identity_status)
    {
        $allowedValues = $this->getIdentityStatusAllowableValues();
        if (!in_array($identity_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'identity_status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['identity_status'] = $identity_status;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
