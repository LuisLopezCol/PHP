<?php

include "functionsAPI.php";

#Login e importamos el token
$functionsAPI = new API_Request;
$token = $functionsAPI->loginAPI("https://api.union-andina.net/v1/login");

#Determinamos la estructura de la API
$limitPerPage = 40;
$conentAPI = array_combine(array('totalDocs', 'totalAPIPages'),$functionsAPI->contentAPI($limitPerPage,$token));

#Conexión a la BDD 
$connect = new PDO('mysql:host=localhost; dbname=uandina', 'root', '');

#Creamos una nueva tabla
$create = "CREATE TABLE content(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(40),
    nickname VARCHAR(40),
    description VARCHAR(400),
    propertyType VARCHAR(30),
    country VARCHAR(30),
    city VARCHAR(30),
    zone VARCHAR(30),
    address VARCHAR(60),
    locationType TEXT,
    locationLON FLOAT,
    locationLAT FLOAT,
    neighborhood VARCHAR(30),
    sector VARCHAR(30),
    priceMIN INT,
    priceMAX INT,
    administrationMin INT,
    administrationMax INT,
    currency TEXT,
    areaMIN FLOAT,
    areaMAX FLOAT,
    areaUnit TEXT,
    roomsMIN INT,
    roomsMAX INT,
    bathsMIN INT,
    bathsMAX INT,
    parkingsMIN INT,
    parkingsMAX INT,
    parkingsDescription TEXT,
    warehousesMIN INT,
    warehousesMAX INT,
    warehousesDescription TEXT,
    mainPhoto VARCHAR(30),
    carousel VARCHAR(1000),
    areas VARCHAR(700),
    surroundingDistance INT,
    surroundingTime INT,
    surroundings VARCHAR(700),
    transportations VARCHAR(700),
    accessRoutes VARCHAR(700),
    deliverDateAtMIN VARCHAR(30),
    deliverDateAtMAX VARCHAR(30),
    maxPaymentTermMIN VARCHAR(30),
    maxPaymentTermMAX VARCHAR(30),
    estrato TEXT,
    separationPriceMIN INT,
    separationPriceMAX INT,
    builderUrl VARCHAR(30),
    isVisAvailable TEXT,
    trust VARCHAR(30),
    legalExpenses VARCHAR(30),
    initialFeePercent INT,
    quotaMIN INT,
    quotaMAX INT,
    quotaValueMIN INT,
    quotaValueMAX INT,
    buildInformationTowers INT,
    buildInformationFloorsPerTower INT,
    buildInformationTotalHouses INT,
    buildInformationHousesPerFloor INT,
    buildInformationElevatorsPerTower INT,
    source VARCHAR(30),
    builderClosing VARCHAR(400),
    _id VARCHAR(30),
    updatedAt VARCHAR(30),
    createdAt VARCHAR(30),
    available INT 
)"; 
/*$connect->exec($create);  */

#Actualizar todos los elementos de la BDD como NO DISPONIBLE
$updateAllToNO = 'UPDATE content SET available="0"';
$connect->exec($updateAllToNO);

#Fetch de la API con un ciclo para cada pagina 
for ($page = 1; $page <= $conentAPI['totalAPIPages']; $page++) { 
    #Guardar API en una variable por pagina
    $apiReponse = $functionsAPI->fetchAPI($limitPerPage, $page, $token); 
    try {
       $fields = array(
            'name', 'nickname', 'description',
            array('propertyType', 'name'),
            'country', 'city', 'zone', 'address', 
            array('location', 'type',
                array('coordinates', 0, 1)),
            'neighborhood', 
            array('sector', 'name'),
            array('price','min','max'),        
            array('administration','min','max'),
            array('currency','code'),
            array('area','min','max','unit'),
            array('info',
                array('rooms','min','max' ),
                array('baths','min','max' ),
                array('parkings','min','max', 'description'),
                array('warehouses','min','max', 'description')), 
            'mainPhoto','attachments','areas','surroundingDistance','surroundingTime', 'surroundings','transportations','accessRoutes',
            array('deliverDateAt','min','max'),
            array('maxPaymentTerm','min','max'),
            'estrato',
            array('separationPrice','min','max'),
            'builderUrl', 'isVisAvailable', 'trust', 'legalExpenses', 'initialFeePercent',
            array('quota','min','max'),
            array('quotaValue','min','max'),
            array('buildInformation','towers','floorsPerTower', 'totalHouses', 'housesPerFloor', 'elevatorPerTower'),
            'source','builderClosing','_id','updatedAt', 'createdAt', 
        );
        for($i = 0; $i < $limitPerPage; $i++){
            #Verifica si el objeto existe
            if (!empty($apiReponse[$i])){ 
                #Verifica si el elemento ya esta en la BDD
                $_id = $apiReponse[$i]['_id'];
                $filter = 'SELECT available FROM `content` WHERE _id="'.$_id.'"';
                $query = $connect->prepare($filter);
                $executed = $query->execute(); 
                $result = $query->fetchAll();
                #Si no existe, crea una nueva fila
                if ($result == NULL) {
                    $sql = 'INSERT INTO content VALUES (NULL, ';
                        foreach($fields as $fieldOne){
                            if(is_array($fieldOne)){
                                for($j = 1; $j < count($fieldOne); $j++){
                                    if(is_array($fieldOne[$j])){    
                                        for($k = 1; $k < count($fieldOne[$j]); $k++){
                                            #Si la key no existe dejar el campo como NULL
                                            if (!empty($apiReponse[$i][$fieldOne[0]][$fieldOne[$j][0]][$fieldOne[$j][$k]])) {
                                                $sql .= "'".addslashes($apiReponse[$i][$fieldOne[0]][$fieldOne[$j][0]][$fieldOne[$j][$k]])."',";
                                            }else{$sql .= "NULL,";};                                  
                                        }
                                    }else{
                                        #Si la key no existe dejar el campo como NULL
                                        if (!empty($apiReponse[$i][$fieldOne[0]][$fieldOne[$j]])) {
                                            $sql .= "'".addslashes($apiReponse[$i][$fieldOne[0]][$fieldOne[$j]])."',";
                                        }else{$sql .= "NULL,";};
                                    };
                                }
                            }else{
                                #Si la key no existe dejar el campo como NULL
                                if (!empty($apiReponse[$i][$fieldOne])) {
                                    #Estos cuatro campos los quemamos como un array dentro de la BDD
                                    if ($fieldOne == 'areas' || $fieldOne == 'surroundings' ||$fieldOne == 'transportations'|| $fieldOne == 'accessRoutes' || $fieldOne == 'attachments') {
                                        $sql .= "'" .addslashes(json_encode($apiReponse[$i][$fieldOne]))."',";
                                    } else {$sql .= "'".addslashes($apiReponse[$i][$fieldOne])."',";}
                                }else{$sql .= "NULL,";};
                            }
                        }
                        $sql .= "1);";
                        /*echo $sql;*/
                        $connect->exec($sql);
                #Si ya existe vuelvo a dejarlo disponible
                } else {
                    $updateOneToYES = 'UPDATE content SET available=1  WHERE _id="'.$_id.'"';
                    $connect->exec($updateOneToYES);
                }
            }
        }
    } catch (Exception $e) { 
        die ('error!' . $e->getMessage());
    }
}
$connect = NULL;
