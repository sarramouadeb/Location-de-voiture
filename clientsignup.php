<?php 
include 'header.php'?>

<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">

    <title> ouvrier Signup | CarLoc  </title>
    </head>
<body>
     <!-- Navigation -->
   <?php include ('navbar.php');?>

    <div class="login-container">
        <div class="jumbotron">
            <h1 class="text-center">Inscription Client </h1>
        </div>
    </div>

            <div class="panel panel-primary">
                
                <div class="panel-body">

                    <form role="form" action="client_registered_success.php" method="POST">

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_name"><span class="text-danger" style="margin-right: 5px;"><b>*</span> Nom Complet:</b> </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_name" type="text" name="customer_name" placeholder="Your Full Name" required="" autofocus="">
                                   
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_username"><span class="text-danger" style="margin-right: 5px;"><b>*</span> Nom utilisateur: </b></label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_username" type="text" name="customer_username" placeholder="Your Username" required="">
                       
                                  
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_email"><span class="text-danger" style="margin-right: 5px;"><b>*</span> Email: </b></label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_email" type="email" name="customer_email" placeholder="Email" required="">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_phone"><span class="text-danger" style="margin-right: 5px;"><b>*</span><b>Numero Téléphone:</b> </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_phone" type="text" name="customer_phone" placeholder="Phone" required="">
                                   

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_address"><span class="text-danger" style="margin-right: 5px;"><b>*</span> Addresse:</b> </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_address" type="text" name="customer_address" placeholder="Address" required="">
                                  
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_password"><span class="text-danger" style="margin-right: 5px;"><b>*</span> Mot de passe: </b></label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_password" type="password" name="customer_password" placeholder="Password" required="">
                       
                                </div>
                            </div>
                        </div>



                        
                                <button class="btn btn-primary" type="submit">Submit</button>
                          

                        </div>
                        
                        <label style="margin-left: 280px;">or</label> <br>
                        <label style="margin-left: 150px; " class="submit"><a href="clientlogin.php" style="color:blue;">Vous avez déjà un compte? Se connecter</a></label>
                     
                    </form>

                </div>

            </div>

        </div>
    </div>
</body>
<footer class="site-footer">
        <div class="container">
            
            <div class="row">
            <div class="">
                    <h5><b>© <?php echo date("Y"); ?> CarLoc</b></h5>
                </div>
            </div>
        </div>
    </footer>

</html>