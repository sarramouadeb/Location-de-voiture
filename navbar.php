<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navigation avec Dropdown Bootstrap (JavaScript natif)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-custom" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="index.php" class="logo" style="text-decoration: none;">Car<span>Loc</span></a>
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <?php if (isset($_SESSION['login_ouvrier'])) : ?>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Bienvenue <?php echo $_SESSION['login_ouvrier']; ?></a></li>
                        <li class="dropdown" id="controlPanelDropdown">
                            <a href="#" class="dropdown-toggle" onclick="toggleDropdown('controlPanelDropdown')">
                                <span class="glyphicon glyphicon-user"></span> Panneau de contrôle <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="entercar.php">Ajout Voiture</a></li>
                                <li><a href="enterdriver.php">Ajout Conducteur</a></li>

                            </ul>
                        </li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <?php elseif (isset($_SESSION['login_client'])) : ?>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Bienvenue <?php echo $_SESSION['login_client']; ?></a></li>
                        <li class="dropdown" id="controlPanelDropdown">
                            <a href="#" class="dropdown-toggle" onclick="toggleDropdown('controlPanelDropdown')">
                                <span class="glyphicon glyphicon-user"></span> Panneau de contrôle <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="prereturncar.php">Retourner Maintenant</a></li>
                                <li><a href="mybookings.php">Mes Réservations</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <?php else : ?>
                        <li><a href="ouvrierlogin.php">Ouvrier</a></li>
                        <li><a href="clientlogin.php">Client</a></li>
                      
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

    <!-- Inclure seulement Bootstrap JS (sans jQuery) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        function toggleDropdown(elementId) {
            var dropdown = document.getElementById(elementId);
            dropdown.classList.toggle('open');
        }
    </script>

</body>

</html>
