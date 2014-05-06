<?php

namespace Fracture\Injector;

use Exception;
use ReflectionClass;
use PHPUnit_Framework_TestCase;

class InspectorTest extends PHPUnit_Framework_TestCase
{


    public function setUp()
    {
        require_once FIXTURE_PATH . '/simple-classes.php';
    }


    public function testClassWithoutConstructor()
    {
        $cache = $this->getMock('Fracture\Injector\ReflectionCache');

        $instance = new Inspector($cache);
        $this->assertEquals([], $instance->getRequirements('Basic'));
        $this->assertEquals([], $instance->getRequirements('SimpleEmpty'));
    }


    public function testClassWithDefaultInConstructor()
    {
        $expected = [
            'param' => [
                'type'    => 'parameter',
                'default' => 'foobar',
            ],
        ];

        $cache = $this->getMock('Fracture\Injector\ReflectionCache');

        $instance = new Inspector($cache);
        $this->assertEquals($expected, $instance->getRequirements('SimpleWithDefault'));
        $this->assertEquals($expected, $instance->getRequirements('ExtendsSimpleWithDefault'));
    }
}
