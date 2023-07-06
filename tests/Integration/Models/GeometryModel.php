<?php

namespace Kurt\LaravelMysqlSpatial\Tests\Integration\Models;

use Kurt\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GeometryModel.
 *
 * @property int                                          id
 * @property \Kurt\LaravelMysqlSpatial\Types\Point      location
 * @property \Kurt\LaravelMysqlSpatial\Types\LineString line
 * @property \Kurt\LaravelMysqlSpatial\Types\LineString shape
 */
class GeometryModel extends Model
{
    use SpatialTrait;

    protected $table = 'geometry';

    protected $spatialFields = ['location', 'line', 'multi_geometries'];
}
