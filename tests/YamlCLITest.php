<?php

namespace atphp\yaml_cli\test_cases;

class YamlCLITest extends \PHPUnit_Framework_TestCase
{

    public function getYml()
    {
        return dirname(__DIR__) . '/bin/yaml-reader';
    }

    public function testSimple()
    {
        exec($this->getYml() . ' ' . __DIR__ . '/fixtures/simple.yml', $output);
        $this->assertContains('"ship-to": {', implode('', $output));
    }

    public function testFormatJson()
    {
        exec($this->getYml() . ' ' . __DIR__ . '/fixtures/simple.yml', $output);
        $this->assertContains(
            'BL394D',
            json_decode(implode("\n", $output))->product[0]->sku
        );
    }

    public function testMultipleFile()
    {
        exec($this->getYml() . ' ' . __DIR__ . '/fixtures/lineitems.yml', $output);
        $this->assertContains('"sku": "BL394A"', implode("\n", $output));
    }

    public function testImport()
    {
        exec($this->getYml() . ' ' . __DIR__ . '/fixtures/order.yml', $output);
        $this->assertContains('"sku": "BL394A"', implode("\n", $output));
    }

}
