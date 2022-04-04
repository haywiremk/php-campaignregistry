<?php
/**
 * Campaign
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
 * Campaign Class Doc Comment
 *
 * @category Class
 * @description Campaign is generated by the 10DLC registry once the corresponding campaign request is approved. Each campaign is assigned a unique identifier - **campaignId**. Once a campaign is activated, limited information is published to the NetNumber OSR service for consumption by members of the ecosystem. When a campaign is suspended(reversible) or expired(non-reversible), campaign data is deleted from the OSR service. Most attributes of campaignare immutable, including **usecase**, **vertical**, **brandId** and **cspId**.
 * @package  TCR\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Campaign implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Campaign';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'campaign_id' => 'string',
'csp_id' => 'string',
'reseller_id' => 'string',
'status' => 'string',
'create_date' => '\DateTime',
'auto_renewal' => 'bool',
'billed_date' => '\DateTime',
'brand_id' => 'string',
'vertical' => 'string',
'usecase' => 'string',
'sub_usecases' => 'string[]',
'description' => 'string',
'embedded_link' => 'bool',
'embedded_phone' => 'bool',
'affiliate_marketing' => 'bool',
'number_pool' => 'bool',
'age_gated' => 'bool',
'direct_lending' => 'bool',
'subscriber_optin' => 'bool',
'subscriber_optout' => 'bool',
'subscriber_help' => 'bool',
'sample1' => 'string',
'sample2' => 'string',
'sample3' => 'string',
'sample4' => 'string',
'sample5' => 'string',
'message_flow' => 'string',
'help_message' => 'string',
'reference_id' => 'string',
'mock' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'campaign_id' => null,
'csp_id' => null,
'reseller_id' => null,
'status' => null,
'create_date' => 'date-time',
'auto_renewal' => null,
'billed_date' => 'date-time',
'brand_id' => null,
'vertical' => null,
'usecase' => null,
'sub_usecases' => null,
'description' => null,
'embedded_link' => null,
'embedded_phone' => null,
'affiliate_marketing' => null,
'number_pool' => null,
'age_gated' => null,
'direct_lending' => null,
'subscriber_optin' => null,
'subscriber_optout' => null,
'subscriber_help' => null,
'sample1' => null,
'sample2' => null,
'sample3' => null,
'sample4' => null,
'sample5' => null,
'message_flow' => null,
'help_message' => null,
'reference_id' => null,
'mock' => null    ];

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
        'campaign_id' => 'campaignId',
'csp_id' => 'cspId',
'reseller_id' => 'resellerId',
'status' => 'status',
'create_date' => 'createDate',
'auto_renewal' => 'autoRenewal',
'billed_date' => 'billedDate',
'brand_id' => 'brandId',
'vertical' => 'vertical',
'usecase' => 'usecase',
'sub_usecases' => 'subUsecases',
'description' => 'description',
'embedded_link' => 'embeddedLink',
'embedded_phone' => 'embeddedPhone',
'affiliate_marketing' => 'affiliateMarketing',
'number_pool' => 'numberPool',
'age_gated' => 'ageGated',
'direct_lending' => 'directLending',
'subscriber_optin' => 'subscriberOptin',
'subscriber_optout' => 'subscriberOptout',
'subscriber_help' => 'subscriberHelp',
'sample1' => 'sample1',
'sample2' => 'sample2',
'sample3' => 'sample3',
'sample4' => 'sample4',
'sample5' => 'sample5',
'message_flow' => 'messageFlow',
'help_message' => 'helpMessage',
'reference_id' => 'referenceId',
'mock' => 'mock'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'campaign_id' => 'setCampaignId',
'csp_id' => 'setCspId',
'reseller_id' => 'setResellerId',
'status' => 'setStatus',
'create_date' => 'setCreateDate',
'auto_renewal' => 'setAutoRenewal',
'billed_date' => 'setBilledDate',
'brand_id' => 'setBrandId',
'vertical' => 'setVertical',
'usecase' => 'setUsecase',
'sub_usecases' => 'setSubUsecases',
'description' => 'setDescription',
'embedded_link' => 'setEmbeddedLink',
'embedded_phone' => 'setEmbeddedPhone',
'affiliate_marketing' => 'setAffiliateMarketing',
'number_pool' => 'setNumberPool',
'age_gated' => 'setAgeGated',
'direct_lending' => 'setDirectLending',
'subscriber_optin' => 'setSubscriberOptin',
'subscriber_optout' => 'setSubscriberOptout',
'subscriber_help' => 'setSubscriberHelp',
'sample1' => 'setSample1',
'sample2' => 'setSample2',
'sample3' => 'setSample3',
'sample4' => 'setSample4',
'sample5' => 'setSample5',
'message_flow' => 'setMessageFlow',
'help_message' => 'setHelpMessage',
'reference_id' => 'setReferenceId',
'mock' => 'setMock'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'campaign_id' => 'getCampaignId',
'csp_id' => 'getCspId',
'reseller_id' => 'getResellerId',
'status' => 'getStatus',
'create_date' => 'getCreateDate',
'auto_renewal' => 'getAutoRenewal',
'billed_date' => 'getBilledDate',
'brand_id' => 'getBrandId',
'vertical' => 'getVertical',
'usecase' => 'getUsecase',
'sub_usecases' => 'getSubUsecases',
'description' => 'getDescription',
'embedded_link' => 'getEmbeddedLink',
'embedded_phone' => 'getEmbeddedPhone',
'affiliate_marketing' => 'getAffiliateMarketing',
'number_pool' => 'getNumberPool',
'age_gated' => 'getAgeGated',
'direct_lending' => 'getDirectLending',
'subscriber_optin' => 'getSubscriberOptin',
'subscriber_optout' => 'getSubscriberOptout',
'subscriber_help' => 'getSubscriberHelp',
'sample1' => 'getSample1',
'sample2' => 'getSample2',
'sample3' => 'getSample3',
'sample4' => 'getSample4',
'sample5' => 'getSample5',
'message_flow' => 'getMessageFlow',
'help_message' => 'getHelpMessage',
'reference_id' => 'getReferenceId',
'mock' => 'getMock'    ];

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

    const STATUS_ACTIVE = 'ACTIVE';
const STATUS_EXPIRED = 'EXPIRED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_ACTIVE,
self::STATUS_EXPIRED,        ];
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
        $this->container['campaign_id'] = isset($data['campaign_id']) ? $data['campaign_id'] : null;
        $this->container['csp_id'] = isset($data['csp_id']) ? $data['csp_id'] : null;
        $this->container['reseller_id'] = isset($data['reseller_id']) ? $data['reseller_id'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['create_date'] = isset($data['create_date']) ? $data['create_date'] : null;
        $this->container['auto_renewal'] = isset($data['auto_renewal']) ? $data['auto_renewal'] : null;
        $this->container['billed_date'] = isset($data['billed_date']) ? $data['billed_date'] : null;
        $this->container['brand_id'] = isset($data['brand_id']) ? $data['brand_id'] : null;
        $this->container['vertical'] = isset($data['vertical']) ? $data['vertical'] : null;
        $this->container['usecase'] = isset($data['usecase']) ? $data['usecase'] : null;
        $this->container['sub_usecases'] = isset($data['sub_usecases']) ? $data['sub_usecases'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['embedded_link'] = isset($data['embedded_link']) ? $data['embedded_link'] : false;
        $this->container['embedded_phone'] = isset($data['embedded_phone']) ? $data['embedded_phone'] : false;
        $this->container['affiliate_marketing'] = isset($data['affiliate_marketing']) ? $data['affiliate_marketing'] : null;
        $this->container['number_pool'] = isset($data['number_pool']) ? $data['number_pool'] : false;
        $this->container['age_gated'] = isset($data['age_gated']) ? $data['age_gated'] : null;
        $this->container['direct_lending'] = isset($data['direct_lending']) ? $data['direct_lending'] : null;
        $this->container['subscriber_optin'] = isset($data['subscriber_optin']) ? $data['subscriber_optin'] : false;
        $this->container['subscriber_optout'] = isset($data['subscriber_optout']) ? $data['subscriber_optout'] : false;
        $this->container['subscriber_help'] = isset($data['subscriber_help']) ? $data['subscriber_help'] : false;
        $this->container['sample1'] = isset($data['sample1']) ? $data['sample1'] : null;
        $this->container['sample2'] = isset($data['sample2']) ? $data['sample2'] : null;
        $this->container['sample3'] = isset($data['sample3']) ? $data['sample3'] : null;
        $this->container['sample4'] = isset($data['sample4']) ? $data['sample4'] : null;
        $this->container['sample5'] = isset($data['sample5']) ? $data['sample5'] : null;
        $this->container['message_flow'] = isset($data['message_flow']) ? $data['message_flow'] : null;
        $this->container['help_message'] = isset($data['help_message']) ? $data['help_message'] : null;
        $this->container['reference_id'] = isset($data['reference_id']) ? $data['reference_id'] : null;
        $this->container['mock'] = isset($data['mock']) ? $data['mock'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['campaign_id'] === null) {
            $invalidProperties[] = "'campaign_id' can't be null";
        }
        if ($this->container['csp_id'] === null) {
            $invalidProperties[] = "'csp_id' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['brand_id'] === null) {
            $invalidProperties[] = "'brand_id' can't be null";
        }
        if ($this->container['vertical'] === null) {
            $invalidProperties[] = "'vertical' can't be null";
        }
        if ($this->container['usecase'] === null) {
            $invalidProperties[] = "'usecase' can't be null";
        }
        if ($this->container['sub_usecases'] === null) {
            $invalidProperties[] = "'sub_usecases' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['mock'] === null) {
            $invalidProperties[] = "'mock' can't be null";
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
     * Gets campaign_id
     *
     * @return string
     */
    public function getCampaignId()
    {
        return $this->container['campaign_id'];
    }

    /**
     * Sets campaign_id
     *
     * @param string $campaign_id Alphanumeric identifier assigned by the registry for a campaign. This identifier is required by the NetNumber OSR SMS enabling process of 10DLC.
     *
     * @return $this
     */
    public function setCampaignId($campaign_id)
    {
        $this->container['campaign_id'] = $campaign_id;

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
     * @param string $csp_id Alphanumeric identifier of the CSP associated with this campaign.
     *
     * @return $this
     */
    public function setCspId($csp_id)
    {
        $this->container['csp_id'] = $csp_id;

        return $this;
    }

    /**
     * Gets reseller_id
     *
     * @return string
     */
    public function getResellerId()
    {
        return $this->container['reseller_id'];
    }

    /**
     * Sets reseller_id
     *
     * @param string $reseller_id Alphanumeric identifier of the reseller that you want to associate with this campaign.
     *
     * @return $this
     */
    public function setResellerId($reseller_id)
    {
        $this->container['reseller_id'] = $reseller_id;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status Current campaign status. Possible values: ACTIVE, EXPIRED. A newly created campaign defaults to ACTIVE status.
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets create_date
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->container['create_date'];
    }

    /**
     * Sets create_date
     *
     * @param \DateTime $create_date Unix timestamp when campaign was created.
     *
     * @return $this
     */
    public function setCreateDate($create_date)
    {
        $this->container['create_date'] = $create_date;

        return $this;
    }

    /**
     * Gets auto_renewal
     *
     * @return bool
     */
    public function getAutoRenewal()
    {
        return $this->container['auto_renewal'];
    }

    /**
     * Sets auto_renewal
     *
     * @param bool $auto_renewal Campaign subscription auto-renewal status.
     *
     * @return $this
     */
    public function setAutoRenewal($auto_renewal)
    {
        $this->container['auto_renewal'] = $auto_renewal;

        return $this;
    }

    /**
     * Gets billed_date
     *
     * @return \DateTime
     */
    public function getBilledDate()
    {
        return $this->container['billed_date'];
    }

    /**
     * Sets billed_date
     *
     * @param \DateTime $billed_date Campaign recent billed date.
     *
     * @return $this
     */
    public function setBilledDate($billed_date)
    {
        $this->container['billed_date'] = $billed_date;

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
     * @param string $brand_id Alphanumeric identifier of the brand associated with this campaign.
     *
     * @return $this
     */
    public function setBrandId($brand_id)
    {
        $this->container['brand_id'] = $brand_id;

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
     * @param string $vertical Business/industry segment of this campaign. Must be of defined valid types. Use `/registry/enum/vertical` operation to retrieve verticals available for given brand, vertical combination.
     *
     * @return $this
     */
    public function setVertical($vertical)
    {
        $this->container['vertical'] = $vertical;

        return $this;
    }

    /**
     * Gets usecase
     *
     * @return string
     */
    public function getUsecase()
    {
        return $this->container['usecase'];
    }

    /**
     * Sets usecase
     *
     * @param string $usecase Campaign usecase. Must be of defined valid types. Use `/registry/enum/usecase` operation to retrieve usecases available for given brand.
     *
     * @return $this
     */
    public function setUsecase($usecase)
    {
        $this->container['usecase'] = $usecase;

        return $this;
    }

    /**
     * Gets sub_usecases
     *
     * @return string[]
     */
    public function getSubUsecases()
    {
        return $this->container['sub_usecases'];
    }

    /**
     * Sets sub_usecases
     *
     * @param string[] $sub_usecases Campaign sub-usecases. Must be of defined valid sub-usecase types. Use `/registry/enum/usecase` operation to retrieve list of valid sub-usecases
     *
     * @return $this
     */
    public function setSubUsecases($sub_usecases)
    {
        $this->container['sub_usecases'] = $sub_usecases;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description Summary description of this campaign.
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets embedded_link
     *
     * @return bool
     */
    public function getEmbeddedLink()
    {
        return $this->container['embedded_link'];
    }

    /**
     * Sets embedded_link
     *
     * @param bool $embedded_link Does message generated by the campaign include URL link in SMS?
     *
     * @return $this
     */
    public function setEmbeddedLink($embedded_link)
    {
        $this->container['embedded_link'] = $embedded_link;

        return $this;
    }

    /**
     * Gets embedded_phone
     *
     * @return bool
     */
    public function getEmbeddedPhone()
    {
        return $this->container['embedded_phone'];
    }

    /**
     * Sets embedded_phone
     *
     * @param bool $embedded_phone Does message generated by the campaign include phone number in SMS?
     *
     * @return $this
     */
    public function setEmbeddedPhone($embedded_phone)
    {
        $this->container['embedded_phone'] = $embedded_phone;

        return $this;
    }

    /**
     * Gets affiliate_marketing
     *
     * @return bool
     */
    public function getAffiliateMarketing()
    {
        return $this->container['affiliate_marketing'];
    }

    /**
     * Sets affiliate_marketing
     *
     * @param bool $affiliate_marketing Does message content controlled by affiliate marketing other than the brand?
     *
     * @return $this
     */
    public function setAffiliateMarketing($affiliate_marketing)
    {
        $this->container['affiliate_marketing'] = $affiliate_marketing;

        return $this;
    }

    /**
     * Gets number_pool
     *
     * @return bool
     */
    public function getNumberPool()
    {
        return $this->container['number_pool'];
    }

    /**
     * Sets number_pool
     *
     * @param bool $number_pool Does campaign utilize pool of phone nubers?
     *
     * @return $this
     */
    public function setNumberPool($number_pool)
    {
        $this->container['number_pool'] = $number_pool;

        return $this;
    }

    /**
     * Gets age_gated
     *
     * @return bool
     */
    public function getAgeGated()
    {
        return $this->container['age_gated'];
    }

    /**
     * Sets age_gated
     *
     * @param bool $age_gated Age gated content in campaign.
     *
     * @return $this
     */
    public function setAgeGated($age_gated)
    {
        $this->container['age_gated'] = $age_gated;

        return $this;
    }

    /**
     * Gets direct_lending
     *
     * @return bool
     */
    public function getDirectLending()
    {
        return $this->container['direct_lending'];
    }

    /**
     * Sets direct_lending
     *
     * @param bool $direct_lending direct_lending
     *
     * @return $this
     */
    public function setDirectLending($direct_lending)
    {
        $this->container['direct_lending'] = $direct_lending;

        return $this;
    }

    /**
     * Gets subscriber_optin
     *
     * @return bool
     */
    public function getSubscriberOptin()
    {
        return $this->container['subscriber_optin'];
    }

    /**
     * Sets subscriber_optin
     *
     * @param bool $subscriber_optin Does campaign require subscriber to opt-in before SMS is sent to subscriber?
     *
     * @return $this
     */
    public function setSubscriberOptin($subscriber_optin)
    {
        $this->container['subscriber_optin'] = $subscriber_optin;

        return $this;
    }

    /**
     * Gets subscriber_optout
     *
     * @return bool
     */
    public function getSubscriberOptout()
    {
        return $this->container['subscriber_optout'];
    }

    /**
     * Sets subscriber_optout
     *
     * @param bool $subscriber_optout Does campaign support subscriber opt-out keyword(s)?
     *
     * @return $this
     */
    public function setSubscriberOptout($subscriber_optout)
    {
        $this->container['subscriber_optout'] = $subscriber_optout;

        return $this;
    }

    /**
     * Gets subscriber_help
     *
     * @return bool
     */
    public function getSubscriberHelp()
    {
        return $this->container['subscriber_help'];
    }

    /**
     * Sets subscriber_help
     *
     * @param bool $subscriber_help Does campaign responds to help keyword(s)?
     *
     * @return $this
     */
    public function setSubscriberHelp($subscriber_help)
    {
        $this->container['subscriber_help'] = $subscriber_help;

        return $this;
    }

    /**
     * Gets sample1
     *
     * @return string
     */
    public function getSample1()
    {
        return $this->container['sample1'];
    }

    /**
     * Sets sample1
     *
     * @param string $sample1 Message sample. Some campaign tiers require 1 or more message samples.
     *
     * @return $this
     */
    public function setSample1($sample1)
    {
        $this->container['sample1'] = $sample1;

        return $this;
    }

    /**
     * Gets sample2
     *
     * @return string
     */
    public function getSample2()
    {
        return $this->container['sample2'];
    }

    /**
     * Sets sample2
     *
     * @param string $sample2 Message sample. Some campaign tiers require 2 or more message samples.
     *
     * @return $this
     */
    public function setSample2($sample2)
    {
        $this->container['sample2'] = $sample2;

        return $this;
    }

    /**
     * Gets sample3
     *
     * @return string
     */
    public function getSample3()
    {
        return $this->container['sample3'];
    }

    /**
     * Sets sample3
     *
     * @param string $sample3 Message sample. Some campaign tiers require 3 or more message samples.
     *
     * @return $this
     */
    public function setSample3($sample3)
    {
        $this->container['sample3'] = $sample3;

        return $this;
    }

    /**
     * Gets sample4
     *
     * @return string
     */
    public function getSample4()
    {
        return $this->container['sample4'];
    }

    /**
     * Sets sample4
     *
     * @param string $sample4 Message sample. Some campaign tiers require 4 or more message samples.
     *
     * @return $this
     */
    public function setSample4($sample4)
    {
        $this->container['sample4'] = $sample4;

        return $this;
    }

    /**
     * Gets sample5
     *
     * @return string
     */
    public function getSample5()
    {
        return $this->container['sample5'];
    }

    /**
     * Sets sample5
     *
     * @param string $sample5 Message sample. Some campaign tiers require 5 or more message samples.
     *
     * @return $this
     */
    public function setSample5($sample5)
    {
        $this->container['sample5'] = $sample5;

        return $this;
    }

    /**
     * Gets message_flow
     *
     * @return string
     */
    public function getMessageFlow()
    {
        return $this->container['message_flow'];
    }

    /**
     * Sets message_flow
     *
     * @param string $message_flow Message flow description.
     *
     * @return $this
     */
    public function setMessageFlow($message_flow)
    {
        $this->container['message_flow'] = $message_flow;

        return $this;
    }

    /**
     * Gets help_message
     *
     * @return string
     */
    public function getHelpMessage()
    {
        return $this->container['help_message'];
    }

    /**
     * Sets help_message
     *
     * @param string $help_message Help message of the campaign.
     *
     * @return $this
     */
    public function setHelpMessage($help_message)
    {
        $this->container['help_message'] = $help_message;

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
     * @param string $reference_id Caller supplied campaign reference ID. If supplied, the value must be unique across all submitted campaigns. Can be used to prevent duplicate campaign registrations.
     *
     * @return $this
     */
    public function setReferenceId($reference_id)
    {
        $this->container['reference_id'] = $reference_id;

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
     * @param bool $mock Campaign created from mock brand. Mocked campaign cannot be shared with an upstream CNP.
     *
     * @return $this
     */
    public function setMock($mock)
    {
        $this->container['mock'] = $mock;

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
