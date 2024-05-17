<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
    <title>Retournez vos voitures ici</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .jumbotron {
            padding: 2rem;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 0px;
            background-color: whitesmoke !important;
        }
        .table-responsive {
           
            overflow-x: auto;
            background-color: whitesmoke !important;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid black;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid black;
            background-color: #f8f9fa;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .site-footer {
            text-align: center;
            padding: 2rem 0;
            margin-top: 2rem;
        }
        h2{
            color: blue !important;
        }
        p{
    color: #a040a0;
}
    </style>
</head>
<body>
<!-- Navigation -->
<?php include 'navbar.php'; ?>
<?php 
$login_customer = $_SESSION['login_client']; 
$sql1 = "SELECT c.car_name, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.charge_type, rc.id FROM rentedcars rc, cars c
        WHERE rc.customer_username='$login_customer' AND c.car_id=rc.car_id AND rc.return_status='NR'";
$result1 = $conn->query($sql1);
?>
<div class="container">
    <?php if (mysqli_num_rows($result1) > 0) { ?>
        <div class="jumbotron">
            <h2>Retournez vos voitures ici</h2>
            <p>Nous espérons que vous avez apprécié notre service</p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="30%">Voiture</th>
                        <th width="20%">Début location</th>
                        <th width="20%">Fin location</th>
                        <th width="20%">Tarif</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
                    <tr>
                        <td><?php echo $row["car_name"]; ?></td>
                        <td><?php echo $row["rent_start_date"]; ?></td>
                        <td><?php echo $row["rent_end_date"]; ?></td>
                        <td> <?php 
                            if ($row["charge_type"] == "days") {
                                echo ($row["fare"] . "$/jour");
                            } else {
                                echo ($row["fare"] . "$/km");
                            }
                        ?></td>
                        <td><a href="returncar.php?id=<?php echo $row["id"];?>">Retourner</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } else { ?>
        <div class="jumbotron">
            <h1>Aucune voiture à retourner.</h1>
            <p>Nous espérons que vous avez apprécié notre service</p>
        </div>
    <?php } ?>
</div>
<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div style="margin-left:150px">
                <h5>© <?php echo date("Y"); ?> CarLoc</h5>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
