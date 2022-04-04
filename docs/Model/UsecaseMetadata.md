# UsecaseMetadata

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**usecase** | **string** | Campaign usecase | [optional] 
**monthly_fee** | **float** | Campaign monthly subscription fee | [optional] 
**quarterly_fee** | **float** | Campaign quarterly subscription fee | [optional] 
**annual_fee** | **float** | Campaign annual subscription fee | [optional] 
**min_sub_usecases** | **int** | Minimum number of sub-usecases declaration required. | [optional] 
**max_sub_usecases** | **int** | Maximum number of sub-usecases declaration required. | [optional] 
**mno_metadata** | [**map[string,\TCR\Client\Model\Metadata]**](Metadata.md) | Map of usecase metadata for each MNO. Key is the network ID of the MNO (e.g. 10017), Value is the mno metadata for the usecase. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

