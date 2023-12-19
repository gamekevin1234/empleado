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
        <h5>Registro de vehiculos</h5>
        <span> complete la informacion solicitada</span>
      </div>

        <form action="" id="formVehiculo" autocomplete="off">
          <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <select name="marca" id="marca" class="form-select">
              <option value="">Seleccione</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" required>
          </div>

          <div class="mb-3">
            <label for="color" class="form-label">color:</label>
            <input type="text" class="form-control" id="color" required>
          </div>

          <div class="mb-3">
            <label for="tipocombustible" class="form-label">Tipo Combustible</label>
            <select name="tipocombustible" id="tipocombustible" class="form-select">
              <option value="">Seleccione</option>
              <option value="GSL">Gasolina</option>
              <option value="DSL">Diesel</option>
              <option value="GNV">GNV</option>
              <option value="GLP">GLP</option>
            </select>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="peso" class="form-label">peso</label>
              <input type="number" class="form-control text-end" id="peso">
            </div>
            <div class="col-md-4 mb-3">
              <label for="afabricacion" class="form-label">año de fabricacion</label>
              <input type="number" class="form-control text-end" id="afabricacion">
            </div>
            <div class="col-md-4 mb-3">
              <label for="placa" class="form-label">placa</label>
              <input type="text" maxlength="7" minlength="7" class="form-control text-center" id="placa">
            </div>
          </div>

          <div class="mb-3">
            <button class="tbn tbn-primary" id="guardar" type="submit">Guardar datos</button>
            <button class="btn btn-secondary" type="reset">Cancelar</button>
          </div>

        </form>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", () =>{

        function $(id) {return document.querySelector(id)}

        //Funcion autoejecutada que trae datos de marcas (backend)
        // y las agrega como <option> ala lista (select) marca
        (function (){
          fetch(`../controllers/Marca.controller.php?operacion=listar`)
            .then(respuesta => respuesta.json())
            .then(datos =>{
              console.log(datos)
              
              datos.forEach(element => {
                const tagOption = document.createElement("option")
                tagOption.value = element.idmarca
                tagOption.innerHTML = element.marca
                $("#marca").appendChild(tagOption)
              });

            })
            .catch(e =>{
              console.error(e)
            })
        })();

        $("#formVehiculo").addEventListener("submit", (event) =>{
          //Evitamos el envio por ACTION
          event.preventDefault();

          //Enviare por AJAX (fetch)
          if (confirm("¿Desea registrar este vehiculo?")){

            const parametros = new FormData()
            parametros.append("operacion", "add") //IMPORTANTE
            //A partir de este punto las variables que requiere el SPU
            parametros.append("idmarca", $("#marca").value)
            parametros.append("modelo", $("#modelo").value)
            parametros.append("color", $("#color").value)
            parametros.append("tipocombustible", $("#tipocombustible").value)
            parametros.append("peso", $("#peso").value)
            parametros.append("afabricacion", $("#afabricacion").value)
            parametros.append("placa", $("#placa").value)

            fetch(`../controllers/Vehiculo.controller.php`, {
              method: "POST",
              body: parametros
            })
              .then(respuesta => respuesta.json())
              .then(datos => {
                if(datos.idvehiculo > 0){
                  $("#formVehiculo").reset()
                  alert(`Vehiculo registrado con ID: ${datos.idvehiculo}`)
                }
              })
              .catch(e => {
                console.error(e)
              })
          }
        })

      })
    </script>

  </body>

</html>
