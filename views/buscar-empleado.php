<!doctype html>
<html lang="es">
    <head>
        <title>Title</title>
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
        <link rel="stylesheet" href="../estilos/informe.css">
    </head>

    <body>
        <div class="container">
        <div class="alert alert-success mt-3">
            <h5>Buscador de Empleados</h5>
            <span> Ingrese el numero de documento del empleado:</span>
        </div>

            <form action="" id="formBusqueda" autocomplete="off">

            <div class="mb-3">
                <div class="input-group">
                <input type="text" minlength="8" maxlength="8" placeholder="Documento del empleado" class="form-control text-center" id="nrodocumento" autofocus>
                <button type="button" class="btn btn-success" id="buscar">Buscar empleado</button>
                </div>
                <small id="status">No hay busquedas activas</small>
            </div>

            <div class="mb-3">
                <label for="sede" class="form-label">Sede:</label>
                <input type="text" class="form-control" id="sede" readonly>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" readonly>
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" id="nombres" class="form-control" readonly>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fechanac" class="form-label">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="fechanac" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">telefono:</label>
                    <input type="tel" maxlength="9" minlength="9" class="form-control" id="telefono" readonly>
                </div>
            </form>

            <div class="button-container">
                <button type="button" class="btn btn-outline-success">
                    <a href="tabla-empleado.php" style="color: black; text-decoration: none;">Volver a tabla</a>
                </button>
            </div>
        </div>

        <script>
            
            document.addEventListener("DOMContentLoaded", () =>{
                function $(id) {return document.querySelector(id)}
                function buscarNdocument(){
                    const nrodocumento = $("#nrodocumento").value

                    if(nrodocumento != ""){
                        const parametros = new FormData()
                        parametros.append("operacion", "search")
                        parametros.append("nrodocumento", nrodocumento)

                        $("#status").innerHTML = "Buscando, por favor espere..."

                        
                        // Realiza una solicitud POST al servidor para buscar el empleado
                        fetch(`../controllers/Empleado.controller.php`, {
                        method: "POST",
                        body: parametros
                        })

                         .then(respuesta => respuesta.json())
                         .then(datos => {
                        if (!datos){
                            $("#status").innerHTML = "No se encontro el registro"
                            $("#formBusqueda").reset()
                            $("#nrodocumento").focus()
                        }else{
                            //Si encuentra al empleado actualiza el formulario mostrando sus datos
                            $("#status").innerHTML = "Empleado encontrado"
                            $("#sede").value = datos.sede
                            $("#apellidos").value = datos.apellidos
                            $("#nombres").value = datos.nombres
                            $("#fechanac").value = datos.fechanac
                            $("#telefono").value = datos.telefono
                        }
                        })
                         .catch(e => {
                        console.error(e)
                        })
                    }
                }

                $("#nrodocumento").addEventListener("keypress", (event) => {
                if (event.keyCode == 13){
                buscarNdocument()
                }
                })

                $("#buscar").addEventListener("click", buscarNdocument)
            })

        </script>
    </body>
</html>
