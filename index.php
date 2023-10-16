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
    ?>

  <h1>Matriz de Custos</h1>
  <table border="1">
    <tr>
      <th></th> <!-- Cabeçalho vazio no canto superior esquerdo -->
  <?php
    $destinos = array_unique(array_column($matriz, 'destino'));
    foreach ($destinos as $destino) {
        echo "<th>$destino</th>";
    }
  ?>
    </tr>

  <?php
  // Loop para criar as linhas da matriz
  foreach ($matriz as $origemCusto) {
      $origem = $origemCusto['origem'];
      echo "<tr>";
      echo "<td>$origem</td>"; // Cabeçalho com origem
      foreach ($destinos as $destino) {
        $custo = '';
        // Procura o custo correspondente na matriz
        foreach ($matriz as $custoItem) {
            if ($custoItem['origem'] == $origem && $custoItem['destino'] == $destino) {
                $custo = $custoItem['menor_custo'];
                break;
            }
        }
        echo "<td>$custo</td>";
    }
    echo "</tr>";
  }
  ?>
        
  </table>
</body>
</html>