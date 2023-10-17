<?php require_once './conexao.php';

class MatrizCusto {
    private $matriz;

    public function getMatriz(){
        return $this->matriz;
    }

    public function setMatriz($matriz){
        $this->matriz = $matriz;
    }

    public  function CriaMatriz($oConexao,$sSelect){
       
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
            $this->setMatriz($matriz);
    
        } else {
            echo "Nenhum resultado encontrado.";
        }
    }
}

?>


