# ExternalVetting

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**evp_id** | **string** | External vetting provider ID for the brand. | [optional] 
**vetting_id** | **string** | Unique ID that identifies a vetting transaction performed by a vetting provider. This ID is provided by the vetting provider at time of vetting. | [optional] 
**vetting_token** | **string** | Required by some providers for vetting record confirmation. | [optional] 
**vetting_score** | **int** | Vetting score ranging from 0-100. | [optional] 
**vetting_class** | **string** | Identifies the vetting classification. | [optional] 
**vetting_status** | **string** | Identifies the vetting request status. | [optional] 
**reasons** | **string[]** | The List of causes for FAILED ExternalVetting. | [optional] 
**vetting_details** | **map[string,object]** | Vetting provider specific details. | [optional] 
**vetted_date** | [**\DateTime**](\DateTime.md) | Vetting effective date. This is the date when vetting was completed, or the starting effective date in ISO 8601 format. If this date is missing, then the vetting was not complete or not valid. | [optional] 
**create_date** | [**\DateTime**](\DateTime.md) | Vetting submission date. This is the date when the vetting request is generated in ISO 8601 format. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

