<?php

namespace MaringaDojo\Romanizer\Tests;

use MaringaDojo\Romanizer\Converter;

class ConverterTest extends TestCase
{
    public function testInstance()
    {
        $converter = new Converter();

        $this->assertInstanceOf(Converter::class, $converter);
    }
}
