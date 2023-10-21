<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DJIKSTRA</title>
</head>
<body>
    <?php
      require_once './conexao.php';
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


    foreach ($aResults as $aResult) {
      $novoPontoAeroporto = new PontoAeroporto();
      $novoPontoAeroporto->id = '';
      
    }
    
    
    if(isset($_POST['origem']) && isset($_POST['destino'])){
  
      $inicio = $_POST['origem'];
      $fim = $_POST['destino'];

      $oMatriz = new  MatrizCusto;
      $oMatriz->CriaMatriz($oConexao,$sSelect);


      $dijkstra = new Dijkstra($oMatriz->getMatriz());

      $path = $dijkstra->Caminhos_Possiveis($inicio, $fim);

      $dijkstra->imprimirRotas($path);

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


</body>
</html>