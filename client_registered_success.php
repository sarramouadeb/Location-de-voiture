<html>

<head>
    <title>Client Signup | CarLoc</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>

    <!-- Navigation -->
    <?php include 'navbar.php'; ?>

    <?php
    require 'connection.php';
    $conn = Connect();

    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $customer_username = $conn->real_escape_string($_POST['customer_username']);
    $customer_email = $conn->real_escape_string($_POST['customer_email']);
    $customer_phone = $conn->real_escape_string($_POST['customer_phone']);
    $customer_address = $conn->real_escape_string($_POST['customer_address']);
    $customer_password = $conn->real_escape_string($_POST['customer_password']);

    $query = "INSERT INTO customers(customer_name, customer_username, customer_email, customer_phone, customer_address, customer_password) VALUES('" . $customer_name . "','" . $customer_username . "','" . $customer_email . "','" . $customer_phone . "','" . $customer_address . "','" . $customer_password . "')";
    $success = $conn->query($query);

    if (!$success) {
        die("Couldn't enter data: " . $conn->error);
    }

    $conn->close();
    ?>

    <div class="container">
        <div class="jumbotron" style="text-align: center;">
            <h3><?php echo "Bienvenue $customer_name !" ?></h3>
            <h2 style="color:green;">Votre compte a été créé.</h2>
            <p>Connectez-vous maintenant <a href="clientlogin.php" style="color:blue;">ICI</a></p>
        </div>
    </div>

    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
            <div style="margin-left:600px">
                <h5>© <?php echo date("Y"); ?> CarLoc</h5>
            </div>
            </div>
        </div>
    </footer>
</body>

</html>
