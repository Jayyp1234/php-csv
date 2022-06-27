# PHPCSV LOADER

This loads a csv file into the database

Endpoints

/api/loadcountycsv - This loads the country csv file into the database 

/api/loadcurrencycsv - This loads the currency csv file into the database

## Country

/api/countries -  This endpoint fetches the first 10 records from the database
 
# pagination
/api/countries?page=1 - fetches the first 10 records

/api/countries?page=2 - fetches from 10 - 20 

/api/countries?page=3 - fetches from 20 - 30 


# search
continent_code,currency_code,iso2_code,iso3_code,iso_numeric_code,fips_code,calling_code,common_name,official_name,endonym,demonym

one or more  of the above can be added as query parameter for search
E.g 
/api/countries?continent_code=NA&currency_code=IS


## The same is applicable to the Currency route

## Currency

/api/currencies -  This endpoint fetches the first 10 records from the database
 
# pagination
/api/currencies?page=1 - fetches the first 10 records

/api/currencies?page=2 - fetches from 10 - 20 

/api/currencies?page=3 - fetches from 20 - 30 


# search
iso_code,iso_numeric_code,common_name,official_name,symbol

one or more  of the above can be added as query parameter for search
E.g 
/api/currencies?continent_code=NA&currency_code=IS
