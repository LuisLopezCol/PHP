<?php

//Variables deben empezar con $ y el valor comenzar con una letra o _
$name = 'Luis Lopez';

//Puedes imprimer con echo o con print, tambien puedes usar () si lo requieres
echo "helo, world! I'm $name"; //Echo es mas rapido y print retorna un 1 escondido
echo "helo, world! I'm  {$name}"; //Echo es mas rapido y print retorna un 1 escondido
echo "helo, world! I'm" . $name; //Echo es mas rapido y print retorna un 1 escondido

$x = 1;
$y = &$x;
$x = 5;
echo $y . ' <br />';

//Definir constantes, LA CONVENCION DICE QUE LAS CONST SE DECLARAN EN MAYUSCULA
define('NAME_USER', 'Luis Lopez');
const LAST_NAME = 'LOPEZ MARTINEZ';
echo NAME_USER . ' <br />';
echo LAST_NAME . ' <br />';


//VARIABLE DE VARISBLE  

$foo = 'hola';
$baz = 'mundo!';
$$foo = $baz; //Toma el valor de foo como el nombre de la variable
echo $hola . ' <br />';

//type of variable
echo gettype($foo) . ' <br />';
var_dump($baz) . ' <br />';

$new_array = [1, 2, 3];
print_r($new_array);

//add to an array 
$new_array[] = 4;
print_r($new_array) . ' <br />';
//or
array_push($new_array, 5, 6, 7);
print_r($new_array) . ' <br />';

function sum(int $x, $y)
{
    var_dump($x, $y);
    return $x + $y;
}

echo sum(3, 293);

$array = [1, 2, 3];
echo  ' <pre>';
print_r($array);
echo  ' </pre>';

//redifine de key or index to scan an array
$second_array = [
    'php' => '8.0',
    'python' => '3.9'
];
//pushing a new value
$newLenguage = 'go';
$second_array[$newLenguage] = 1.15;

echo  ' <pre>';
print_r($second_array);
echo  ' </pre>';

//Embeded array 
$newLenguage = 'c++';
$second_array[$newLenguage] = [
    '1.15',
    '4.8.8'
];

echo  ' <pre>';
print_r($second_array);
echo  ' </pre>';

echo ($second_array['c++'][1]);

$third_array = [1, 2, 3, 55 => 4, 5, 6];
echo  ' <pre>';
print_r($third_array);
echo  ' </pre>';
var_dump((array)$third_array);

// array_shift() //remove the first elment //fro the begginig the array got reindex
// array_pop() //remove the last elment
// unset($array[index], $array[otherindex]) //if you dont type the index "unset" will destroy the whole array

$fourth_array = ['a' => 1, 'b' => null];
var_dump(array_key_exists('b', $fourth_array)); //check if the key exists 
var_dump(isset($fourth_array['b'])); //check if the key exists and is not null
