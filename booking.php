<!DOCTYPE html>
<html>
<?php 
 include('session_client.php');
if(!isset($_SESSION['login_client'])){
    session_destroy();
    header("location: clientlogin.php");
}
?> 
<title>Réserver une voiture</title>
<head>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body> 

    <!-- Navigation -->
    <?php include 'navbar.php'; ?>
    
    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="bookingconfirm.php" method="POST">
                    <br style="clear: both">
                    <br>

                    <?php
                    $car_id = $_GET["id"];
                    $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
                    $result1 = mysqli_query($conn, $sql1);

                    if(mysqli_num_rows($result1)){
                        while($row1 = mysqli_fetch_assoc($result1)){
                            $car_name = $row1["car_name"];
                            $car_nameplate = $row1["car_nameplate"];
                            $ac_price = $row1["ac_price"];
                            $non_ac_price = $row1["non_ac_price"];
                            $ac_price_per_day = $row1["ac_price_per_day"];
                            $non_ac_price_per_day = $row1["non_ac_price_per_day"];
                        }
                    }
                    ?>

                    <h5>Voiture sélectionnée : <b><?php echo $car_name; ?></b></h5>
                    <h5>Numéro de plaque : <b><?php echo $car_nameplate; ?></b></h5>
                    <label><h5>Date de début :</h5></label>
                    <input type="date" name="rent_start_date" min="<?php echo date("Y-m-d"); ?>" required="">
                    &nbsp; 
                    <label><h5>Date de fin :</h5></label>
                    <input type="date" name="rent_end_date" min="<?php echo date("Y-m-d"); ?>" required="">

                    <h5>Choisissez le type de voiture :</h5>
                    <input type="radio" name="radio" value="ac"> <b>Avec climatisation </b>&nbsp;
                    <input type="radio" name="radio" value="non_ac"> <b>Sans climatisation </b>

                    <div>
                        <h5>Tarif :</h5>
                        <!-- Placeholder pour le tarif basé sur la sélection radio -->
                    </div>

                    <h5>Type de frais :</h5>
                    <input type="radio" name="radio1" value="km"> <b>Par kilomètre</b> &nbsp;
                    <input type="radio" name="radio1" value="days"> <b>Par jour</b>

                    <br><br>

                    <label>Sélectionnez un chauffeur :</label>
                    <select name="driver_id_from_dropdown">
                        <?php
                        $sql2 = "SELECT * FROM driver d WHERE d.driver_availability = 'yes'";
                        $result2 = mysqli_query($conn, $sql2);

                        if(mysqli_num_rows($result2) > 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                                $driver_id = $row2["driver_id"];
                                $driver_name = $row2["driver_name"];
                                echo "<option value='$driver_id'>$driver_name</option>";
                            }
                        } else {
                            echo "<option disabled>Aucun chauffeur disponible</option>";
                        }
                        ?>
                    </select>

                    <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
                
                    <input type="submit" name="submit" value="Réserver maintenant" class="btn btn-success pull-right">     
                </form>
                <br>
            </div>
            <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                <h6><strong>Remarque :</strong> Des frais supplémentaires de <span class="text-danger"> 100$ </span> seront facturés pour chaque jour après la date limite.</h6>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> CarLoc</h5>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
