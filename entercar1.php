<?php
session_start();
require 'connection.php';
$conn = Connect();

// Fonction pour obtenir l'extension de l'image
function GetImageExtension($imagetype) {
    if (empty($imagetype)) return false;
    
    switch ($imagetype) {
        case 'assets/img/cars/bmp': return '.bmp';
        case 'assets/img/cars/gif': return '.gif';
        case 'assets/img/cars/jpeg': return '.jpg';
        case 'assets/img/cars/png': return '.png';
        default: return false;
    }
}

// Vérifier si les données du formulaire sont présentes
if (isset($_POST['car_name']) && isset($_POST['car_nameplate']) && isset($_POST['ac_price']) && isset($_POST['non_ac_price']) && isset($_POST['ac_price_per_day']) && isset($_POST['non_ac_price_per_day'])) {
    $car_name = $conn->real_escape_string($_POST['car_name']);
    $car_nameplate = $conn->real_escape_string($_POST['car_nameplate']);
    $ac_price = $conn->real_escape_string($_POST['ac_price']);
    $non_ac_price = $conn->real_escape_string($_POST['non_ac_price']);
    $ac_price_per_day = $conn->real_escape_string($_POST['ac_price_per_day']);
    $non_ac_price_per_day = $conn->real_escape_string($_POST['non_ac_price_per_day']);
    $car_availability = "yes";

    // Vérifier si le numéro de plaque d'immatriculation existe déjà
    $query_check = "SELECT * FROM cars WHERE car_nameplate = '$car_nameplate'";
    $result_check = $conn->query($query_check);

    if ($result_check->num_rows > 0) {
        // Le numéro de plaque d'immatriculation existe déjà, afficher un message d'erreur
        $error_message = "Une voiture avec ce numéro de plaque d'immatriculation existe déjà.";
    } else {
        // Insertion de la nouvelle voiture dans la table 'cars'
        if (!empty($_FILES["uploadedimage"]["name"])) {
            $file_name = $_FILES["uploadedimage"]["name"];
            $temp_name = $_FILES["uploadedimage"]["tmp_name"];
            $imgtype = $_FILES["uploadedimage"]["type"];
            $imagename = $_FILES["uploadedimage"]["name"];
            $target_path = "assets/img/cars/" . $imagename;

            if (move_uploaded_file($temp_name, $target_path)) {
                $query = "INSERT INTO cars (car_name, car_nameplate, car_img, ac_price, non_ac_price, ac_price_per_day, non_ac_price_per_day, car_availability) VALUES ('$car_name', '$car_nameplate', '$target_path', '$ac_price', '$non_ac_price', '$ac_price_per_day', '$non_ac_price_per_day', '$car_availability')";

                try {
                    if ($conn->query($query)) {
                        $car_id = $conn->insert_id;
                        $query2 = "INSERT INTO clientcars (car_id, client_username) VALUES ('$car_id', '" . $_SESSION['login_ouvrier'] . "')";
                        if (!$conn->query($query2)) {
                            throw new Exception("Erreur lors de l'attribution de la voiture au client.");
                        } else {
                            header("location: entercar.php"); // Redirection après insertion réussie
                            exit();
                        }
                    } else {
                        throw new Exception("Erreur lors de l'insertion dans la table cars.");
                    }
                } catch (Exception $e) {
                    $error_message = $e->getMessage();
                }
            }
        }
    }}

?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Navigation -->
    <?php include "navbar.php"; ?>

    <div class="container">
        <div class="jumbotron" style="text-align: center; color:red;">
            <?php if (isset($error_message)) { ?>
                <p><?php echo $error_message; ?></p>
                <br><br>
                <a href="entercar.php" class="btn btn-default">Retour</a>
            <?php } else { ?>
                <p style="color:green;">Voiture ajoutée avec succès !</p>
                <br><br>
                <a href="entercar.php" class="btn btn-default">Ajouter une autre voiture</a>
            <?php } ?>
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

<?php
$conn->close();
?>
