<?php
class Dijkstra
{
    private $grafico;

    public function __construct($grafico)
    {
        $this->grafico = $grafico;
    }

    public function Caminho_Curto($inicio, $fim)
    {
        $distancias = [];
        $anterior = [];
        $nao_visitado = [];

        foreach ($this->grafico as $edge) {
            $distancias[$edge['origem']] = INF;
            $distancias[$edge['destino']] = INF;
            $anterior[$edge['origem']] = null;
            $anterior[$edge['destino']] = null;
            $nao_visitado[] = $edge['origem'];
            $nao_visitado[] = $edge['destino'];
        }

        $distancias[$inicio] = 0;

        while (!empty($nao_visitado)) {
            $minDistancia = INF;
            $atual = null;

            foreach ($nao_visitado as $vertice) {
                if ($distancias[$vertice] < $minDistancia) {
                    $minDistancia = $distancias[$vertice];
                    $atual = $vertice;
                }
            }

            if ($atual === null) {
                break;
            }

            $key = array_search($atual, $nao_visitado);
            if ($key !== false) {
                unset($nao_visitado[$key]);
            }

            foreach ($this->grafico as $edge) {
                if ($edge['origem'] == $atual) {
                    $alt = $distancias[$atual] + $edge['custo'];
                    if ($alt < $distancias[$edge['destino']]) {
                        $distancias[$edge['destino']] = $alt;
                        $anterior[$edge['destino']] = $atual;
                    }
                }
            }
        }

        $path = [];
        $atual = $fim;

        while ($anterior[$atual] !== null) {
            $path[] = $atual;
            $atual = $anterior[$atual];
        }

        $path[] = $inicio;
        $path = array_reverse($path);

        return $path;
    }
}


