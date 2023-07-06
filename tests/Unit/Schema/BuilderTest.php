<?php

namespace Kurt\LaravelMysqlSpatial\Tests\Unit\Schema;

use Kurt\LaravelMysqlSpatial\MysqlConnection;
use Kurt\LaravelMysqlSpatial\Schema\Blueprint;
use Kurt\LaravelMysqlSpatial\Schema\Builder;
use Kurt\LaravelMysqlSpatial\Tests\Unit\BaseTestCase as UnitBaseTestCase;
use Mockery;

class BuilderTest extends UnitBaseTestCase
{
    public function testReturnsCorrectBlueprint()
    {
        $connection = Mockery::mock(MysqlConnection::class);
        $connection->shouldReceive('getSchemaGrammar')->once()->andReturn(null);

        $mock = Mockery::mock(Builder::class, [$connection]);
        $mock->makePartial()->shouldAllowMockingProtectedMethods();
        $blueprint = $mock->createBlueprint('test', function () {
        });

        $this->assertInstanceOf(Blueprint::class, $blueprint);
    }
}
