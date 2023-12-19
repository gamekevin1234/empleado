<?php

//Incorpora el archivo externo 1 sola vez
//Si detecta un error, se detiene
require_once '../models/Vehiculo.php';

//1. Recibira peticiones (GET - POST - REQUEST)
//2. Realizara el proceso (MODELO - CLASE)
//3. Devolver un resultado (JSON)

//KEY = VALUE
//isset(): verificar si existe objeto
if (isset($_POST['operacion'])){

  //Instanciar la clase
  $vehiculo = new Vehiculo();

  if($_POST['operacion'] == 'search'){
    $respuesta = $vehiculo->search(["placa" => $_POST['placa']]);
    sleep(2);
    echo json_encode($respuesta);
  }

  //Nuevo proceso...
  if ($_POST['operacion'] == 'add'){
    //Almacenar los datros que recibimos de la vista en el arreglo
    $datosRecibidos = [
      "idmarca"         => $_POST["idmarca"],
      "modelo"          => $_POST["modelo"],
      "color"           => $_POST["color"],
      "tipocombustible" => $_POST["tipocombustible"],
      "peso"            => $_POST["peso"],
      "afabricacion"    => $_POST["afabricacion"],
      "placa"           => $_POST["placa"]
    ];

    //Enviamos el arreglo como parámetro del método add
    $idobtenido = $vehiculo->add($datosRecibidos);
    echo json_encode($idobtenido);
  }
}

if(isset($_GET['operacion'])){
  $vehiculo = new Vehiculo();

  if($_GET['operacion'] == 'getResumenTipoCombustible'){
    echo json_encode($vehiculo->getResumenTipoCombustible());
  }
}