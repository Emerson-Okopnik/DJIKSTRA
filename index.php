<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>DJIKSTRA</title>
</head>
<body>
    <?php
      include './conexao.php';
      require_once './matriz.php';
      require_once './djikstra.php';
          
    $sSelect = "SELECT ao.aer_nome AS origem,
                       ad.aer_nome AS destino,
                       MIN(tc.cus_valor) AS custo
                  FROM tbcusto AS tc
                  JOIN tbaeroporto AS ao ON 
                       tc.aer_id_ori = ao.aer_id
                  JOIN tbaeroporto AS ad ON 
                       tc.aer_id_des = ad.aer_id
                 GROUP BY origem, destino";


    /*foreach ($aResults as $aResult) {
      $novoPontoAeroporto = new PontoAeroporto();
      $novoPontoAeroporto->id = '';
      
    }*/
    

    if(isset($_POST['origem']) && isset($_POST['destino'])){
  
      $inicio = $_POST['origem'];
      $fim = $_POST['destino'];

      $oMatriz = new  MatrizCusto;
      $oMatriz->CriaMatriz($oConexao,$sSelect);


      $dijkstra = new Dijkstra($oMatriz->getMatriz());

      $path = $dijkstra->Caminhos_Possiveis($inicio, $fim);

      

    }

    $oResult = pg_query($oConexao,$sSelect);
    $array = []; 

    $oResult2 = pg_query($oConexao,$sSelect);
    $array2 = [];
    

  echo" <form action='index.php' method='post'>";
  //origem  

    echo "<select name='origem'>";
    echo " <option>Escolha...</option>";

    while($aResult = pg_fetch_assoc($oResult)) {
      $array = $aResult;
      echo "<option>{$array['origem']}</option>";
    }  
    echo "</select>";

    //destino    
  
    echo "<select name='destino'>";
    echo " <option>Escolha...</option>";
  
    while($aResult2 = pg_fetch_assoc($oResult2)) {
      $array2 = $aResult2;
      echo "<option>{$array2['destino']}</option>";
    }  
      echo "</select>";
    
      echo '<input type="submit" value="Enviar">';
  echo "</form>";
?>

 
 <div>
    <img src="imagens/mapa_do_Brasil.svg.png" alt="Mapa do Brasil" width="800">
    <div class="aeroporto" style="left: 323px; top: 557px; background-color: rgb(213, 232, 212);"> RDSD</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);"> QEQEQ</div>
    <div class="ligacao" style="left: 289.5px; top: 456.5px; width: 289.5px; transform: rotate(71.37deg);"></div>
  </div>

<?php
  if(isset($_POST['origem']) && isset($_POST['destino'])){

    echo "<div class='container'>";
      echo "<table class='table table-striped table-bordered table-sm'>";
        echo "<thead>"; 
          echo "<tr>";
            echo "<th scope='col'> Rota </th>";
            echo "<th scope='col'> Caminho </th>";
            echo "<th scope='col'> Valor </th>";
          echo "</tr>";
        echo "</thead>";  
      $dijkstra->imprimirRotas($path);
      echo "</table>";
    echo "</div>";  
  }  
?>
</body>
</html> 