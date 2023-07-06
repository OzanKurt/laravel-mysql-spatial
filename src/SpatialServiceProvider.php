<?php

namespace Kurt\LaravelMysqlSpatial;

use Doctrine\DBAL\Types\Type as DoctrineType;
use Kurt\LaravelMysqlSpatial\Connectors\ConnectionFactory;
use Kurt\LaravelMysqlSpatial\Doctrine\Geometry;
use Kurt\LaravelMysqlSpatial\Doctrine\GeometryCollection;
use Kurt\LaravelMysqlSpatial\Doctrine\LineString;
use Kurt\LaravelMysqlSpatial\Doctrine\MultiLineString;
use Kurt\LaravelMysqlSpatial\Doctrine\MultiPoint;
use Kurt\LaravelMysqlSpatial\Doctrine\MultiPolygon;
use Kurt\LaravelMysqlSpatial\Doctrine\Point;
use Kurt\LaravelMysqlSpatial\Doctrine\Polygon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\DatabaseServiceProvider;

/**
 * Class DatabaseServiceProvider.
 */
class SpatialServiceProvider extends DatabaseServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        parent::register();

        // The connection factory is used to create the actual connection instances on
        // the database. We will inject the factory into the manager so that it may
        // make the connections while they are actually needed and not of before.
        $this->app->singleton('db.factory', fn ($app) => new ConnectionFactory($app));

        // The database manager is used to resolve various connections, since multiple
        // connections might be managed. It also implements the connection resolver
        // interface which may be used by other components requiring connections.
        $this->app->singleton('db', fn ($app) => new DatabaseManager($app, $app['db.factory']));

        if (class_exists(DoctrineType::class)) {
            // Prevent geometry type fields from throwing a 'type not found' error when changing them
            $geometries = [
                'geometry' => Geometry::class,
                'point' => Point::class,
                'linestring' => LineString::class,
                'polygon' => Polygon::class,
                'multipoint' => MultiPoint::class,
                'multilinestring' => MultiLineString::class,
                'multipolygon' => MultiPolygon::class,
                'geometrycollection' => GeometryCollection::class,
            ];
            $typeNames = array_keys(DoctrineType::getTypesMap());
            foreach ($geometries as $type => $class) {
                if (! in_array($type, $typeNames)) {
                    DoctrineType::addType($type, $class);
                }
            }
        }
    }
}
