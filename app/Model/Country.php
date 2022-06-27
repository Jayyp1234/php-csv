<?php

namespace App\Model;

use App\Model\Database;

class Country extends Database {

     protected  $table = 'country';

     function __construct(){

        parent::connect();

        return $this;
        

    }


    public function loadCSVDataIntoDb($CountrycsvFile){
        $countryData = [];
        if (($open = fopen($CountrycsvFile, "r")) !== FALSE) {
          while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
            $countryData[] = $data; 
          }
          fclose($open);
        }
         //header data.
        $header = array_shift($countryData);
        
        for ($i=0; $i < count($countryData) ; $i++) { 
            $continent_code =$countryData[$i][0];
            $currency_code = $countryData[$i][1];
            $iso2_code = $countryData[$i][2];
            $iso3_code = $countryData[$i][3];
            $iso_numeric_code = $countryData[$i][4];
            $fips_code = $countryData[$i][5];
            $calling_code = $countryData[$i][6];
            $common_name = $countryData[$i][7];
            $official_name = $countryData[$i][8];
            $endonym = $countryData[$i][9];
            $demonym = $countryData[$i][10];

            $sql = "INSERT INTO ".$this->table."(continent_code,currency_code,iso2_code,iso3_code,iso_numeric_code,fips_code,calling_code,common_name,official_name,endonym,demonym)
             VALUES ('$continent_code','$currency_code','$iso2_code','$iso3_code','$iso_numeric_code','$fips_code','$calling_code','$common_name','$official_name','$endonym','$demonym')
            ";
            $query = $this->query($sql);
        }

        return true;
    }



}