<?php

namespace MaringaDojo\Romanizer;

use MaringaDojo\Romanizer\Exceptions\MaisDeTresSimbolosIguaisException;
use MaringaDojo\Romanizer\Exceptions\SimboloInvalidoException;

class Converter
{
    private $romanoParaNumero = [
        'M' => 1000,
        'D' => 500,
        'C' => 100,
        'L' => 50,
        'X' => 10,
        'V' => 5,
        'I' => 1,
    ];

    private $numeroParaRomano = [
        1000 => 'M',
        500 => 'D',
        100 => 'C',
        50 => 'L',
        10 => 'X',
        5 => 'V',
        1 => 'I',
    ];

    public function toDecimal($numeroRomano)
    {
        $valor = 0;
        $valorAnterior = 0;
        $repeticoes = 0;

        for ($i = strlen($numeroRomano) - 1; $i >= 0; $i--) {
            $letra = $numeroRomano[$i];

            if (! array_key_exists($letra, $this->romanoParaNumero)) {
                throw new SimboloInvalidoException(
                    $letra . 'É um simbolo invalido'
                );
            }

            $valorAtual = $this->romanoParaNumero[$letra];

            if ($valorAtual == $valorAnterior) {
                $repeticoes++;

                if ($repeticoes >= 3) {
                    throw new MaisDeTresSimbolosIguaisException(
                        'Os simbolos só podem ser repitidos até três vezes.'
                    );
                }
            } else {
                $repeticoes = 0;
            }

            if ($valorAtual >= $valorAnterior) {
                $valor += $valorAtual;
            } else {
                $valor -= $valorAtual;
            }

            $valorAnterior = $valorAtual;
        }

        return $valor;
    }

    public function toRoman($numero)
    {
        if(isset($this->numeroParaRomano[$numero])){
          return $this->numeroParaRomano[$numero];
        }

        $controladorMilhares = 0;
        $controladorCentenas = 0;
        $controladorDezenas = 0;
        if($numero > 1000){
            $controladorMilhares = intval($numero / 1000);
            $numero = $numero - ($controladorMilhares * 1000);
        }
        if($numero > 100){
            $controladorCentenas = intval($numero / 100);
            $numero = $numero - ($controladorCentenas * 100);
        }
        if($numero > 10){
            $controladorDezenas = intval($numero / 10);
            $numero = $numero - ($controladorDezenas * 10);
        }

        $stringRomano = '';

        for($x = 0; $x < $controladorMilhares; $x++){
          $stringRomano .= 'M';
        }
        for($x = 0; $x < $controladorCentenas; $x++){
          $stringRomano .= 'C';
        }
        for($x = 0; $x < $controladorDezenas; $x++){
          $stringRomano .= 'X';
        }

        return $stringRomano;
    }
}
