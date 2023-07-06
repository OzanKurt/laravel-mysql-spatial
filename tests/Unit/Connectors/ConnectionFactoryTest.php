<?php

namespace Kurt\LaravelMysqlSpatial\Tests\Unit\Connectors;

use Kurt\LaravelMysqlSpatial\Connectors\ConnectionFactory;
use Kurt\LaravelMysqlSpatial\MysqlConnection;
use Kurt\LaravelMysqlSpatial\Tests\Unit\BaseTestCase;
use Illuminate\Container\Container;
use Mockery;

class ConnectionFactoryTest extends BaseTestCase
{
    public function testMakeCallsCreateConnection()
    {
        $pdo = $this->createMock(\PDO::class);

        $factory = Mockery::mock(ConnectionFactory::class, [new Container()])->makePartial();
        $factory->shouldAllowMockingProtectedMethods();
        $conn = $factory->createConnection('mysql', $pdo, 'database');

        $this->assertInstanceOf(MysqlConnection::class, $conn);
    }

    public function testCreateConnectionDifferentDriver()
    {
        $pdo = $this->createMock(\PDO::class);

        $factory = Mockery::mock(ConnectionFactory::class, [new Container()])->makePartial();
        $factory->shouldAllowMockingProtectedMethods();
        $conn = $factory->createConnection('pgsql', $pdo, 'database');

        $this->assertInstanceOf(\Illuminate\Database\PostgresConnection::class, $conn);
    }
}
