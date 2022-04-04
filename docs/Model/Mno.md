# Mno

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**network_id** | **int** | Unique network identifier assigned to MNO. | 
**display_name** | **string** | Display name of the mobile network operator. | 
**osr_bitmask_index** | **int** | NetNumber OSR &#x27;campaign_id&#x27; property&#x27;s &#x27;status&#x27; attribute holds individual MNO campaign operation status. The &#x27;status&#x27; attribute leverages bitmasking technique to store multiple MNOs&#x27; operating status. The campaign operation status is reduced to &#x27;1&#x27; or &#x27;0&#x27; value where &#x27;1&#x27; indicate an &#x27;ACTIVE&#x27; status and &#x27;0&#x27; represents every other non-active statuses, including REVIEW, REJECT and SUSPEND. The &#x27;osrBitmaskIndex&#x27; holds the bitmask index of the MNO. For example, T-Mobile&#x27;s bitmask index is 2, which implies T-Mobile&#x27;s campaign operation status is stored in bit #2, or 3rd bit when counting from right. | 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

