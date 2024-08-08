<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristería Perla | Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/sidebars.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="h-100 row overflow-hidden">
    <?php
    include_once '../app/includes/admin-menu.php';
    include_once '../app/conn/conn.php';
    include_once '../app/model/orders.model.php';

    $result = getAllOrders($conn);

    $totalPendiente = 0;
    $totalCompletas = 0;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['status'] == 1) {
                $totalPendiente += 1;
            } else {
                $totalCompletas += 1;
            }
        }
    }



    ?>

    <div class="col-8 p-5">

        <h2>Resumen administrativo</h2>
        <hr>
        <input type="hidden" value=" <?php echo $totalCompletas ?> " id="completas">
        <input type="hidden" value=" <?php echo $totalPendiente ?> " id="pendientes">

        <div>
            <canvas id="myChart"></canvas>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="../scripts/sidebars.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const completas = document.getElementById('completas').value;
        const pendientes = document.getElementById('pendientes').value;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ordenes abiertas', 'Ordenes completadas'],
                datasets: [{
                    label: '# Ordenes',
                    data: [pendientes, completas],
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