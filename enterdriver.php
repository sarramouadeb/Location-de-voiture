<?php
session_start();

// Vérifier la session et l'utilisateur connecté
if (!isset($_SESSION['login_ouvrier'])) {
    header("Location: login.php");
    exit();
}

// Inclure le fichier de connexion à la base de données
require 'connection.php';
$conn = Connect();

// Variable pour stocker le message d'erreur
$error_message = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $driver_name = $conn->real_escape_string($_POST['driver_name']);
    $dl_number = $conn->real_escape_string($_POST['dl_number']);
    $driver_phone = $conn->real_escape_string($_POST['driver_phone']);
    $driver_address = $conn->real_escape_string($_POST['driver_address']);
    $driver_gender = $conn->real_escape_string($_POST['driver_gender']);
    $client_username = $_SESSION['login_ouvrier'];
    $driver_availability = "yes";

    // Requête SQL pour insérer un nouveau conducteur
    $query = "INSERT INTO driver (driver_name, dl_number, driver_phone, driver_address, driver_gender, client_username, driver_availability) VALUES ('$driver_name', '$dl_number', '$driver_phone', '$driver_address', '$driver_gender', '$client_username', '$driver_availability')";

    // Exécuter la requête
    $success = $conn->query($query);

    if (!$success) {
        // Vérifier si l'échec est dû à une clé dupliquée (dl_number)
        if ($conn->errno == 1062) {
            $error_message = "Erreur : Le numéro de permis de conduire est déjà enregistré.";
        } else {
            $error_message = "Erreur lors de l'ajout du conducteur : " . $conn->error;
        }
    } else {
        // Insertion réussie, rediriger vers enterdriver1.php
        header("Location: enterdriver1.php");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    }
}

// Récupérer et afficher la liste des conducteurs
$user_check = $_SESSION['login_ouvrier'];
$sql = "SELECT * FROM driver WHERE client_username='$user_check' ORDER BY driver_name";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un conducteur | CarLoc</title>
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
    <?php include 'navbar.php'; ?>

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;">Ajouter un nouveau conducteur</h3>
                    <?php if (!empty($error_message)) { ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Nom du conducteur" required autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="dl_number" name="dl_number" placeholder="Numéro de permis de conduire" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="driver_phone" name="driver_phone" placeholder="Contact" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="driver_address" name="driver_address" placeholder="Adresse" required>
                    </div>
                    <div class="form-group col-md-3" style="margin-left:-12px">
                        <select class="form-control" id="driver_gender" name="driver_gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">Ajouter un conducteur</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 30px;">
        <h3 style="color: blue; text-align: center;">Mes Conducteurs</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom du conducteur</th>
                        <th>Numéro de permis de conduire</th>
                        <th>Contact</th>
                        <th>Adresse</th>
                        <th>Sexe</th>
                        <th>Disponibilité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['driver_name'] . "</td>";
                            echo "<td>" . $row['dl_number'] . "</td>";
                            echo "<td>" . $row['driver_phone'] . "</td>";
                            echo "<td>" . $row['driver_address'] . "</td>";
                            echo "<td>" . $row['driver_gender'] . "</td>";
                            echo "<td>" . $row['driver_availability'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Aucun conducteur disponible</td></tr>";
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

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
