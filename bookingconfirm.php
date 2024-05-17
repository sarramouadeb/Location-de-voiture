<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation de voiture</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link rel="stylesheet" type="text/css" media="screen" href="bookingconfirm.css">
</head>

<body>

    <?php
    include ('session_client.php');

    // Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté
    if (!isset($_SESSION['login_client'])) {
        session_destroy();
        header("location: clientlogin.php");
        exit(); // Arrête l'exécution du script
    }
    if (isset($_POST['radio'])) {
        $type = $_POST['radio'];
    } else {
        // Gérer le cas où 'radio' n'est pas défini
        $type = ''; // ou une autre valeur par défaut
    }
  
    $charge_type = $_POST['radio1'];
    $driver_id = $_POST['driver_id_from_dropdown'];
    $customer_username = $_SESSION["login_client"];
    $car_id = $conn->real_escape_string($_POST['hidden_carid']);
    $rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $return_status = "NR"; // non retourné
    $fare = "NA";

    function dateDiff($start, $end)
    {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }

    $err_date = dateDiff($rent_start_date, $rent_end_date);
/**********/ 

    $sql0 = "SELECT * FROM cars WHERE car_id = '$car_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while ($row0 = mysqli_fetch_assoc($result0)) {
            if ($type == "ac" && $charge_type == "km") {
                $fare = $row0["ac_price"];
            } else if ($type == "ac" && $charge_type == "days") {
                $fare = $row0["ac_price_per_day"];
            } else if ($type == "non_ac" && $charge_type == "km") {
                $fare = $row0["non_ac_price"];
            } else if ($type == "non_ac" && $charge_type == "days") {
                $fare = $row0["non_ac_price_per_day"];
            } else {
                $fare = "NA";
            }
        }
    }

    if ($err_date >= 0) {
        $sql1 = "INSERT INTO rentedcars (customer_username, car_id, driver_id, booking_date, rent_start_date, rent_end_date, fare, charge_type, return_status) 
             VALUES ('$customer_username', '$car_id', '$driver_id', '" . date("Y-m-d") . "', '$rent_start_date', '$rent_end_date', '$fare', '$charge_type', '$return_status')";
        $result1 = $conn->query($sql1);

        $sql2 = "UPDATE cars SET car_availability = 'no' WHERE car_id = '$car_id'";
        $result2 = $conn->query($sql2);

        $sql3 = "UPDATE driver SET driver_availability = 'no' WHERE driver_id = '$driver_id'";
        $result3 = $conn->query($sql3);

        $sql4 = "SELECT * FROM cars c, clients cl, driver d, rentedcars rc WHERE c.car_id = '$car_id' AND d.driver_id = '$driver_id' AND cl.client_username = d.client_username";
        $result4 = $conn->query($sql4);

        if (mysqli_num_rows($result4) > 0) {
            while ($row = mysqli_fetch_assoc($result4)) {
                $id = $row["id"];
                $car_name = $row["car_name"];
                $car_nameplate = $row["car_nameplate"];
                $driver_name = $row["driver_name"];
                $driver_gender = $row["driver_gender"];
                $dl_number = $row["dl_number"];
                $driver_phone = $row["driver_phone"];
                $client_name = $row["client_name"];
                $client_phone = $row["client_phone"];
            }
        }

        if (!$result1 || !$result2 || !$result3) {
            die("Impossible d'enregistrer les données : " . $conn->error);
        }
        ?>

        <!-- Barre de navigation -->
        <?php include ('navbar.php'); ?>

        <div class="container1">
            <div class="jumbotron">
                <h2 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>
                    Réservation confirmée.</h2>
            </div>

            <br>
            <div class="container2">
            <h2 class="text-center"> Merci d'avoir choisi notre système de location de voitures !<br> Nous vous souhaitons un bon
                trajet! </h2>

            
                <h5 class="text-center">Veuillez lire les informations suivantes concernant votre réservation.</h5>
                <div class="box">
                    <div class="col-md-10" style="float: none; margin: 0 auto;">
                        <h3 style="color: rgb(50, 120, 150);">Votre réservation a été reçue et placée dans notre système de traitement
                            des commandes.</h3>
                        <br>
                        <h4>Merci de noter votre <strong>numéro de commande</strong> et de le conserver au cas où vous
                            auriez besoin de nous contacter concernant votre réservation.</h4>
                            </div>
                        <br>
                        <h3 style="color: rgb(50, 120, 150);text-align:center;">Facture</h3>
                        <br>
                    </div>
                    <div class="col-md-10" style="float: none; margin: 0 auto; ">
                        <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="color: rgb(50, 120, 150);text-align:center;">Description</th>
                                <th style="color: rgb(50, 120, 150);text-align:center;">Détails</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="p-3" >Nom du véhicule</td>
                                <td class="p-3"><?php echo $car_name; ?></td>
                            </tr>
                            <tr>
                                <td>Numéro de véhicule</td>
                                <td><?php echo $car_nameplate; ?></td>
                            </tr>
                            <tr>
                                <td>Tarif</td>
                                <td><?php echo ($charge_type == "days") ? '' . $fare . '$/jour' : '' . $fare . '$/km'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Date de réservation</td>
                                <td><?php echo date("Y-m-d"); ?></td>
                            </tr>
                            <tr>
                                <td>Date de début</td>
                                <td><?php echo $rent_start_date; ?></td>
                            </tr>
                            <tr>
                                <td>Date de retour</td>
                                <td><?php echo $rent_end_date; ?></td>
                            </tr>
                            <tr>
                                <td>Nom du chauffeur</td>
                                <td><?php echo $driver_name; ?></td>
                            </tr>
                            <tr>
                                <td>Sexe du chauffeur</td>
                                <td><?php echo $driver_gender; ?></td>
                            </tr>
                            <tr>
                                <td>Numéro de permis du chauffeur</td>
                                <td><?php echo $dl_number; ?></td>
                            </tr>
                            <tr>
                                <td>Contact du chauffeur</td>
                                <td><?php echo $driver_phone; ?></td>
                            </tr>
                            <tr>
                                <td>Nom du client</td>
                                <td><?php echo $client_name; ?></td>
                            </tr>
                            <tr>
                                <td>Contact du client</td>
                                <td><?php echo $client_phone; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
                <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                    <h6>Avertissement ! <strong>Ne rechargez pas cette page</strong> ou les informations ci-dessus seront
                        perdues. Si vous souhaitez une copie papier de cette page, veuillez l'imprimer maintenant.</h6>
                </div>
          

        <?php } else { ?>

            <?php include ('navbar.php'); ?>
            <div class="container">
                <div class="" style="text-align: center;background-color:whitesmoke;padding:20px;">
                   <h2 style="color:red;"> Vous avez sélectionné une date incorrecte!</h2>
                    <br><br>
                </div>
            </div>

        <?php } ?>
    </div>
    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="loc">
                    <h5>© <?php echo date("Y"); ?> CarLoc</h5>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>