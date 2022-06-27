<?php

namespace App\Model;

use App\Model\Database;

class Currency extends Database {

     protected  $table = 'currency';

     function __construct(){

        parent::connect();

        return $this;
        

    }


    public  function loadCurrencyIntoDb($CurrencycsvFile){
        $currencyData = [];
        if (($open = fopen($CurrencycsvFile, "r")) !== FALSE) 
        {
          while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
          {        
            $currencyData[] = $data; 
          }
          fclose($open);
        }
         //header data.
        $header = array_shift($currencyData);
        
        for ($i=0; $i < count($currencyData) ; $i++) { 
            $iso_code = $currencyData[$i][0];
            $iso_numeric_code = $currencyData[$i][1];
            $common_name = $currencyData[$i][2];
            $official_name = $currencyData[$i][3];
            $symbol = $currencyData[$i][4];
            $sql = "INSERT INTO ".$this->table."(iso_code,iso_numeric_code,common_name,official_name,symbol)
             VALUES ('$iso_code','$iso_numeric_code','$common_name','$official_name','$symbol')
            ";
            $query = $this->query($sql);
    
        }

        return true;
        
        

    }

    
    

}