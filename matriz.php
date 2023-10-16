<?php
require_once './conexao.php';


    // Consulta para buscar dados do banco de dados
    $sSelect = "SELECT
    ao.aer_sigla AS origem,
    ad.aer_sigla AS destino,
    MIN(tc.cus_valor) AS menor_custo
FROM
    tbcusto AS tc
JOIN
    tbaeroporto AS ao ON tc.aer_id_ori = ao.aer_id
JOIN
    tbaeroporto AS ad ON tc.aer_id_des = ad.aer_id
GROUP BY
    ao.aer_sigla, ad.aer_sigla";
    $result = pg_query($oConexao, $sSelect);

    // Verifica se há resultados
    if ($result) {
        // Inicializa uma matriz para armazenar os dados
        $matriz = array();

        // Itera pelos resultados e adiciona os dados à matriz
        while ($row = pg_fetch_assoc($result)) {
            $matriz[] = $row;
        }

        // Fecha o resultado
        pg_free_result($result);

        // Agora, $matriz contém os dados do banco de dados na forma de uma matriz associativa
       // print_r($matriz);

    } else {
        echo "Nenhum resultado encontrado.";
    }





