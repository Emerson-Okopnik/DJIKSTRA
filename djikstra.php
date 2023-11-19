<?php

class djikstra {

    private array $caminho;
    private string $PontoInicial;
    private string $Pontofinal;
    private array $caminhosValidos = [];

    public function  __construct($caminho,$PontoInicial,$Pontofinal){

        $this->caminho = $caminho;
        $this->PontoInicial = $PontoInicial;
        $this->Pontofinal = $Pontofinal;
    }

    public function caminhosValidos(): array{
        return $this->caminhosValidos;
    }


    public function calcularCaminhos(string $inicio = null, array $rota = null){

        if ($inicio === null){
            $inicio = $this->PontoInicial;

            $rota = [
                'sequencia' => '',
                'distancia' => 0
            ];
        }

        $rota['sequencia'] .= '-'.$inicio;

        if ($inicio === $this->Pontofinal){
            array_push($this->caminhosValidos,$rota);
            return;    
        }

        foreach ($this->caminho[$inicio]['vertice'] as $con) {
            if (strpos($rota['sequencia'], $con['aeroporto']) !== false || $rota['distancia'] + $con['custo'] > 1000) {
                continue;
              }

        $novaRota =[
            'sequencia' => $rota['sequencia'],
            'distancia' => $rota['distancia'] + $con['custo']
        ];
        $this->calcularCaminhos($con['aeroporto'], $novaRota);

        }
    }
}