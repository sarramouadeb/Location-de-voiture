<?php 
// Démarrer la session en haut de la page
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>entercar | CarLoc</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <style>
    /* Style pour le tableau */
    table {
        width: 100%;
        border-collapse: collapse; /* Fusionner les bordures des cellules */
    }

    /* Style pour les cellules du tableau */
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd; /* Bordure inférieure des lignes */
    }

    /* Style pour l'en-tête du tableau */
    th {
        background-color: #f2f2f2; /* Couleur de fond de l'en-tête */
        color: #333; /* Couleur du texte de l'en-tête */
    }

    /* Style pour les lignes impaires du tableau */
    tr:nth-child(even) {
        background-color: #f2f2f2; /* Couleur de fond des lignes impaires */
    }
</style>

</head>
<body>
    <!-- Navigation -->
    <?php include "navbar.php"; ?>

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="entercar1.php" enctype="multipart/form-data" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;">Veuillez fournir les détails de votre voiture</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Nom de la voiture" required autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="car_nameplate" name="car_nameplate" placeholder="Numéro de plaque d'immatriculation du véhicule" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="ac_price" name="ac_price" placeholder="Tarif AC par kilomètre ($)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="non_ac_price" name="non_ac_price" placeholder="Tarif non-AC par kilomètre ($)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="ac_price_per_day" name="ac_price_per_day" placeholder="Tarif AC par jour ($)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="non_ac_price_per_day" name="non_ac_price_per_day" placeholder="Tarif non-AC par jour ($)" required>
                    </div>
                    <div class="form-group">
    <div class="input-file-container">
        <input type="file" id="uploadedimage" name="uploadedimage">
        
    </div>
</div>

                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">Soumettre pour la location</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 30px;">
        <h3 style="color:blue;text-align:center;">Voitures disponibles</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom de<br> la voiture</th>
                        <th>Numéro de plaque<br> d'immatriculation</th>
                        <th>Tarif avec climatisation <br>(par km)</th>
                        <th>Tarif sans climatisation <br>(par km)</th>
                        <th>Tarif avec climatisation <br>(par jour)</th>
                        <th>Tarif sans climatisation <br>(par jour)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Vérifier si $_SESSION['login_ouvrier'] est définie et non nulle
                    if (isset($_SESSION['login_ouvrier'])) {
                        // Inclure le fichier de connexion à la base de données
                        require 'connection.php';
                        $conn = Connect();

                        // Récupérer l'utilisateur connecté à partir de $_SESSION
                        $user_check = $_SESSION['login_ouvrier'];

                        // Exécuter la requête pour récupérer les voitures associées à l'utilisateur connecté
                        $sql = "SELECT * FROM cars WHERE car_id IN (SELECT car_id FROM clientcars WHERE client_username='$user_check')";
                        $result = mysqli_query($conn, $sql);

                        // Vérifier s'il y a des résultats
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['car_name'] . "</td>";
                                echo "<td>" . $row['car_nameplate'] . "</td>";
                                echo "<td>" . $row['ac_price'] . "</td>";
                                echo "<td>" . $row['non_ac_price'] . "</td>";
                                echo "<td>" . $row['ac_price_per_day'] . "</td>";
                                echo "<td>" . $row['non_ac_price_per_day'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Aucune voiture disponible</td></tr>";
                        }

                        // Fermer la connexion à la base de données
                        $conn->close();
                    } else {
                        echo "<tr><td colspan='6'>Variable de session 'login_ouvrier' non définie ou nulle</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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
