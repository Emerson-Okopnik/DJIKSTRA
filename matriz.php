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

        if ($result) {
            $matriz = array();
    
            while ($row = pg_fetch_assoc($result)) {
                $matriz[] = $row;
            }
            
            pg_free_result($result);
    

            $this->setMatriz($matriz);
    
        } else {
            echo "Nenhum resultado encontrado.";
        }
    }
}

?>


