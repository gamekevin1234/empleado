<!doctype html>
<html lang="es">
  <head>
    <title>Buscador de vehiculos</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div class="container">
      <div class="alert alert-warning mt-3">
        <h5>Buscador de vehiculos</h5>
        <span> Escriba el numero de placa:</span>
      </div>

        <form action="" id="formBusqueda" autocomplete="off">

          <div class="mb-3">
            <div class="input-group">
              <input type="text" maxlength="7" placeholder="Placa buscada" class="form-control text-center" id="placa" autofocus>
              <button type="button" class="btn btn-success" id="buscar">Buscar placa</button>
            </div>
            <small id="status">No hay busquedas activas</small>
          </div>

          <div class="mb-3">
            <label for="marca" class="form-label">Marca:</label>
            <input type="text" class="form-control" id="marca" readonly>
          </div>
          <div class="mb-3">
            <label for="modelo" class="form-label">Modelo:</label>
            <input type="text" class="form-control" id="modelo" readonly>
          </div>
          <div class="mb-3">
            <label for="color" class="form-label">Color: </label>
            <input type="text" id="color" class="form-control" readonly>
          </div>
          <div class="mb-3">
            <label for="tipocombustible" class="form-label">Tipo Combustible: </label>
            <input type="text" class="form-control" id="tipocombustible" readonly>
          </div>
          <div class="mb-3">
            <label for="peso" class="form-label">Peso: </label>
            <input type="text" class="form-control" id="peso" readonly>
          </div>
          <div class="mb-3">
            <label for="afrabricacion" class="form-label">Año fabricación: </label>
            <input type="text" class="form-control" id="afabricacion" readonly>
          </div>
        </form>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", () =>{

        function $(id) {return document.querySelector(id)}

        function buscarPlaca(){
          const placa = $("#placa").value

          if(placa != ""){
            const parametros = new FormData()
            parametros.append("operacion", "search")
            parametros.append("placa", placa)

            $("#status").innerHTML = "Buscando, por favor espere..."

            fetch(`../controllers/Vehiculo.controller.php`, {
              method: "POST",
              body: parametros
            })
              .then(respuesta => respuesta.json())
              .then(datos => {
                if (!datos){
                  $("#status").innerHTML = "No se encontro el registro"
                  $("#formBusqueda").reset()
                  $("#placa").focus()
                }else{
                  $("#status").innerHTML = "Vehículo encontrado"
                  $("#marca").value = datos.marca
                  $("#modelo").value = datos.modelo
                  $("#color").value = datos.color
                  $("#tipocombustible").value = datos.tipocombustible
                  $("#peso").value = datos.peso
                  $("#afabricacion").value = datos.afabricacion
                }
              })
              .catch(e => {
                console.error(e)
              })
          }
        }

        $("#placa").addEventListener("keypress", (event) => {
          if (event.keyCode == 13){
            buscarPlaca()
          }
        })

        $("#buscar").addEventListener("click", buscarPlaca)

      })
    </script>
  </body>
</html>
