<?php 
    //nivel1 ejercicio 1
    echo "Nivel1 Ejercicio 1 <br>";
    $varInt = 10;
    echo $varInt, "<br>";
    $varDouble = 20.5;
    echo $varDouble , "<br>";
    $varString = "esto es un string";
    echo $varString , "<br>";
    $varBoolean = true;
    echo $varBoolean, "<br>";
    //nivel1 ejercicio 2
    echo "Nivel1 Ejercicio 2 <br>";
    $messege = 'Hello World! ';
    echo strtoupper($messege), "<br>";
    echo strlen ($messege), "<br>";
    echo strrev($messege), "<br>";
    $messege = 'Hello World! ';
    $messege.= 'Este es el curso de PHP.';
    echo $messege. "<br>";
    //nivel1 ejercicio 3
    echo "Nivel1 Ejercicio 3<br>";
    const NOMBRE = "<h1><b>Carlos</b></h1>";
    echo NOMBRE;
    
    echo "Nivel1 Ejercicio 4<br>";
    $x = rand(1,50);
    $y = rand(1,50);
    $n = 1.55;
    $m = 3.88;
    echo "<b>Variables $n , $m , $y , $x . </b>","<br>";
    function suma ($v1, $v2){
        $total = $v1 + $v2;
        //echo "la suma de $v1 y $v2 es $total"."<br>";
        return $total;
    }
    function resta ($v1, $v2){
        $total = $v1 - $v2;
        //echo "la resta de $v1 y $$v2 es $total"."<br>";
        return $total;
    }
    function producto ($v1, $v2){
        $total = $v1 * $v2;
        //echo "el producto de $v1 y $v2 es $total"."<br>";
        return $total;
    }
    function modulo ($v1, $v2){
        $total = $v1 % $v2;
        //echo "el modulo de $v1 y $v2 es $total"."<br>";
        return $total;
    }
    function doble ($v1){
        $total = $v1 * 2;
        //echo "el doble de la variable $v1 es $total"  ."<br>";
        return $total;
    }
    echo "la suma de $x y $y es ".suma($x,$y). "<br>";
    echo "la suma de $n y $m es ".suma($n,$m). "<br>";
    echo "la resta de $x y $y es ".resta($x,$y). "<br>";
    echo "la resta de $n y $m es ".resta($n,$m). "<br>";
    echo "el producto de $x y $y es ".producto($x,$y). "<br>";
    echo "el producto de $n y $m es ".producto($n,$m). "<br>";
    echo "el modulo de $x y $y es ".modulo($x,$y). "<br>";
    echo "el modulo de $n y $m es ".modulo($n,$m). "<br>";
    doble($x). "<br>";
    doble($y). "<br>";
    doble($n). "<br>";
    doble($m). "<br>"; 
    echo "la suma de todas las variables es: ".(suma($x,$y))+(suma($n,$m)). "<br>";
    echo "la resta de todas las variables es: ".(resta($x,$y))-(resta($n,$m)). "<br>";
    echo "el producto  de todas las variables es: ".(producto($x,$y))*(producto($n,$m)). "<br>";
    echo "el modulo de todas las variables es: ".(modulo($x,$y))%(modulo($n,$m)). "<br>";
    
    
    //ejercicio 5
    echo "Ejercicio 5";
    $first = array(2,4,6,8,10);
    $second = array(1,3,5);
    $second[]=7;
    echo "<pre>";
    var_dump($second);
    $arraymerge = array_merge($first,$second);
    var_dump($arraymerge);
    print_r($arraymerge) ;
    echo "el numero de elementos dentro del array unido es ".count($arraymerge)."<br>";
    //nivel 2 ejercicio 1
    echo "Nivel 2  ejercicio1 <br>" ;
    function calcularSuma($x, $y){
    if($y == $x){
        $yx = ($y + $x)*2;

        echo $yx, "<br>";
    }
    else {
        $yx= $y + $x;
        echo $yx."<br>";
        }
    }
     calcularSuma(1,2);
     calcularSuma(3,2);
     calcularSuma(2,2);
        //nivel 2 ejercicio 2
    echo "Ejercicio2 <br>" ;
    
    /*$string1 = "wxyz";
    $string2 = "a" ;
    $string3 = "ab" ;
    echo substr_replace($string1, 'w', 3) , "<br>"; 
    
    
    echo $string1, "<br>";*/

    //nivel 3 ejercicio 1
    echo "Nivel 3 ejercicio1 <br>" ;
    $str = "Hello world";
    $str = str_replace(' ', '',$str );
    $arr1 = str_split($str);
        print_r($arr1)."<br>";
    //nivel 2 ejercicio 2
    echo "Ejercicio2 <br>";
    //Escribe un programa en PHP que cuenta el número total de veces que un valor existe en el array.
    $ejercicio2= array(1,2,3,2,3,1,4,1,5);
    $contador = array_count_values($ejercicio2);
    echo "<pre>";
    var_dump ($contador);
    //nivel 2 ejercicio 3
    echo "Ejercicio3 <br>";

    $ejercicio3 = array (10, 20, 30, 40, 50);
    array_splice($ejercicio3, 3, 1);
    echo "<pre>";
    var_dump ($ejercicio3);


    ?>


