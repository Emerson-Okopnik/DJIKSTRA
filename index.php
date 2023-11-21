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
//Definir limite de memoria como 1gb
ini_set('memory_limit', '3G');
set_time_limit(0);
  
require_once('djikstra.php');
          
   
  $Json = file_get_contents('aeroportos.json');

  $aAeroportos = json_decode($Json,true);

  if(isset($_POST['origem']) && isset($_POST['destino'])){
    if($_POST['origem'] === 'Escolha...' || $_POST['destino'] === 'Escolha...'){
      echo "<p> Informe valores válidos </p>";
    } else {
        $aPontos = [];
          foreach ($aAeroportos as $aAeroporto) {
            $oPonto = [
              'aeroporto' => $aAeroporto['aeroporto'],
              'vertice' => []
            ];
            $aConexoes = [];
            foreach ($aAeroporto['vertice'] as $aConexao) {
              $oConexao = [
                'aeroporto' => $aConexao['aeroporto'],
                'custo' => $aConexao['custo']
              ];
              array_push($aConexoes, $oConexao);
            }
            $oPonto['vertice'] = $aConexoes;
            $aPontos[$oPonto['aeroporto']] = $oPonto;
        } 

        $oDjikstra = new djikstra($aPontos, $_POST['origem'], $_POST['destino']);
        $oDjikstra->calcularCaminhos();
        $aCaminhosValidos = $oDjikstra->caminhosValidos ();

        usort($aCaminhosValidos, function($a, $b) {
        return $a['distancia'] <=> $b['distancia'];
        });
    
      echo 'Total de caminho: ' . count($aCaminhosValidos). '<br>';

      $aMelhoresRotas = array_slice($aCaminhosValidos, 0, 5000);

      $num = 0;
      echo "<div class='tabela-result'>";
        echo "<table class='table table-striped table-bordered table-sm' id='tabela'>";
          echo "<thead>"; 
            echo "<tr>";
            echo "<th scope='col'> Rota </th>";
            echo "<th scope='col'> Caminho </th>";
            echo "<th scope='col'> Valor </th>";
            echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          foreach ($aMelhoresRotas as $valor) {
          $num += 1;  
          echo "<tr>";
            echo "<td scope='row'>".$num."</td>";
              echo "<td>".substr($valor['sequencia'], 1) . "</td>";
              echo "<td>".$valor['distancia']."</td>";
            echo "</tr>";
        }  
          echo "</tbody>";  
        echo "</table>";
      echo "</div>";
    }  
}

if(!isset($_POST['origem']) && !isset($_POST['destino'])){
  echo" <form action='index.php' method='post'>";

  //origem  

    echo "<select name='origem'>";
    echo " <option>Escolha...</option>";

    foreach ($aAeroportos as $registro) {
      echo "<option>{$registro['aeroporto']}</option>";
    }  
    echo "</select>";

    //destino    

    echo "<select name='destino'>";
    echo " <option>Escolha...</option>";

    foreach ($aAeroportos as $registro) {
      echo "<option>{$registro['aeroporto']}</option>";
    }
    echo "</select>";
    
      echo '<input type="submit" value="Enviar">';
  echo "</form>";
}
?>
</body>
</html> 