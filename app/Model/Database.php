<?php

namespace App\Model;

include_once __DIR__.'/../Config/Config.php';



// parent class ..

class Database {

    protected  $dbname = DB_NAME;
    protected  $username = USERNAME;
    protected  $password = DB_PASSWORD;
    protected  $servername = SERVERNAME;
    protected  $connection;
    protected  $result;


    
  public function connect(){

    $conn = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

      $this->connection = $conn;

  }

  public  function query($sql){

    $query = mysqli_query($this->connection,$sql);
    
    if ($query) {
        # code..
        if (mysqli_num_rows($query) != 0) {
            # code...
            return  $this->setResult($query);
        }else{
                $res;
                    if ($this->table =='currency') {
                        $CurrencycsvFile = __DIR__ . '/../../assets/currencies.csv';
                       $res =  $this->loadCurrencyIntoDb($CurrencycsvFile);
                    }else{
                        $CountrycsvFile = __DIR__ . '/../../assets/countries.csv';
                        $res =  $this->loadCSVDataIntoDb($CountrycsvFile);
                    }

            return $res == true ?? $this->query($sql);
                
             
        }
    }
   
  
}

/*Setter function to set query result*/
private  function setResult($query){
    if ($query) {
        $this->result = $query;
        return $this;
    }else{
        $this->result = null;
        return false;
    }
}

public  function findAll(){

    $sql = "SELECT * FROM ".$this->table;
    $query = mysqli_query($this->connection,$sql);
    return $this->setResult($query);
}

/*getter function to get the query result.. */
public  function getResult(){
    $result=[];
   if ($this->result != null) {
       # code...
       while ($row = mysqli_fetch_assoc($this->result)) {
            array_push($result, $row);
       }
       return $result;
   }else{
       return false;
   }

}
//loadCurrencyIntoDb($CurrencycsvFile)

public function find(){

    $sql = "SELECT * FROM ".$this->table;
    $urlComponents = parse_url($_SERVER['REQUEST_URI']);
    $limit;
    $query = $urlComponents['query'] ?? null;

    parse_str($query,$params);

    if ($query != null) {

        if (isset($params['page'])) {
            $page =  $params['page'];
            $min = ($page - 1) * 10;
            $max = $page * 10;
            $sql .= " WHERE id >= '$min' and id <= '$max' ";
            return json_encode(
                ['status'=>'success','return'=>$min." to ".$max." was fetcted",
                'data' => $this->query($sql)->getResult()
                ]
            );
        }else{
            try {
               $sql .= " WHERE id >=1 ";
               foreach ($params as $key => $value) {
                if ($key != 'limit') {
                    $sql .= "and $key like '%$value%' ";
                }
               }
               if (isset($params['limit'])) {
                $limit = $params['limit'];
                $sql .= " LIMIT $limit";
               }else {
                $sql .= " LIMIT 10";
                $limit = 10;
               }

               return json_encode(
                ['status'=>'success','return'=>"First $limit was fetcted",
                'data' => $this->query($sql)->getResult()
                ]
            );


            } catch (\Throwable $th) {
                return json_encode(
                    ['status'=>'failed','return'=>"None",
                    "mesage"=> $th,
                    'data' => null
                    ]
                );
            }
        }

    }else{
        $sql .=" LIMIT 10";
        return json_encode(
            ['status'=>'success',
            'return'=>"First 10 was fetcted",
            'data' => $this->query($sql)->getResult()
            ]
        );
        
    }

} 
    


}