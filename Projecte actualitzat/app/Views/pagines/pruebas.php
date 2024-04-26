<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<? base_url("css/style.css") ?>">
</head>
<body>
<div class="mt-3">
  <?php if ($config['multidelete'] || ($config['deletepermanent'] && $config['useSoftDeletes'])) : ?>
    <form method="post" id="list_form" name="list_form" action="<?= base_url($_route) ?>">
      <?= csrf_field(); ?>

    </form>
  <?php endif; ?>


  <table class="table table-striped row-border" id="data-list-<?= $_table ?>" style="width:100%">
    <thead>
      <tr>
        <?php
        if ($config['numerate']) echo "<th>" . lang('crud.colHeadNitem') . "</th>";

        foreach ($_data_header as $dbname) {
          $colname = $_data_columns[$dbname]['name'] ?? ucfirst($dbname);
          echo "<th>" . $colname . "</th>";
        }
        if ($config['show_button'] || $config['editable'] || $config['removable'] || count($_arrItemFunctions) > 0)
          echo '<th>&nbsp;</th>';
        ?>
      </tr>
    </thead>
    <tbody>


      <?php if ($data) : ?>
        <?php
        $nRow = 1;
        foreach ($data as $row) :

          foreach ($primaryKey as $key) {
            $rowID[$key] = $row[$key];
          }
        ?>
          <tr id='item-<?= $nRow ?>' data-kpc-id='<?= json_encode($rowID) ?>'>
            <?php
            if ($config['numerate']) echo "<td>" . $nRow . "</td>";

            foreach ($_data_header as $dbname) {
              if (($_data_columns[$dbname]['type'] ?? '') == 'checkbox') {
                if ($row[$dbname] == ($_data_columns[$dbname]['check_value'] ?? ''))
                  echo "<td><span class='fas fa-check-square'></span></td>";
                else
                  echo "<td><span class='far fa-square'></span></td>";
              } else {
                echo "<td>" . $row[$dbname] . "</td>";
              }
            }
            $idQuery = "";
            foreach ($primaryKey as $key) {
              $idQuery .= "&" . str_rot13($key) . "=" . str_rot13($row[$key]);
            }

            if ($config['show_button'] || $config['editable'] || $config['removable'] || count($_arrItemFunctions) > 0) echo "<td>";

            if ($config['show_button']) {
              echo "<a href='" . base_url($_route . '?view=item' . $idQuery) . "' class='btn btn-sm text-info' title='" . lang('crud.help.btnShowItem') . "'><i class='fa-solid fa-eye'></i></a>" . PHP_EOL;
            }

            if ($config['editable'] || $config['removable']) {
              if ($config['editable'])
                echo "<a href='" . base_url($_route . '?edit=item' . $idQuery) . "' class='btn btn-sm text-primary' title='" . lang('crud.help.btnEditItem') . "'><i class='fa-solid fa-pen'></i></a>" . PHP_EOL;
              if ($config['removable'])
                echo "<a href='" . base_url($_route . '?del=item' . $idQuery) . "' class='btn  btn-sm text-danger' title='" . lang('crud.help.btnDelItem') . "'><i class='fa-solid fa-trash'></i></a>" . PHP_EOL;
            }

            if (count($_arrItemFunctions) > 0) {

              foreach ($_arrItemFunctions as $name => $itemFunc) {

                if ($itemFunc['visible']) {
                  if ($itemFunc['type'] == 'callback') {
                    echo "<a href='" . base_url($_route . '?customf=' . $name . $idQuery);
                    echo "' class='btn  btn-sm text-primary' title='" . $itemFunc['description'];
                    echo "'><i class='fa-solid " . $itemFunc['icon'] . "'></i></a>" . PHP_EOL;
                  } else { //type == 'link
                    $urlID = "";
                    foreach ($primaryKey as $key) {
                      if (is_array($itemFunc['func'])) {
                        if ($itemFunc['func'][1] == 'hash')   //FIXED: hash with multiple keys
                          $urlID .= "/" . md5($row[$key]);
                        else
                          $urlID .= "/" . $row[$key];
                      } else
                        $urlID .= "/" . $row[$key];
                    }
                    if (is_array($itemFunc['func']))
                      echo "<a href='" . $itemFunc['func'][0] . $urlID;
                    else
                      echo "<a href='" . $itemFunc['func'] . $urlID;

                    echo "' class='btn  btn-sm text-primary' title='" . $itemFunc['description'];
                    echo "'><i class='fa-solid " . $itemFunc['icon'] . "'></i></a>" . PHP_EOL;
                  }
                }
              }
            }

            if ($config['show_button'] || $config['editable'] || $config['removable'] || count($_arrItemFunctions) > 0) echo "</td>";
            $nRow++;
            ?>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

    </tbody>
  </table>
</div>
</body>
</html>

