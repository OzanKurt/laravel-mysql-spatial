<?php

namespace Kurt\LaravelMysqlSpatial\Tests\Integration\Models;

use Kurt\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WithSridModel.
 *
 * @property int                                          id
 * @property \Kurt\LaravelMysqlSpatial\Types\Point      location
 * @property \Kurt\LaravelMysqlSpatial\Types\LineString line
 * @property \Kurt\LaravelMysqlSpatial\Types\LineString shape
 */
class WithSridModel extends Model
{
    use SpatialTrait;

    protected $table = 'with_srid';

    protected $spatialFields = ['location', 'line'];

    public $timestamps = false;
}
