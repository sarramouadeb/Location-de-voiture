<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php'; // Assurez-vous que connection.php contient votre logique de connexion
$conn = Connect();
?>

<head>
    <title>Historique de vos réservations</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">

    
</head>

<body>

<!-- Navigation -->
<?php include 'navbar.php'; // Assurez-vous que navbar.php contient votre barre de navigation ?>

<div class="container">
    <?php 
    $login_customer = $_SESSION['login_client']; 

    $sql1 = "SELECT * FROM rentedcars rc, cars c
            WHERE rc.customer_username='$login_customer' 
            AND c.car_id=rc.car_id AND rc.return_status='R'";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
    ?>
    <div class="jumbotron">
        <h2>Historique de vos réservations</h2>
        <p>Nous espérons que vous avez apprécié notre service</p>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Véhicule</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Tarif</th>
                    <th>Distance (km)</th>
                    <th>Nombre de jours</th>
                    <th>Montant total</th>
                </tr>
            </thead>
            <?php
            while($row = mysqli_fetch_assoc($result1)) {
            ?>
            <tr>
                <td><?php echo $row["car_name"]; ?></td>
                <td><?php echo $row["rent_start_date"]; ?></td>
                <td><?php echo $row["rent_end_date"]; ?></td>
                <td> <?php 
                    if($row["charge_type"] == "days") {
                        echo ($row["fare"] . "$/jour");
                    } else {
                        echo ($row["fare"] . "$/km");
                    }
                    ?></td>
                <td><?php  
                    if($row["charge_type"] == "days") {
                        echo ("-");
                    } else {
                        echo ($row["distance"]);
                    }
                    ?></td>
                <td><?php echo $row["no_of_days"]; ?></td>
                <td> <?php echo $row["total_amount"]; ?>$</td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <?php } else { ?>
        <div class="jumbotron">
            <h1>Vous n'avez pas encore loué de véhicule !</h1>
            <p>Veuillez louer un véhicule pour voir votre historique ici.</p>
        </div>
    <?php } ?>   
</div>

<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div style="margin-left:20px">
                <h5>© <?php echo date("Y"); ?> CarLoc</h5>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
