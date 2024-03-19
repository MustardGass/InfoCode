<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"> </script> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"> 
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

  <div class="container-fluid">
    <div class="row ">
      <!-- MENÚ VERTICAL ESQUERRA -->
      <nav class="col-md-2 position-fixed left-0 menuEsquerra h-100">
        <ul class="nav flex-column">
          <li class="nav-item mt-3">
            <a class="nav-link text-white" href="#"> <img src=<?= base_url('img/iconMenuRosca.png');?> alt="Logo"
                style="max-height: 30px;"> Reparacions</a>
          </li>
        </ul>
      </nav>

      <!-- CONTINGUT DE LA WEB -->
      <div class="col-md-9 offset-md-2 mt-3">
        <h1>Reparacions</h1>

        <nav class="navbar navbar-light">
          <form class="form-inline">
            <input class="form-control mr-sm-2 border border-primary rounded-pill" type="search" placeholder="Cerca..."
              aria-label="Search">
          </form>
        </nav>

        <div id="wrapper"> 
  
            <table  class="table" id="table_detail" cellpadding=10> 

            <?php if(!empty($alumnes) && is_array($alumnes)) : ?>
                  <?php foreach($alumnes as $alumne) : ?> 
                    <tr> 
                      <td scope="col"><?= esc($alumne['correu_alumne']) ?></td>
                    </tr>
                  <?php endforeach ?>
                   

            <?php endif ?>  
      
                <tr> 
                    <th scope="col"><input type="checkbox"/></th>
                    <th scope="col">CODI</th>
                    <th scope="col">SUPERVISOR</th>
                    <th scope="col">D. ENTRADA</th>
                    <th scope="col">D. SORTIDA</th>
                    <th scope="col">ESTAT</th>
                    <th scope="col"></th>
                </tr> 
      
                <tr onclick="showHideRow('hidden_row1');"> 
                    <td scope="col"><input type="checkbox"/></td>
                    <td scope="col">9358932861</td>
                    <td scope="col">Josep Maria Flix</td>
                    <td scope="col">10-01-2024</td>
                    <td scope="col">-</td>
                    <td scope="col">Actiu</td>
                    <td scope="col"></td>
                </tr> 
                <tr id="hidden_row1" class="hidden_row"> 
                    <td colspan=4> 
                        <div class="container">
                            <div class="row">
                              <div class="col">
                                <p><strong>Alumne assistent: </strong>Hug Francino</p>
                              </div>
                              <div class="col">
                                <p><strong>Descripció de l'equip: </strong>Portàtil marca msi</p>
                              </div>
                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Centre reparador: </strong>Institut Màrius Torres</p>
                                  </div>
                            </div>
                          </div>
                    </td> 
                </tr> 
      
                <tr onclick="showHideRow('hidden_row2');"> 
                    <td scope="col"><input type="checkbox"/></td>
                    <td scope="col">46137257135</td>
                    <td scope="col">Maria dels Àngels Cerveró</td>
                    <td scope="col">11-01-2024</td>
                    <td scope="col">-</td>
                    <td scope="col">Actiu</td>
                    <td scope="col"></td>
                </tr> 
                <tr id="hidden_row2" class="hidden_row"> 
                    <td colspan=4> 
                        <div class="container">
                            <div class="row">
                              <div class="col">
                                <p><strong>Alumne assistent: </strong>Hug Francino</p>
                              </div>
                              <div class="col">
                                <p><strong>Descripció de l'equip: </strong>Portàtil marca msi (un altre cop, quina mania)</p>
                              </div>
                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Centre reparador: </strong>Institut Caparrella</p>
                                  </div>
                            </div>
                          </div>
                    </td> 
                </tr> 


                <tr onclick="showHideRow('hidden_row3');"> 
                    <td scope="col"><input type="checkbox"/></td>
                    <td scope="col">123456894</td>
                    <td scope="col">Marc Iborra</td>
                    <td scope="col">19-01-2024</td>
                    <td scope="col">-</td>
                    <td scope="col">Actiu</td>
                    <td scope="col"></td>
                </tr> 
                <tr id="hidden_row3" class="hidden_row"> 
                    <td colspan=4> 
                        <div class="container">
                            <div class="row">
                              <div class="col">
                                <p><strong>Alumne assistent: </strong>Hug Francino</p>
                              </div>
                              <div class="col">
                                <p><strong>Descripció de l'equip: </strong>Portàtil marca ASUS (visca asus)</p>
                              </div>
                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Centre reparador: </strong>Institut Joan Oró</p>
                                  </div>
                            </div>
                          </div>
                    </td> 
                </tr> 


                <tr onclick="showHideRow('hidden_row4');"> 
                    <td scope="col"><input type="checkbox"/></td>
                    <td scope="col">1260864</td>
                    <td scope="col">Joan Gibal</td>
                    <td scope="col">14-01-2024</td>
                    <td scope="col">-</td>
                    <td scope="col">Actiu</td>
                    <td scope="col"></td>
                </tr> 
                <tr id="hidden_row4" class="hidden_row"> 
                    <td colspan=4> 
                        <div class="container">
                            <div class="row">
                              <div class="col">
                                <p><strong>Alumne assistent: </strong>Hug Francino</p>
                              </div>
                              <div class="col">
                                <p><strong>Descripció de l'equip: </strong>Portàtil marca msi</p>
                              </div>
                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Centre reparador: </strong>Portàtil marca msi</p>
                                  </div>
                            </div>
                          </div>
                    </td> 
                </tr>
            </table> 
        </div> 

      </div>
    </div>
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
