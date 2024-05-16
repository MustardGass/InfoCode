<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
                    <img src="<?= base_url('img/loginRegistre_img.jpg'); ?>" id="img_logo" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h3 class="text-center mt-2">REGISTRE</h3>
                    <form action="<?= base_url('registre') ?>" method="POST">
                        <div>
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control mb-4" />
                        </div>
                        <div class="mb-4">
                            <label for="apellido" class="form-label">Cognoms</label>
                            <input type="text" name="apellido" id="apellido" class="form-control mb-4" />
                        </div>
                        <div class="mb-4">
                            <label for="correu_xtec" class="form-label">Correu xtec</label>
                            <input type="email" name="correu_xtec" id="correu_xtec" class="form-control mb-4"/>
                        </div>
                        <div class="mb-4">
                            <label for="correu" class="form-label">Correu</label>
                            <input type="email" name="correu" id="correu" class="form-control mb-4"/>
                        </div>
                        <div class="mb-4">
                            <label for="contrasenya" class="form-label">Contrasenya</label>
                            <input type="password" name="contrasenya" id="contrasenya" class="form-control mb-4" />
                        </div>

                        <label for="centre">Centre</label>
                        <select name="centre" id="centre" style="width: 250px; margin-bottom: 20px;">
                            <?php foreach($centre_profe as $centre) : ?>
                                <option value="<?= $centre['codi_centre'] ?>"><?= $centre['nom'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit" class="btn" id="btn_accedir">Registrar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>