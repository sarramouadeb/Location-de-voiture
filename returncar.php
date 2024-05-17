<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
    <title>Détails du trajet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
        }
     
       
        .form-area {
            margin-top: 50px;
            margin-left: 300px;
            padding: 20px;
            padding-left: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left;
        }
        h3 {
            margin-bottom: 5px;
            text-align: center;
            font-size: 30px;
        }
        h6 {
            margin-bottom: 25px;
            text-align: center;
            font-size: 12px;
        }
        h5 {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .form-control {
            width: 100%;
            height: 38px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .btn-success {
            width: 100%;
            height: 38px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<!-- Navigation -->
<?php include 'navbar.php';?>
<?php
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
$id = $_GET["id"];
$sql1 = "SELECT c.car_name, c.car_nameplate, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.charge_type, d.driver_name, d.driver_phone
 FROM rentedcars rc, cars c, driver d
 WHERE id = '$id' AND c.car_id=rc.car_id AND d.driver_id = rc.driver_id";
$result1 = $conn->query($sql1);
if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
        $car_name = $row["car_name"];
        $car_nameplate = $row["car_nameplate"];
        $driver_name = $row["driver_name"];
        $driver_phone = $row["driver_phone"];
        $rent_start_date = $row["rent_start_date"];
        $rent_end_date = $row["rent_end_date"];
        $fare = $row["fare"];
        $charge_type = $row["charge_type"];
        $no_of_days = dateDiff("$rent_start_date", "$rent_end_date");
    }
}
?>
<div class="container">
    <div class="col-md-7">
        <div class="form-area">
            <form role="form" action="printbill.php?id=<?php echo $id ?>" method="POST">
                <h3>Détails du trajet</h3>
               

                <br>

                <h5>Voiture : <?php echo $car_name;?></h5>
                <h5>Numéro du voiture : <?php echo $car_nameplate;?></h5>
                <h5>Date de location : <?php echo $rent_start_date;?></h5>
                <h5>Date de retour : <?php echo $rent_end_date;?></h5>
                <h5>Tarif : <?php 
                    if($charge_type == "days") {
                        echo ($fare . "$/jour");
                    } else {
                        echo ($fare . "$/km");
                    }
                ?></h5>
                <h5>Nom du chauffeur : <?php echo $driver_name;?></h5>
                <h5>Contact du chauffeur : <?php echo $driver_phone;?></h5>

                <?php if($charge_type == "km") { ?>
                    <input type="text" class="form-control" id="distance_or_days" name="distance_or_days" placeholder="Entrez la distance parcourue (en km)" required autofocus>
                <?php } else { ?>
                    <h5>Nombre de jour(s) : <?php echo $no_of_days;?></h5>
                    <input type="hidden" name="distance_or_days" value="<?php echo $no_of_days; ?>">
                <?php } ?>

                <input type="hidden" name="hid_fare" value="<?php echo $fare; ?>">
                <input type="submit" name="submit" value="Soumettre" class="btn btn-success">
            </form>
        </div>
    </div>
</div>

<footer class="site-footer">
    <div class="container">
        <hr>
        <div style="margin-left:450px">
                <h5>© <?php echo date("Y"); ?> CarLoc</h5>
            </div>
    </div>
</footer>
</body>
</html>
