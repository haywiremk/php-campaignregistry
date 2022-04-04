# BrandCSP

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**entity_type** | **string** | Entity type behind the brand. This is the form of business establishment. | 
**csp_id** | **string** | Unique identifier assigned to the csp by the registry. | [optional] 
**brand_id** | **string** | Unique identifier assigned to the brand by the registry. | [optional] 
**first_name** | **string** | First or given name. | [optional] 
**last_name** | **string** | Last or Surname. | [optional] 
**display_name** | **string** | Display or marketing name of the brand. | 
**company_name** | **string** | (Required for Non-profit/private/public) Legal company name. | [optional] 
**ein** | **string** | (Required for Non-profit) Government assigned corporate tax ID. EIN is 9-digits in U.S. | [optional] 
**ein_issuing_country** | **string** | ISO2 2 characters country code. Example: US - United States | [optional] 
**phone** | **string** | Valid phone number in e.164 international format. | 
**street** | **string** | Street number and name. | [optional] 
**city** | **string** | City name | [optional] 
**state** | **string** | State. Must be 2 letters code for United States. | [optional] 
**postal_code** | **string** | Postal codes. Use 5 digit zipcode for United States | [optional] 
**country** | **string** | ISO2 2 characters country code. Example: US - United States | 
**email** | **string** | Valid email address of brand support contact. | 
**stock_symbol** | **string** | (Required for public company) stock symbol. | [optional] 
**stock_exchange** | **string** | (Required for public company) stock exchange. | [optional] 
**ip_address** | **string** | IP address of the browser requesting to create brand identity. | [optional] 
**website** | **string** | Brand website URL. | [optional] 
**brand_relationship** | **string** | Brand relationship to the CSP | 
**vertical** | **string** | Vertical or industry segment of the brand. | 
**alt_business_id** | **string** | Alternate business identifier such as DUNS, LEI, or GIIN | [optional] 
**alt_business_id_type** | **string** |  | [optional] 
**universal_ein** | **string** | Universal EIN of Brand, Read Only. | [optional] 
**reference_id** | **string** | Caller supplied brand reference ID. If supplied, the value must be unique across all submitted brands. Can be used to prevent duplicate brand registrations. | [optional] 
**optional_attributes** | **map[string,object]** | Optional brand attributes. Please refer to GET /enum/optionalAttributeNames for dictionary of optional attribute names. | [optional] 
**mock** | **bool** | Test brand. | 
**identity_status** | **string** | TCR assessment of the brand identification status. | 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

