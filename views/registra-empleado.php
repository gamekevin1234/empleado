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

        <link rel="stylesheet" href="../estilos//informe.css">
    </head>

    <body>
        <div class="container">
            <div class="alert alert-success mt-3">
                <h5>Registro de Empleado</h5>
                <span> complete la informacion solicitada</span>
            </div>

            <form action="" id="formEmpleado" autocomplete="off">
                <div class="mb-3">
                    <label for="sede" class="form-label">Sede</label>
                    <select name="sede" id="sede" class="form-select">
                    <option value="">Seleccione</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" required>
                </div>

                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                    <label for="nrodocumento" class="form-label">Numero de documento</label>
                    <input type="number" class="form-control text-end" id="nrodocumento">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="fechanac" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control text-end" id="fechanac">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="cel" class="form-control text-center" id="telefono" maxlength="9">
                </div>

                <div class="mb-3">
                    <button class="btn btn-outline-success" id="guardar" type="submit">Guardar datos</button>
                </div>

                <div class="button-container">
                    <button type="button" class="btn btn-outline-success">
                        <a href="tabla-empleado.php" style="color: white; text-decoration: none;">Volver a tabla</a>
                    </button>
                </div>



            </form>
        </div>  

        <script>

            //El DOM hace que el scrip no se ejecute asta que todo el html carge
            document.addEventListener("DOMContentLoaded", () =>{

                function $(id) {return document.querySelector(id)}

                (function (){
                //Realiza una solicitud, está solicitando información al archivo Sede.controller.php con la operación listar.
                fetch(`../controllers/Sede.controller.php?operacion=listar`)
                    //Convierte la solucitud a formato json
                    .then(respuesta => respuesta.json())
                    .then(datos =>{
                    console.log(datos)
                    
                    datos.forEach(element => {
                        const tagOption = document.createElement("option")
                        tagOption.value = element.idsede
                        tagOption.innerHTML = element.sede
                        $("#sede").appendChild(tagOption)
                    });

                    })
                    .catch(e =>{
                    console.error(e)
                    })
                })();

                $("#formEmpleado").addEventListener("submit", (event) =>{

                    event.preventDefault();

                    if (confirm("¿Desea registrar al empleado?")){

                        const parametros = new FormData()
                        parametros.append("operacion", "add") 

                        parametros.append("idsede", $("#sede").value)
                        parametros.append("apellidos", $("#apellidos").value)
                        parametros.append("nombres", $("#nombres").value)
                        parametros.append("nrodocumento", $("#nrodocumento").value)
                        parametros.append("fechanac", $("#fechanac").value)
                        parametros.append("telefono", $("#telefono").value)

                        fetch(`../controllers/Empleado.controller.php`, {
                        method: "POST",
                        body: parametros
                        })
                        .then(respuesta => respuesta.json())
                        .then(datos => {
                            if(datos.idempleado > 0){
                            $("#formEmpleado").reset()
                            alert(`Empleado registrado con ID: ${datos.idempleado}`)
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
