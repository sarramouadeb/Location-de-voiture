<?php
session_start();

// Inclure le fichier de connexion à la base de données
require 'connection.php';
$conn = Connect();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $driver_name = $conn->real_escape_string($_POST['driver_name']);
    $dl_number = $conn->real_escape_string($_POST['dl_number']);
    $driver_phone = $conn->real_escape_string($_POST['driver_phone']);
    $driver_address = $conn->real_escape_string($_POST['driver_address']);
    $driver_gender = $conn->real_escape_string($_POST['driver_gender']);
    $client_username = $_SESSION['login_ouvrier'];
    $driver_availability = "yes";

    $query = "INSERT INTO driver (driver_name, dl_number, driver_phone, driver_address, driver_gender, client_username, driver_availability) VALUES ('$driver_name', '$dl_number', '$driver_phone', '$driver_address', '$driver_gender', '$client_username', '$driver_availability')";
    
    try {
        $success = $conn->query($query);

        if (!$success) {
            throw new Exception("Erreur lors de l'ajout du conducteur : " . $conn->error);
        } else {
            // Redirection après 2 secondes si l'insertion est réussie
            echo '<script>setTimeout(function() { window.location = "enterdriver.php"; }, 2000);</script>';
            exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Erreur de duplication de clé (dl_number)
            $error_message = "Erreur : Le numéro de permis de conduire est déjà enregistré.";
        } else {
            // Autre erreur SQL
            $error_message = "Erreur lors de l'ajout du conducteur : " . $e->getMessage();
        }
    } catch (Exception $e) {
        $error_message = "Erreur lors de l'ajout du conducteur : " . $e->getMessage();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmation d'ajout d'un conducteur | CarLoc</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
</head>
<body>
    <!-- Navigation -->
    <?php include "navbar.php"; ?>

    <div class="container" style="margin-top: 65px;">
        <div class="jumbotron" style="text-align: center;">
            <h3>Confirmation d'ajout d'un conducteur</h3>
            <?php if (!empty($error_message)) { ?>
                <p><?php echo $error_message; ?></p>
                <a href="enterdriver.php" class="btn btn-primary">Retour</a>
            <?php } else { ?>
                <p>Le conducteur a été ajouté avec succès.</p>
                <a href="enterdriver.php" class="btn btn-primary">Retour</a>
            <?php } ?>
        </div>
    </div>

    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> Car Rentals</h5>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
