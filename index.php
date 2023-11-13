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

  require_once('djikstra.php');
          
   
  $Json = file_get_contents('aeroportos.json');

  $aAeroportos = json_decode($Json,true);

  //if(isset($_POST['origem']) && isset($_POST['destino'])){

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

    $oDjikstra = new djikstra($aPontos, 'Aeroporto de Campina Grande', 'Aeroporto de Campo de Marte');
    $oDjikstra->calcularCaminhos();
    $aCaminhosValidos = $oDjikstra->caminhosValidos  ();

    usort($aCaminhosValidos, function($a, $b) {
    return $a['distancia'] <=> $b['distancia'];
  });

  echo 'Total de caminho: ' . count($aCaminhosValidos). '<br>';

  $aPrincipaisCaminhos = array_slice($aCaminhosValidos, 0, 2000);

  $num = 0  ;

  echo "<table class='table table-striped table-bordered table-sm'>";
    echo "<thead>"; 
      echo "<tr>";
      echo "<th scope='col'> Rota </th>";
      echo "<th scope='col'> Caminho </th>";
      echo "<th scope='col'> Valor </th>";
      echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
  foreach ( $aCaminhosValidos as $valor) {
    $num += 1;  
    echo "<tr>";
      echo "<td scope='row'>".$num."</td>";
        echo "<td>".substr($valor['sequencia'], 1) . "</td>";
        echo "<td>".$valor['distancia']."</td>";
      echo "</tr>";
  }    
    echo "</tbody>";  
  echo "</table>";
//}


/*echo" <form action='index.php' method='post'>";

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
echo "</form>";*/

?>

 
<!-- <div style="position:relative;">
    <img src="https://www.infoescola.com/wp-content/uploads/2019/07/mapa-do-brasil-estados-branco-comlegenda.jpg" alt="Mapa do Brasil" width="800">
    <div class="aeroporto" style="left: 370px; top: 537px; background-color: rgb(213, 232, 212);">DF</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">MT</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">GO2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">MS</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">GO1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">CE1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">PE1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">BA1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">CE2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">RN</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">SE</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">BA2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">AL</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">PI</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">MA</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">PE2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">PB</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">PA</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">AC</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">RO</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">RR</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">AP</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">AM</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">TO</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">SP1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">SP2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">SP5</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">RJ3</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">SP4</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">RJ2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">MG1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">MG3</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">ES</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">SP3</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">RJ1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">MG2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">PR1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">SC1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">SC2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">RS1</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">RS2</div>
    <div class="aeroporto" style="left: 256px; top: 356px; background-color: rgb(200, 232, 278);">PR2</div>


    <div class="ligacao" style="left: 289.5px; top: 456.5px; width: 289.5px; transform: rotate(71.37deg);"></div>
  </div> -->
</body>
</html> 