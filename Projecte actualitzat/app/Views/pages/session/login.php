<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-image: url("/img/fondo_login.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh; /* Ajusta la altura del cuerpo */
        }

        #img_logo {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Para que la imagen ocupe todo el espacio sin distorsionarse */
        }

        .text-center {
            color: #1B83BE;
        }

        #btn_accedir {
            background-color: #1B83BE;
            color: white;
            width: 100%; /* Cambia el ancho al 100% */
        }
        
    </style>
</head>
<body class="m-8">
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-6" style="background-color: white; padding: 20px; border-radius: 10px;">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= base_url('img/loginRegistre_img.jpg');?>" id="img_logo" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h3 class="text-center mt-5">LOGIN</h3>
                    
                    <form action="<?=base_url('/login')?>" class="mt-5" method="POST">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="idioma">Idioma</label>
                            <select class="form-select" id="idioma" name="idioma">
                                <option value="ca">Català</option>
                                <option value="es">Castellà</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="usuari" class="form-label">Usuari</label>
                            <input type="text" class="form-control mb-4"  name="usuari">
                        </div>
                        <div class="mb-4">
                            <label for="contrasenya" class="form-label">Contrasenya</label>
                            <input type="password" class="form-control mb-4"  name="contrasenya">
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="recordar_usuari">
                            <label class="form-check-label" for="recordar_usuari">Recordar usuari</label>
                        </div>
                        <input type="submit" class="btn" id="btn_accedir">Iniciar Sessió</input>
                        <div class="mt-3 text-center">
                            <a href="#" class="text-decoration-none">He oblidat la contrasenya</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
