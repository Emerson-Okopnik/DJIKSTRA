<?php

class Dijkstra
{
    private $grafico;

    public function __construct($grafico)
    {
        $this->grafico = $grafico;
    }


    public function Caminhos_Possiveis($inicio, $fim)
    {
        $distancias = [];
        $anterior = [];
        $nao_visitado = [];

        foreach ($this->grafico as $aeroporto) {
            $distancias[$aeroporto['origem']] = INF;
            $distancias[$aeroporto['destino']] = INF;
            $anterior[$aeroporto['origem']] = null;
            $anterior[$aeroporto['destino']] = null;
            $nao_visitado[] = $aeroporto['origem'];
            $nao_visitado[] = $aeroporto['destino'];
        }

        $distancias[$inicio] = 0;
        $caminhos = []; 

        $this->EncontrarCaminhos($inicio, $fim, $distancias, $anterior, $caminhos, []);

        // Ordenar os caminhos com base no custo total
        usort($caminhos, function ($a, $b) use ($distancias) {
            $custoA = 0;
            $custoB = 0;
            for ($i = 0; $i < count($a) - 1; $i++) {
                $origem = $a[$i];
                $destino = $a[$i + 1];
                foreach ($this->grafico as $aeroporto) {
                    if ($aeroporto['origem'] == $origem && $aeroporto['destino'] == $destino) {
                        $custoA += $aeroporto['custo'];
                        break;
                    }
                }
            }
            for ($i = 0; $i < count($b) - 1; $i++) {
                $origem = $b[$i];
                $destino = $b[$i + 1];
                foreach ($this->grafico as $aeroporto) {
                    if ($aeroporto['origem'] == $origem && $aeroporto['destino'] == $destino) {
                        $custoB += $aeroporto['custo'];
                        break;
                    }
                }
            }
            return $custoA - $custoB;
        });

        return $caminhos;
    }

    private function EncontrarCaminhos($atual, $fim, $distancias, $anterior, &$caminhos, $caminhoAtual)
    {
        $caminhoAtual[] = $atual;

        if ($atual === $fim) {
            $caminhos[] = $caminhoAtual;
        } else {
            foreach ($this->grafico as $aeroporto) {
                if ($aeroporto['origem'] == $atual && !in_array($aeroporto['destino'], $caminhoAtual)) {           //in_array procura um valor dentro do vetor
                    $alt = $distancias[$atual] + $aeroporto['custo'];
                    if ($alt <= $distancias[$aeroporto['destino']]) {
                        $distancias[$aeroporto['destino']] = $alt;
                        $anterior[$aeroporto['destino']] = $atual;
                        $this->EncontrarCaminhos($aeroporto['destino'], $fim, $distancias, $anterior, $caminhos, $caminhoAtual);
                    }
                }
            }
        }
    } 


    public function imprimirRotas($rotas) {

    echo "<tbody>";

    foreach ($rotas as $index => $rota) {
        $custoTotal = $this->calcularCustoTotal($rota);
        echo "<tr>";
        echo "<th scope='row'>" . ($index + 1) . " </th>";
        echo "<td>". implode(" - ", $rota) . "</td>";
        echo "<td>". $custoTotal."</td>";
        echo "</tr>";
    }    

    echo "</tbody>";
    }

    private function calcularCustoTotal($rota) {
        $custoTotal = 0;    
        for ($i = 0; $i < count($rota) - 1; $i++) {
            $origem = $rota[$i];
            $destino = $rota[$i + 1];
            foreach ($this->grafico as $aeroporto) {
                if ($aeroporto['origem'] == $origem && $aeroporto['destino'] == $destino) {
                    $custoTotal += $aeroporto['custo'];
                    break;
                }
            }
        }
        return $custoTotal;
    }
}





