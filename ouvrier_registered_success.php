<!DOCTYPE html>
<html>

<head>
    <title>Inscription Ouvrier | CarLoc</title>
</head>

<link rel="stylesheet" type="text/css" href="assets/css/manager_registered_success.css">
<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<body>

    <!--Bouton de retour en haut..................................................................................-->
    <button onclick="topFunction()" id="myBtn" title="Aller en haut">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
    <!--Javascript pour le bouton de retour en haut....................................................................-->
    <script type="text/javascript">
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

    <!-- Navigation -->
    <?php include 'navbar.php'; ?>

    <?php

    require 'connection.php';
    $conn = Connect();

    $client_name = $conn->real_escape_string($_POST['client_name']);
    $client_username = $conn->real_escape_string($_POST['client_username']);
    $client_email = $conn->real_escape_string($_POST['client_email']);
    $client_phone = $conn->real_escape_string($_POST['client_phone']);
    $client_address = $conn->real_escape_string($_POST['client_address']);
    $client_password = $conn->real_escape_string($_POST['client_password']);

    $query = "INSERT INTO clients (client_name, client_username, client_email, client_phone, client_address, client_password) VALUES ('" . $client_name . "','" . $client_username . "','" . $client_email . "','" . $client_phone . "','" . $client_address . "','" . $client_password . "')";
    $success = $conn->query($query);

    if (!$success) {
        die("Impossible d'entrer les données : " . $conn->error);
    }

    $conn->close();

    ?>


    <div class="container">
        <div class="jumbotron" style="text-align: center;">
            <h2><?php echo "Bienvenue $client_name!" ?></h2>
            <h1>Votre compte a été créé.</h1>
            <p>Connectez-vous maintenant depuis <a href="ouvrierlogin.php">ICI</a></p>
        </div>
    </div>

</body>
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

</html>
