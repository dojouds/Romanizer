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
}
