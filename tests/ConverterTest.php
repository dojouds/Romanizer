<?php

namespace MaringaDojo\Romanizer\Tests;

use MaringaDojo\Romanizer\Converter;
use MaringaDojo\Romanizer\Exceptions\MaisDeTresSimbolosIguaisException;
use MaringaDojo\Romanizer\Exceptions\SimboloInvalidoException;

class ConverterTest extends TestCase
{
    private $converter;

    public function setup()
    {
        $this->converter = new Converter();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(Converter::class, $this->converter);
    }

    public function testDeveEntenderOSimboloI()
    {
        $this->assertEquals(1, $this->converter->toDecimal('I'));
    }

    public function testDeveEntenderOSimboloV()
    {
        $this->assertEquals(5, $this->converter->toDecimal('V'));
    }

    public function testDeveEntenderOSimboloX()
    {
        $this->assertEquals(10, $this->converter->toDecimal('X'));
    }

    public function testDeveEntenderOSimboloL()
    {
        $this->assertEquals(50, $this->converter->toDecimal('L'));
    }

    public function testDeveEntenderOSimboloC()
    {
        $this->assertEquals(100, $this->converter->toDecimal('C'));
    }

    public function testDeveEntenderOSimboloD()
    {
        $this->assertEquals(500, $this->converter->toDecimal('D'));
    }

    public function testDeveEntenderOSimboloM()
    {
        $this->assertEquals(1000, $this->converter->toDecimal('M'));
    }

    public function testDeveEntenderOSimboloIIeIII()
    {
        $this->assertEquals(2, $this->converter->toDecimal('II'));
        $this->assertEquals(3, $this->converter->toDecimal('III'));
    }

    public function testDeveEntenderOSimboloIVeIX()
    {
        $this->assertEquals(4, $this->converter->toDecimal('IV'));
        $this->assertEquals(9, $this->converter->toDecimal('IX'));
    }

    public function testMaisDeTresSimbolosIguaisException()
    {
        $this->expectException(MaisDeTresSimbolosIguaisException::class);
        $this->converter->toDecimal('IIII');
        $this->converter->toDecimal('XXXXV');
        $this->converter->toDecimal('VIIII');
        $this->converter->toDecimal('IIIII');
    }

    public function testSimboloInvalidoException()
    {
        $this->expectException(SimboloInvalidoException::class);
        $this->converter->toDecimal('A');
    }

    public function testFronteiras()
    {
        $this->assertEquals(14, $this->converter->toDecimal('XIV'));
        $this->assertEquals(49, $this->converter->toDecimal('XLIX'));
        $this->assertEquals(3999, $this->converter->toDecimal('MMMCMXCIX'));
    }

    /*
      testes de decimal para romano;
    */

    public function testDeveEntenderONumero1()
    {
      $this->assertEquals('I', $this->converter->toRoman(1));
    }

    // public function testDeveEntenderONumero2()
    // {
    //   $this->assertEquals('II', $this->converter->toRoman(2));
    // }
    //
    // public function testDeveEntenderONumero3()
    // {
    //   $this->assertEquals('III', $this->converter->toRoman(3));
    // }
    //
    // public function testDeveEntenderONumero4()
    // {
    //   $this->assertEquals('IV', $this->converter->toRoman(4));
    // }
    //
    // public function testDeveEntenderONumero5()
    // {
    //   $this->assertEquals('V', $this->converter->toRoman(5));
    // }
    //
    // public function testDeveEntenderONumero6()
    // {
    //   $this->assertEquals('VI', $this->converter->toRoman(6));
    // }
    //
    // public function testDeveEntenderONumero7()
    // {
    //   $this->assertEquals('VII', $this->converter->toRoman(7));
    // }
    //
    // public function testDeveEntenderONumero8()
    // {
    //   $this->assertEquals('VIII', $this->converter->toRoman(8));
    // }
    //
    // public function testDeveEntenderONumero9()
    // {
    //   $this->assertEquals('IX', $this->converter->toRoman(9));
    // }
    //
    public function testDeveEntenderONumero10()
    {
      $this->assertEquals('X', $this->converter->toRoman(10));
    }
    public function testDeveEntenderONumero20()
    {
      $this->assertEquals('XX', $this->converter->toRoman(20));
    }
    public function testDeveEntenderONumero30()
    {
      $this->assertEquals('XXX', $this->converter->toRoman(30));
    }
    public function testDeveEntenderONumero100()
    {
      $this->assertEquals('C', $this->converter->toRoman(100));
    }
    public function testDeveEntenderONumero1000()
    {
      $this->assertEquals('M', $this->converter->toRoman(1000));
    }
    public function testDeveEntenderONumero2300()
    {
      $this->assertEquals('MMCCC', $this->converter->toRoman(2300));
    }
}
