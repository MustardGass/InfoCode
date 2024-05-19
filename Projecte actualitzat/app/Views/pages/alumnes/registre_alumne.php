<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre Alumne</title>
</head>
<body>
    <h1>Registre Alumne</h1>

    <form action="<?= base_url('pagina/registreAlumne') ?>" method="POST">
        <div>
            <label for="correu">Usuari</label>
            <input type="email" name="correu" id="correu">
        </div>

        <div>
            <label for="contrasenya">Contrasenya</label>
            <input type="password" name="contrasenya" id="contrasenya">
        </div>

        <label for="centre">Centre</label>
        <select name="centre" id="centre">
            <?php foreach($centre_alumne as $centre_a) : ?>
                <option value="<?= $centre_a['codi_centre'] ?>"><?= $centre_a['nom'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" id="btn_accedir">Registrar</button>
    </form>
</body>
</html>