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
          
    // Consulta para buscar dados do banco de dados
    $sSelect = "SELECT ao.aer_sigla AS origem,
                       ad.aer_sigla AS destino,
                       MIN(tc.cus_valor) AS custo
                  FROM tbcusto AS tc
                  JOIN tbaeroporto AS ao ON 
                       tc.aer_id_ori = ao.aer_id
                  JOIN tbaeroporto AS ad ON 
                       tc.aer_id_des = ad.aer_id
                 GROUP BY ao.aer_sigla, ad.aer_sigla";
     
    $oMatriz = new  MatrizCusto;
    $oMatriz->CriaMatriz($oConexao,$sSelect);
   // echo print_r($oMatriz->getMatriz());



// Exemplo de uso


$dijkstra = new Dijkstra($oMatriz->getMatriz());
$inicio = 'RO';
$fim = 'AP';

$path = $dijkstra->Caminho_Curto($inicio, $fim);

echo "Caminho mais curto de $inicio para $fim: " . implode(' -> ', $path) . PHP_EOL;
?>
</body>
</html>