<?php

//TUBE QUE VOLVER A HACER LA CONEXIÓN PORQUE NO PUDE JALAR LA CONEXION

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SENATIDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Realizo una consulta SQL para contar la cantidad de empleados por sede, utilizando LEFT JOIN para incluir sedes incluso si no tienen empleados asociados.
$sql = "SELECT sedes.sede, COUNT(empleados.idempleado) as cantidad_personas
        FROM sedes
        LEFT JOIN empleados ON sedes.idsede = empleados.idsede
        GROUP BY sedes.idsede, sedes.sede";

$result = $conn->query($sql);

// Ejecuta la consulta y procesa los resultados, almacenando las sedes y la cantidad de personas en arreglos PHP.
$sedes = [];
$cantidadPersonas = [];

while ($row = $result->fetch_assoc()) {
    $sedes[] = $row['sede'];
    $cantidadPersonas[] = $row['cantidad_personas'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Barras</title>

    <!-- Incluyo la biblioteca Chart.js. -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../estilos/informe.css">

</head>
<body>
    <div class="container">
        <!-- Creo un contenedor para el gráfico de barras y establece un título. -->
        <h1 class="chart-title">Gráfico de Barras: Cantidad de Personas por Sede</h1>
        <canvas id="barChart" width="400" height="200"></canvas>
    </div>

    <div class="button-container">
        <button type="button" class="btn btn-outline-success">
            <a href="tabla-empleado.php" style="color: black; text-decoration: none;">Volver a tabla</a>
        </button>
    </div>

    <script>
        // Acá obtine los datos y los asigna a variables JavaScript
        var sedes = <?php echo json_encode($sedes); ?>;
        var cantidadPersonas = <?php echo json_encode($cantidadPersonas); ?>;

        //Acá solo configuramos el grafico de barras
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: sedes,
                datasets: [{
                    label: 'Cantidad de Personas en Sede',
                    data: cantidadPersonas,
                    backgroundColor: 'rgb(0, 137, 19)', // Colo de la barra
                    borderColor: 'rgba(75, 192, 192, 1)', // Color del borde de las barras
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    

</body>
</html>
