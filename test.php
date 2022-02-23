<?php

//Variables deben empezar con $ y el valor comenzar con una letra o _
$name = 'Luis Lopez';

//Puedes imprimer con echo o con print, tambien puedes usar () si lo requieres
echo "helo, world! I'm $name"; //Echo es mas rapido y print retorna un 1 escondido
echo "helo, world! I'm  {$name}"; //Echo es mas rapido y print retorna un 1 escondido
echo "helo, world! I'm" . $name; //Echo es mas rapido y print retorna un 1 escondido

$x = 1;
$y = &$x; //Para hacer uin tracking de esa variable en todo el programa
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


// ARRAYS -----------------------------------------

<?php
echo  ' <pre>';

//asi se declaran los arrays
$new_array = [1, 2, 3];
$test = array(1,2,4,5);
print_r($new_array); //con print_r imprimo todo el array
echo ' <br />';
var_dump($new_array); //con var_dump tambien lo puedo imp pero este me muestra el tipo de cada dato 
echo ' <br />';
echo $test[2] . ' <br />'; //con echo solo puedi imp un indice

//para verifciar si un index existe puedo usar isset()
var_dump(isset($test[4]));
echo ' <br />';

//add to an array 
$new_array[] = 4; //lo añadira al final
$new_array[] = 97; //lo añadira al final
$new_array[] = 'mundo'; //lo añadira al final
$new_array[2] = 'hola'; //O puedes especificar el indice y el cambiara ese especifico valor
array_pop($new_array); //remove the last elemment of the array
array_shift($new_array); // eliomina el primer valor, sin embargo, cuando elmina el primero reindexa cada elemento a menos que hayas cambiado algunos indezes manuakmente antes
unset($new_array[4]); //unset destruye variables pero usado con un array destruye todo el array a menos que especificquemos un idex y asi solo eliminara el elmento... si eliminamos varios elementos el mantendra el index masa alto
// array_shift() //remove the first elment //fro the begginig the array got reindex
// array_pop() //remove the last elment
// unset($array[index], $array[otherindex]) //if you dont type the index "unset" will destroy the whole array

print_r($new_array) . ' <br />' ;
echo '<br />';
//or
array_push($new_array, 5, 6, 7); //Puedes agrear muchas valores al final con el array_push
print_r($new_array);
echo '<br />';
//modify the array
$array = [1, 2, 3];
print_r($array);
//redifine de key or index to scan an array
$second_array = [
    'php' => '8.0',
    'python' => '3.9'
];
//Cuando ingresamos los indexes el sistema va a tratar de castearlos a enteros por ejemplo, true 1 '1' 1.8 al castearlos todos se vuelven 1 y el sistema sobreescribe todo y solo esocge el ultimo pues estan duplicados.
//Caudno colocas un index como null el index queda como un array vacio 
//pushing a new value
$newLenguage = 'go';
$second_array[$newLenguage] = 1.15;
print_r($second_array);
echo '<br />';

//Embeded array 
$newLenguage = 'c++';
$second_array[$newLenguage] = [
    '1.15',
    '4.8.8'
];
print_r($second_array);
echo $second_array['c++'][1] . '<br />'; //Como llegar hasta el elemento deseado 

$third_array = [1, 2, 3, 55 => 4, 5, 6]; //Cuando cambiasun indice el sistema cambia el valor de los siguitnes para lelvar la cuenta
print_r($third_array);
echo '<br />';

//casteamos el elemento a una rray
var_dump((array)$third_array); 

//Checking if a key exists
$fourth_array = ['a' => 1, 'b' => null];
var_dump(array_key_exists('b', $fourth_array)); //check if the key exists 
var_dump(isset($fourth_array['b'])); //check if the key exists and is not null

// count();  cuenta la cantidad de elementos del array
// strlen() cuenta las letras de un string



// EXPRESSIONS -------------------------------

//PHP is an expression oriented lenguage
//Las expresiones mas comunes son variables, constantes y literal values. estas son basicamente todo lo que esta despues del =
$x = 5; //5 es un lietarl value el cual es una expresion
$y = $x; //x es una variable y par aeste caso es la expresion
$x = $x === $y; // las comparaciones tambien se consideran expresiones pues ellas devolveran un boolean $x === $y
function sum(int $x, $y)
{
    var_dump($x, $y);
    return $x + $y;
}
$z = sum($x,$y); //las fucniones tambien se consideran expresions
if ($x <5) { // $x <5 tambien es una exprsion porque devulve un bool, ten en cuenta que tambien pasa por ejemplo con los loops
        echo "helo wolrd";
}



// OPERATORS -------------------------------

//unary operators solo recibrn un valor por ejemplo !
//Binary operators reciben dos valores la mayoria de operadores son binarios
//Ternaries operators reciben tres operands por ejemplo ?:

/** 
* Aritmeticos + - * / % **  
    Trucos: si ussas + o - antes de la variable por ejemplo +$x = '5' lo casteara a int
            si usas / y ambos operadores son int el resultado es int pero si no sera float
            Tambien si tenemos una division entre cero el programa se caera, para evitarlo podemos llevar el resultado a infinito evitando que el rpgorama se caiga para esto usamos la funcion fdiv($x, $y) 
            Ahora cuando usamos % el tomara los operandos como enteros por ejemplo si ingresas 10.5 % 2.5 el tomara 10 % 2 que su valor mod es 0 si quieres usar esta funcionalidad con float usa la funcion fmod($x , $y)
            Otra cosa de % es que el signo lo toma del divisor es decir 10 % -3 = 1 y -10 % 3 = -1 
* Asigment = += -= *= /= /= **=
    trucos: Podemos usar varios = en una sola linea $x = $y = 5 en este x y y son 5
            pero ojo como usamos esto con corchete por ejemplo $x = ($y =10) +5 lo que dira es que y = 10 -> y + 5 = 15 --> X=15
* String Operatos . .=
            Nos ayudan a concatenar
* comparaison == === != <> !== < > >= <= <=> ?? :?
            <> es lo mismo que !=
            $x <=> &y devolvera -1 si  x < y ____ devulve 1 si y < x ____ devuelve 0 si son iguales
            si comparas un int y un string el sistema convertira ambosa string y luego los comapra 
            podemos usar strpos($x, 'H') para buscar un valor en un string y retorna la posicion de ese valor 
            ?:  son operadores ternarios uque hacen lo mismo que un if else... ejmplo: l$ === 5 ? "l  es igual a " : "l no es 5":
            ?? se utiliza para ver si una vriable es null por ejemplo $x = null;   $y = $ x ?? 'hello' aca $y va a sser 'hello' porque la logica dice que si x es null entonces y toma el valor despues de ??----- ahorabien si x no es null y se vuelve false
*error contro opeartors @
            no se debe usar... se usa para ocultar errores por ejemplo $x = @file('foo.txt') como estamos tratantdo de abrir un archivo que no extste el sietma muestra un error pero al colocarle el arroba al preincipio lo ocultamos
*increment / decrement operators ++ --
            Depende de dpnde lo uses si lo usas $x++ primero te da el valor y luego lo incrementa ++&x primero incrementa y luego lo devuelve
            si agregas -- a un string no pasa nada si agregas ++ a un string aumenta un valor por ejemplo ++abc = abd
* Logical Operators && || ! and or xor
            and or xor hacen lo mismo pero tiene poca presedencia $x = $y and $z el programa primero aplcara la asignacion de = y luego el and
            los operatos pueden ser short circuit si encuentra un valor en false  por ejmpleo en var_dump($x && suma(3, 5)) la suma nunca se realizará dado que el programa correra hasta $x  aqui habra un corto circuito dado uq eal ser $x false para en caso de ser true si lo aplicara
*bitwise operators & | ^ ~ << >>       
            Se usan en operaciones binarias
            $x = 6 $y = 3

            110
            &
            011
            ----
            010 = 2

            110
            |
            011
            ----
            111 = 7

            110
            ^
            011
            ----
            010 = 7
            
            ~$x = 6 $y = 3
            110
            ~
            001
            $
            011
            ----
            001 = 1

            $x = 6 $y = 3
            
            $x << $y
            110
            <<<
            110000 = 48
            
            $x >> $y
            110
            >>>
              0 = 0
* Array operators + == === != <> !==
            + concatena dos arrays cuando no el segudno es mas largo y lo que hace es agregar al primer array los elemntos de mas en el segundo array 
            por ejemplo $x = [1 ,2 ,3] $y = [5, 6 ,7]   $z = $x + $y   $z = [1 ,2 ,3]
            pero! $x = [1 ,2 ,3] $y = [5, 6 ,7, 8, 9]   $z = $x + $y   $z = [1 ,2 ,3, 8, 9]
            Pero otra vez ojo esto lo hace porque los indeces de los elemtnos son iguales si cambias los indeces el resultado final será todos los elementos contatenados. pero nuevamente si alguno tiene el mismo indice lo sobrescribira y no lo contcatenarara
            == se usa para comparar arrays y estos solo sera true si los indices y los valores son iguales
            === se usa para comparar arrays y estos solo sera true si los indices y los valores son iguales y ademas estan en el mismo orden!

* precedence for operators 

*/

$ll = 6;
$llresult = $ll === 5 ? "l  es igual a 5" : "l no es 5 es " . $ll;
echo $llresult;
echo '<br/>';

//FOREACH ---------

foreach ($test as $value) {
    echo "works!";
    echo $value . '<br/>';
};

foreach ($test as $key => $value2) {
    echo "works with index!";
    echo $key . ': ' . $value2 . '<br/>';
}

$user = [
    'name' => 'Luis',
    'email' => 'luis@paxzu.co',
    'skills' => ['php', 'grapghql', 'react'],
];

foreach ($user as $key => $value) {
    echo $key . ': ' . json_encode($value) . '<br/>';
}

echo '<br/>';
echo '<br/>';

foreach ($user as $key => $value) {
    if (is_array($value)) //implode solo se usa si es array por eso es importante hacer la verificación
    echo $key . ': ' . implode($value) . '<br/>';
}

echo '<br/>';
echo '<br/>';

foreach ($user as $key => $value) {
    echo $key . ': ';
    if (is_array($value)) {
        foreach ($value as $value) {
            echo $value . '- ';
        };
    }else{
        echo $value;
    }
    echo '<br/>';
}
echo '<br/>';

/** 
//Mathc vs Switch match es estrcito mientras que switch no---- swithc soporta varias funciones y match no
$paymentStatus = 1;
$testing2 = match($paymentStatus) {
    1,3  => print 'paid',
    2  => print 'declined',
    0  => print 'pending',
}; */

// DECLARE ----------------

//Declare - Ticks evento que ocurre en el bajo nivel de php es basicamente cada vez que se ejecute una expresion  podemos declarar algo alli por ejemplo:
function onTick(){ //Una funcion cualquiera para mostrar que pasa cuando se cumplen los determinados ticks
    echo 'Tick <br/>';
}

register_tick_function('onTick'); //aca llamamos la funciones que queramosaplicar cada vez que se cuenten los ticks

declare(ticks=3); //Aca esdonde declaramos los ticks que queremos estabelcer como intervalo 

//ahora mostramos como fuinciona
$i=0;
$lenght = 10;
while ($i <= $lenght) {
    echo $i++ . '<br/>';
}
//Declare - encoding --- no se usa no desgastarsse con esto

//Declare - STRICT Importante

//declare(strict_types = 1); //Habilitamos el modo estricto y de ahi ena delante todo sera estricto

function sumatest(int $x, int $y){
    return $x + $y;
}
echo sumatest(5, 10);

// declare(strict_types = 0);
echo sumatest('5', 10);



// INCLUDE FILES IN PHP ------------------
/** 

*require 
*require_once 
*include 
*include_once 
la diferencia entre require e include dara un waring si no enceuntra el archivo mientras que require para el programa con un error 
el _once lo que hace s que asi lo importemos muchas veces solo se incluira una vez por ejemplo abajo podemos solucionar el problma utilizando include_once
*/
include 'test.php';
include 'test.php';

require 'numero25.php';
$h += 30;
echo "resultado $h";
echo '<br/>';

echo "resultado {$h}";
echo '<br/>';

require 'numero25.php'; //si lo vuelves a importar reescribe la variable
$h += 10;
echo "resultado ${h}";
echo '<br/>';


//podemos indicarle a una funcipn el tipo de dato a retornar usando la siguiente sintaxis 
function foo(): int{ 
    return '1'; //aca lo colcoamos como stringpara mostrar quephp lo corregia int pero si lo ponemos en stryct me va a mandar error
}
var_dump(foo());
echo '<br/>';

function foob(): void{ 
    return;
}
var_dump(foob());
echo '<br/>';

//si quiero retoranr un null no pudeo decirle return null nada mas; debo colocar al lado de int un ? para que lo acepte y enc aso que el programa regrese un int tambien me lo acepta--- ?int basicamente regresa null o int
function fooab(): ?int{ 
    return null;
}
var_dump(fooab());
echo '<br/>';

//Puedo usar | para decirle que acepto retornar varios tipos de valores, tambien podria usar fooaba(): mixed { } pero es mejor declarar lo que quierp dapo que mixed es muy abiertp
/**  function fooaba(): int|float { 
    return 2;
}
var_dump(fooaba());
echo '<br/>'; */

function fooabar(int|float $g, int $i){  
    return $g + $i;
}
echo fooabar(5.2 , 6.8) . "int|float"; //Como 1 lo decalre como int el programa lo castea llevandolo a 6
echo '<br/>';

function sumaconmuchos(...$numbers){  
    $total = NULL;
    foreach ($numbers as $value) {
        $total += $value;
    }
    //La suma de los array se puede ahcer con array_sum(&numbers);
    return $total;
}

echo sumaconmuchos(5.2 , 6.3, $i, $x, $y) . "muchos valores" . '<br/>'; //Como 1 lo decalre como int el programa lo castea llevandolo a 6

//Order matters sin embargo si queremos llamar a una funcion con valores en desorden simplemente mencionamos el nombre de la varible seguidod e :
$f = 15;
echo fooabar(g: $f, i:6.8) . "asginado variables desde la entrada" . '<br/>';  //Como 1 lo decalre como int el programa lo castea llevandolo a 6

$r = 5;

function moo(){
    global $r;
    //$GOLBAL['x']=10; //tambien se puede acceder a la variable usando la variable $GLOBAL e identificando la lalve
    echo $r . "asi llamamos a una variable del dom dentro de una funcion usando global";
}

moo();

//FUNCIONES ---------------------

//variables
function suma2(int ...$numbers): int{
    return array_sum($numbers);
}

$x = 'suma2';
echo $x(1,2,3,4); //Php cuando encuntra parentesis al lado de una variable va a buscar dentro del codigo alguna funcioncon ese mismo nombre, en este caso lo enceuntra y lo ejecuta si no lo encuentra enia un error para eviar eso se usa is_callable() asi-->

$y = 'sumar2';
if (is_callable($y)){
    echo $y(1,2,3,4);
} else {
    echo "not callable" . '<br/>';
}

//func anonimas --- no tienen nombre
$tto = function ($x , $y): int{
    return $x + $y;
};
echo $tto(y: 4 , x: 52) . '<br/>';

//Callbacks

$unarraymas = [1,3,4,62,63];
$otroarraymas = array_map(function($element){
    return $element * 2;
}, $unarraymas);
print_r($unarraymas);
print_r($otroarraymas);

$unarraymas2 = [5,43,54,662,163];
$f =  function($element){
    return $element * 2;
};
$otroarraymas2 = array_map($f, $unarraymas2);
print_r($unarraymas2);
print_r($otroarraymas2);

//Callable se usa para llamar una funcion dentro de los argumentos de otra

$test3 = function (callable $callback, ...$numbers){
    return $callback(array_sum($numbers));
};

echo $test3('foor', 2,4,2,4,62,34);

function foor($element){
    return $element * 2;
}
//tambien puedes usar closure envez de callable pero clousre debe ser para funciones anonimas

//Arrow functions..
$array4 = [1,2,62,4];
$array5 = array_map(fn($number)=> $number*$number, $array4);
print_r( $array5); 
$new_array = [1, 2, 3];
$Test = array(1,2,4,5);
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
