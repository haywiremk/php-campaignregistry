<?php
/**
 * Configuration
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

namespace TCR\Client;

/**
 * Configuration Class Doc Comment
 * PHP version 5
 *
 * @category Class
 * @package  TCR\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Configuration
{
    private static $defaultConfiguration;

    /**
     * Associate array to store API key(s)
     *
     * @var string[]
     */
    protected $apiKeys = [];

    /**
     * Associate array to store API prefix (e.g. Bearer)
     *
     * @var string[]
     */
    protected $apiKeyPrefixes = [];

    /**
     * Access token for OAuth
     *
     * @var string
     */
    protected $accessToken = '';

    /**
     * Username for HTTP basic authentication
     *
     * @var string
     */
    protected $username = '';

    /**
     * Password for HTTP basic authentication
     *
     * @var string
     */
    protected $password = '';

    /**
     * The host
     *
     * @var string
     */
    protected $host = '/v1';

    /**
     * User agent of the HTTP request, set to "PHP-Swagger" by default
     *
     * @var string
     */
    protected $userAgent = 'Swagger-Codegen/1.0.0/php';

    /**
     * Debug switch (default set to false)
     *
     * @var bool
     */
    protected $debug = false;

    /**
     * Debug file location (log to STDOUT by default)
     *
     * @var string
     */
    protected $debugFile = 'php://output';

    /**
     * Debug file location (log to STDOUT by default)
     *
     * @var string
     */
    protected $tempFolderPath;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tempFolderPath = sys_get_temp_dir();
    }

    /**
     * Sets API key
     *
     * @param string $apiKeyIdentifier API key identifier (authentication scheme)
     * @param string $key              API key or token
     *
     * @return $this
     */
    public function setApiKey($apiKeyIdentifier, $key)
    {
        $this->apiKeys[$apiKeyIdentifier] = $key;
        return $this;
    }

    /**
     * Gets API key
     *
     * @param string $apiKeyIdentifier API key identifier (authentication scheme)
     *
     * @return string API key or token
     */
    public function getApiKey($apiKeyIdentifier)
    {
        return isset($this->apiKeys[$apiKeyIdentifier]) ? $this->apiKeys[$apiKeyIdentifier] : null;
    }

    /**
     * Sets the prefix for API key (e.g. Bearer)
     *
     * @param string $apiKeyIdentifier API key identifier (authentication scheme)
     * @param string $prefix           API key prefix, e.g. Bearer
     *
     * @return $this
     */
    public function setApiKeyPrefix($apiKeyIdentifier, $prefix)
    {
        $this->apiKeyPrefixes[$apiKeyIdentifier] = $prefix;
        return $this;
    }

    /**
     * Gets API key prefix
     *
     * @param string $apiKeyIdentifier API key identifier (authentication scheme)
     *
     * @return string
     */
    public function getApiKeyPrefix($apiKeyIdentifier)
    {
        return isset($this->apiKeyPrefixes[$apiKeyIdentifier]) ? $this->apiKeyPrefixes[$apiKeyIdentifier] : null;
    }

    /**
     * Sets the access token for OAuth
     *
     * @param string $accessToken Token for OAuth
     *
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Gets the access token for OAuth
     *
     * @return string Access token for OAuth
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Sets the username for HTTP basic authentication
     *
     * @param string $username Username for HTTP basic authentication
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Gets the username for HTTP basic authentication
     *
     * @return string Username for HTTP basic authentication
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the password for HTTP basic authentication
     *
     * @param string $password Password for HTTP basic authentication
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Gets the password for HTTP basic authentication
     *
     * @return string Password for HTTP basic authentication
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the host
     *
     * @param string $host Host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Gets the host
     *
     * @return string Host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Sets the user agent of the api client
     *
     * @param string $userAgent the user agent of the api client
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setUserAgent($userAgent)
    {
        if (!is_string($userAgent)) {
            throw new \InvalidArgumentException('User-agent must be a string.');
        }

        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Gets the user agent of the api client
     *
     * @return string user agent
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Sets debug flag
     *
     * @param bool $debug Debug flag
     *
     * @return $this
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * Gets the debug flag
     *
     * @return bool
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * Sets the debug file
     *
     * @param string $debugFile Debug file
     *
     * @return $this
     */
    public function setDebugFile($debugFile)
    {
        $this->debugFile = $debugFile;
        return $this;
    }

    /**
     * Gets the debug file
     *
     * @return string
     */
    public function getDebugFile()
    {
        return $this->debugFile;
    }

    /**
     * Sets the temp folder path
     *
     * @param string $tempFolderPath Temp folder path
     *
     * @return $this
     */
    public function setTempFolderPath($tempFolderPath)
    {
        $this->tempFolderPath = $tempFolderPath;
        return $this;
    }

    /**
     * Gets the temp folder path
     *
     * @return string Temp folder path
     */
    public function getTempFolderPath()
    {
        return $this->tempFolderPath;
    }

    /**
     * Gets the default configuration instance
     *
     * @return Configuration
     */
    public static function getDefaultConfiguration()
    {
        if (self::$defaultConfiguration === null) {
            self::$defaultConfiguration = new Configuration();
        }

        return self::$defaultConfiguration;
    }

    /**
     * Sets the detault configuration instance
     *
     * @param Configuration $config An instance of the Configuration Object
     *
     * @return void
     */
    public static function setDefaultConfiguration(Configuration $config)
    {
        self::$defaultConfiguration = $config;
    }

    /**
     * Gets the essential information for debugging
     *
     * @return string The report for debugging
     */
    public static function toDebugReport()
    {
        $report  = 'PHP SDK (TCR\Client) Debug Report:' . PHP_EOL;
        $report .= '    OS: ' . php_uname() . PHP_EOL;
        $report .= '    PHP Version: ' . PHP_VERSION . PHP_EOL;
        $report .= '    OpenAPI Spec Version: 1.0' . PHP_EOL;
        $report .= '    Temp Folder Path: ' . self::getDefaultConfiguration()->getTempFolderPath() . PHP_EOL;

        return $report;
    }

    /**
     * Get API key (with prefix if set)
     *
     * @param  string $apiKeyIdentifier name of apikey
     *
     * @return string API key with the prefix
     */
    public function getApiKeyWithPrefix($apiKeyIdentifier)
    {
        $prefix = $this->getApiKeyPrefix($apiKeyIdentifier);
        $apiKey = $this->getApiKey($apiKeyIdentifier);

        if ($apiKey === null) {
            return null;
        }

        if ($prefix === null) {
            $keyWithPrefix = $apiKey;
        } else {
            $keyWithPrefix = $prefix . ' ' . $apiKey;
        }

        return $keyWithPrefix;
    }
}
