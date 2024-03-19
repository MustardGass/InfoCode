<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"> </script> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"> 
    <title>Alumnes</title>

    <style> 
    #wrapper { 
        margin: 0 auto; 
        padding: 0px; 
        text-align: center; 
    } 

    #wrapper h1 { 
        margin-top: 50px; 
        font-size: 45px; 
        color: #585858; 
    } 

    #wrapper h1 p { 
        font-size: 20px; 
    } 

    #table_detail { 
        max-width: 100%;
        text-align: left; 
        border-collapse: collapse; 
        color: #2E2E2E; 
    } 

    #table_detail tr:hover { 
        background-color: #000000; 
    } 

    #table_detail .hidden_row { 
        display: none; 
        max-width: 100%;
    } 

    .headerColor{
    background-color: #005187;
    }

    .menuEsquerra{
    background-color: #344450;
    }
</style> 

</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light headerColor ">
    <div class="container-fluid">
      <a> <img src=<?= base_url('img/logo.png');?> alt="Logo" style="max-height: 50px;"> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="#">Serveis Territorials</a>
          </li>
        </ul>
        <div class="d-flex">
          <li class="nav-item dropdown d-flex ">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <img src=<?= base_url('img/user.png');?> alt="User" style="max-height: 30px;">
              Usuari d'exemple
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Opció 1</a></li>
              <li><a class="dropdown-item" href="#">Opció 2</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Desconnectar</a></li>
            </ul>
          </li>
        </div>
      </div>
    </div>
  </nav>


</body>
</html>