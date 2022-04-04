# SharedCampaign

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**campaign_id** | **string** | Alphanumeric identifier assigned by the registry for a campaign. This identifier is required by the NetNumber OSR SMS enabling process of 10DLC. | 
**status** | **string** | Current campaign status. Possible values: ACTIVE, EXPIRED. A newly created campaign defaults to ACTIVE status. | [optional] 
**create_date** | [**\DateTime**](\DateTime.md) | Unix timestamp when campaign was created. | [optional] 
**brand_id** | **string** | Alphanumeric identifier of the brand associated with this campaign. | 
**usecase** | **string** | Campaign usecase. Must be of defined valid types. Use &#x60;/registry/enum/usecase&#x60; operation to retrieve usecases available for given brand. | 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

