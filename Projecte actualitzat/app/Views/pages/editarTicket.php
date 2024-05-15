<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"> </script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  
  <link rel="stylesheet" href="<?= base_url("css/style.css") ?>">
  <title>Assignats</title>


  <script type="text/javascript">
    function showHideRow(row) {
      $("#" + row).toggle();
    } 
  </script>


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

    .headerColor {
      background-color: #005187;
    }

    .menuEsquerra {
      background-color: #344450;
    }
  </style>


</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light headerColor ">
    <div class="container-fluid">
      <a> <img src=<?= base_url('img/logo.png'); ?> alt="Logo" style="max-height: 50px;"> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page"
            href="<?= base_url('/pagina/TicketSSTT'); ?>"><?= lang('TicketProfessors.sstt_header'); ?></a>
          </li>
        </ul>
        <div class="d-flex">
          <li class="nav-item dropdown d-flex ">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <img src=<?= base_url('img/user.png'); ?> alt="User" style="max-height: 30px;">
              <?= lang('TicketProfessors.usuari'); ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#"><?= lang('TicketProfessors.opt1'); ?></a></li>
              <li><a class="dropdown-item" href="#"><?= lang('TicketProfessors.opt2'); ?></a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#"><?= lang('TicketProfessors.desconnectar'); ?></a></li>
            </ul>
          </li>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">

    <div class="row ">
      <!-- MENÚ VERTICAL ESQUERRA -->
      <div class="container-fluid ps-0">
        <div class="row flex-nowrap">
          <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
              <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start ms-0 text-start" id="menu">
                <li class="nav-item mt-3">
                  <a class="nav-link text-white" href="<?= base_url('/pagina/TicketSSTT'); ?>"> <img src=<?= base_url('img/iconMenuRosca.png'); ?> alt="Logo"
                      style="max-height: 30px;"><?= lang('TicketProfessors.reparacions_menu'); ?></a>
                </li>

                <li class="nav-item mt-3">
                  <a class="nav-link text-white" href="#"> <img src=<?= base_url('img/iconInventari.png'); ?> alt="Logo"
                      style="max-height: 30px;"><?= lang('TicketProfessors.inventari_menu'); ?></a>
                </li>
              </ul>
            </div>
          </div>


          <div class="col py-3">

            <div class="mt-3 mb-5">
              <h1><?= lang('TicketProfessors.titol_editarTicket');?></h1>
            </div>

            <!-- Mostrar los datos del ticket -->

            <form action="<?= base_url('pagina/'.$ticket.'/editar'); ?>" method="POST">
          
            <h3>ID Ticket</h3>
            <p><?= $ticket ?></p>

            <h3>Codi d'equip</h3>
            <input type="text" name="codi_equip" value="<?= $codi_equip ?>">

            <h3>Tipus de dispositiu</h3>
            <select name="t_dispositiu" id="t_dispositiu">
              <?php foreach($dispositiu as $t_dispositiu) : ?>
                  <option value="<?= $t_dispositiu['id_tipus'] ?>"><?= $t_dispositiu['tipus'] ?></option>
              <?php endforeach; ?>
            </select>

            <h3>Descripcio de la Avaria</h3>
            <!-- <input type="text" name="descripcio_avaria" value="<?= $descripcio_avaria ?>"></input> -->
            <textarea  name="descripcio_avaria" id="descripcio_avaria" rows="6" cols="50"><?= $descripcio_avaria ?></textarea>

            <h3>Centre Emissor</h3>
            
            <?php foreach($centre_emissor as $index => $centre) : ?>
              <input type="hidden" value="<?= $centre['nom'] ?>" id="nom<?= $index ?>">
              <input type="hidden" value="<?= $centre['codi_centre'] ?>" id="codi<?= $index ?>">
             <?php endforeach; ?>
            <input type="text" id="inputBuscar"  oninput="buscar('<?= $contable?>')"> 
            <input type="hidden" id="inputCodi" name="centreEmissor" >
            <div id="coincidencias" style="display: none;"></div> 
            <script>
           
            function buscar(contable) {
            var texto=document.getElementById("inputBuscar").value.replace(/\b\w/g, function(match) {
            return match.toUpperCase();
            });
            var coincidenciasEncontradas = 0;
            var divCoincidencias = document.getElementById("coincidencias");
            divCoincidencias.innerHTML = ""; 
            if (texto !== "") {
            for (var i = 0; i < contable && coincidenciasEncontradas < 8; i++) {
            var nombre = document.getElementById("nom" + i).value;
            var codigo = document.getElementById("codi" + i).value;
            if (nombre.includes(texto)) {
                var coincidenciaElemento = document.createElement("div");
                coincidenciaElemento.textContent = nombre;
                coincidenciaElemento.codigo=codigo;
                document.getElementById("inputCodi").value = codigo;
                divCoincidencias.appendChild(coincidenciaElemento);
                coincidenciasEncontradas++;
                coincidenciaElemento.addEventListener("click", function() {
                document.getElementById("inputCodi").value = this.codigo;
                document.getElementById("inputBuscar").value = this.textContent;
                divCoincidencias.style.display = "none";
                    });
                  }
                }
                divCoincidencias.style.display = "block";
                } else {
                divCoincidencias.style.display = "none";
                }
            }        
            </script>
          



            <button>Editar</button>

            </form>



          </div>


          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <script>
            function mostrarInformacion(id) {
              //Obtenim la info addicional
              var infoElement = document.getElementById('info-' + id);

              //Alterna etre dislay none i que el display sigui "true"
              if (infoElement.style.display === 'none' || infoElement.style.display === '') {
                //Si està ocult, mostrar
                infoElement.style.display = 'block';
              } else {
                // Si està visible, ocultar
                infoElement.style.display = 'none';
              }
            }
          </script>
</body>

</html>