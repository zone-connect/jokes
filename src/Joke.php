<?php

namespace Zonec\Base;

use \Illuminate\Database\Eloquent\Model;

/**
 * Model class
 */
class Joke extends Model
{

    protected $guarded = [];

    /**
     * Table
     *
     * @var null
     */
    protected $table = "jokes";
}
