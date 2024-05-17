<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
?>

<head>
    <title>Retour de voiture</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
        }

        .jumbotron {
            text-align: center;
            background-color: whitesmoke;
            padding: 2rem;
            margin-bottom:0px;
            margin-top: 0px;
            width: 900px;
            margin-left: 200px;
        }

        .text-center {
            text-align: center;
        }

        .form-container {
            text-align: center;
            background-color: whitesmoke;
            padding: 2rem;
            margin-top: -25px;
            width: 900px;
            margin-left: 390px;
            height: 1000px;
        }




.form-container h3, .form-container h4 ,.form-container h5{
    text-align: left; /* Aligner le texte à gauche */
    padding-left:50px;
}



.form-container .box h3 {
    color: blue; /* Couleur du texte */
}

.form-container .box h4 {
    margin-bottom: 0px;
}

/* Ajustements pour les petits écrans */
@media (max-width: 768px) {
    .form-container {
        padding: 1rem; /* Réduire le padding pour les petits écrans */
    }
}

       
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include 'navbar.php'; ?>

    <?php
    $id = $_GET["id"];
    $distance = NULL;
    $distance_or_days = $conn->real_escape_string($_POST['distance_or_days']);
    $fare = $conn->real_escape_string($_POST['hid_fare']);
    $total_amount = $distance_or_days * $fare;
    $car_return_date = date('Y-m-d');
    $return_status = "R";
    $login_customer = $_SESSION['login_client'];

    $sql0 = "SELECT rc.id, rc.rent_end_date, rc.charge_type, rc.rent_start_date, c.car_name, c.car_nameplate FROM rentedcars rc, cars c WHERE id = '$id' AND c.car_id = rc.car_id";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while ($row0 = mysqli_fetch_assoc($result0)) {
            $rent_end_date = $row0["rent_end_date"];
            $rent_start_date = $row0["rent_start_date"];
            $car_name = $row0["car_name"];
            $car_nameplate = $row0["car_nameplate"];
            $charge_type = $row0["charge_type"];
        }
    }

    function dateDiff($start, $end)
    {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }

    $extra_days = dateDiff("$rent_end_date", "$car_return_date");
    $total_fine = $extra_days * 200;

    $duration = dateDiff("$rent_start_date", "$rent_end_date");

    if ($extra_days > 0) {
        $total_amount = $total_amount + $total_fine;
    }

    if ($charge_type == "days") {
        $no_of_days = $distance_or_days;
        $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
    } else {
        $distance = $distance_or_days;
        $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', distance='$distance', no_of_days='$duration', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
    }

    $result1 = $conn->query($sql1);

    if ($result1) {
        $sql2 = "UPDATE cars c, driver d, rentedcars rc SET c.car_availability='yes', d.driver_availability='yes' 
    WHERE rc.car_id=c.car_id AND rc.driver_id=d.driver_id AND rc.customer_username = '$login_customer' AND rc.id = '$id'";
        $result2 = $conn->query($sql2);
    } else {
        echo $conn->error;
    }
    ?>

    <div class="container">
        <div class="jumbotron">
            <h2 style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Voiture retournée</h2>
        </div>
    </div>

    <div class="form-container">
        <h2>Merci d'avoir utilisé notre service de location de voitures !</h2>
        <h3>Votre numéro de commande : <span style="color: blue;"><?php echo "$id"; ?></span></h3>
        <h5>Veuillez lire les informations suivantes concernant votre commande :</h5>
        <div class="box">
            <div class="col-md-10" style="margin: 0 auto;text-align:center; ">
                <h3>Votre réservation a été reçue et traitée dans notre système.</h3>
                <br>
                <h4>Veuillez noter votre numéro de commande pour toute communication ultérieure.</h4>
                <br>
            </div>
            </div>
            <div class="col-md-10" >
                <h3 style="color:blue;">Facture</h3>
                <br>
                
                <h4><strong>Nom du véhicule :</strong> <?php echo $car_name; ?></h4>
                <br>
                <h4><strong>Numéro de véhicule :</strong> <?php echo $car_nameplate; ?></h4>
                <br>
                <h4><strong>Tarif :</strong><?php
                if ($charge_type == "days") {
                    echo ($fare . "$/jour");
                } else {
                    echo ($fare . "$/km");
                }
                ?></h4>
                <br>
                <h4><strong>Date de réservation :</strong> <?php echo date("Y-m-d"); ?></h4>
                <br>
                <h4><strong>Date de début :</strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4><strong>Date de fin de location :</strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4><strong>Date de retour de la voiture :</strong> <?php echo $car_return_date; ?></h4>
                <br>
                <?php if ($charge_type == "days") { ?>
                    <h4><strong>Nombre de jours :</strong> <?php echo $distance_or_days; ?> jour(s)</h4>
                <?php } else { ?>
                    <h4><strong>Distance parcourue :</strong> <?php echo $distance_or_days; ?> km(s)</h4>
                <?php } ?>
                <br>
                <?php
                if ($extra_days > 0) {
                    ?>
                    <h4><strong>Amende totale :</strong> <label class="text-danger"> <?php echo $total_fine; ?>$ </label>
                        pour <?php echo $extra_days; ?> jour(s) supplémentaire(s).</h4>
                    <br>
                <?php } ?>
                <h4><strong>Montant total :</strong> <?php echo $total_amount; ?>$</h4>
                <br>
            </div>
        
        <div class="col-md-12" style="margin: 0 auto; text-align: center;">
            <h6>Avertissement ! Ne rechargez pas cette page ou les informations affichées ci-dessus seront perdues. Si
                vous souhaitez une copie papier de cette page, veuillez l'imprimer maintenant.</h6>
        </div>
    

    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <h5>© <?php echo date("Y"); ?> CarLoc</h5>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>