<?php

//Variables
$apellidos = "ALVAREZ DE LA CRUZ";
$nombres = "Dyer Samil";
//Constantes
define("DNI", "45406071");

//echo $apellidos . "" . $nombres . "" . DNI;

//Areglo (1)
$amigos = array("Karina", "Melissa", "Vania", "Emily", "Sheyla");
$paises = ["Perú", "Argentina", "Venezuela", "Brasil"];

//Funcion imprime: Tipo, Longitud, Dato (DEBUG)
//var_dump($amigos);

/*
foreach($paises as $pais){
  echo $pais;
}
*/

//Arreglo (2) MULTI-DIMESIONAL
$software = [
  ["Eset", "Avast", "Windows Defender", "Avira", "Karspersky"],
  ["WarZone", "Gow", "FreeFire", "Pepsiman", "MarioBross"],
  ["VSCode", "NetBeans", "AndroidStudio", "PSeint"]
];

echo $software[0][3] . "<br>"; //Avira
echo $software[2][0] . "<br>"; //VSCode
echo $software[2][2] . "<br>"; //Android Studio
echo $software[1][0] . "<br>"; //WarZone

foreach ($software as $lista) {
  foreach($lista as $software){
    echo $software . "<br>";
  }
}

//Arreglo (3) ASOCIATIVO (sin indice)
//PHP, JS (Asociativo), JAVA (Mapas), C# (listas), Python (Diccionario)
$catalogo = [
  "so"      => "Windows 10",
  "antivirus" => "Panda",
  "utilitario" => "WinRAR",
  "videojuego" => "MarioBross"
];

echo $catalogo["utilitario"];

//Arreglo (4) MULTIDIMESIONAL + ASOCIATIVO (con/sin indice)
$desarrollador = [
  "datospersonales" => [
    "apellidos"    => "Alvarez De la cruz",
    "nombres"      => "Dyer Samil",
    "edad"         => 39,
    "telefono"     => ["956111111", "956222222"]
  ],
  "formacion"       => [
    "inicial"      => ["Los terribles"],
    "primaria"     => ["Eso Tilin"],
    "secundaria"   => ["Insanos", "Maranguita School"]
  ],
  "habilidades"     => [
    "bd"          => ["MySQL", "MSSQL", "MongoDB"],
    "Frameworks"  => ["Laravel", "CodeIgniter", "Hibernite", "Zend"]
  ]
];

echo "<pre>";
var_dump($desarrollador);
echo "</pre>";

echo json_encode($desarrollador);