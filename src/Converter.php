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
}
