<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Login-->
    <link rel="stylesheet" href="Assets/css/login.css">
    <!-- CSS Boostrap 4-->
    <link rel="stylesheet" href="Assets/css/main.css">
  
    <title>Inicio de sesión</title>

     
     

</head>
<body>

    <div class="container-all">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="col-lg-6">
                                <div class="ctn-text">
                                    <!-- <div class="capa">
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-5">
                            <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">¡Bienvenido a la Biblioteca Infocenter!</h1>
                        </div> 
                        <br>
                        
                        <form action="login_procesar.php" method="post">

                            <div class="form-group">
                               <label for="email">Email</label>
                                <input type="email" name="email"   required> 
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input type="password" name="clave"  required> 
                            </div>
                            <br>
                            <input type="submit" value="Iniciar sesión" class="btn btn-primary btn-user btn-block">
                            <hr>
                            <div class="text-center">
                                <span class="text-footer">¿Aún no te has registrado?
                                <a href="registro.php">Registrate</a>
                                </span>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>  
        </div>
    </div> 
   

</body>
 <!--jQuery boostrap 5-->
 <script src="Assets/bootstrap5/js/bootstrap.bundle.min.js"></script> 

</html>