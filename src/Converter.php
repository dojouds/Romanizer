<?php

namespace MaringaDojo\Romanizer;

use MaringaDojo\Romanizer\Exceptions\MaisDeTresSimbolosIguaisException;

class Converter
{
    private $_romanoParaNumero = [
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
            $valorAtual = $this->_romanoParaNumero[$letra];

            if ($valorAtual == $valorAnterior) {
                $repeticoes++;

                if ($repeticoes >= 3) {
                    throw new MaisDeTresSimbolosIguaisException("Os simbolos só podem ser repitidos até três vezes.", 1);
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
