<?php
namespace atphp\yaml_cli\test_cases;

class YamlCLITest extends \PHPUnit_Framework_TestCase
{

    public function getYml()
    {
        return dirname(__DIR__) . '/bin/yml';
    }

    public function testSimple()
    {
        exec($this->getYml() . ' ./tests/fixtures/simple.yml', $output);
        $this->assertTrue(strpos(implode("\n", $output), '[ship-to] => Array') > -1);
    }

    public function testFormatJson()
    {
        exec($this->getYml() . ' --format=json ./tests/fixtures/simple.yml', $output);
        $value = json_decode(implode("\n", $output));
        $this->assertTrue($value->product[0]->sku === 'BL394D');
    }

    public function testMultipleFile()
    {
        exec($this->getYml() . ' ./tests/fixtures/simple.yml ./tests/fixtures/lineitems.yml', $output);
        $this->assertTrue(strpos(implode("\n", $output), '[ship-to] => Array') > -1);
        $this->assertTrue(strpos(implode("\n", $output), '[sku] => BL394A') > -1);
    }

    public function testImport()
    {
        exec($this->getYml() . ' ./tests/fixtures/order.yml', $output);
        $this->assertTrue(strpos(implode("\n", $output), '[sku] => BL394A') > -1);
    }
}