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
