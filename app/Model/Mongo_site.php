<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Mongo_site extends Eloquent {
    protected $connection = 'mongodb';
    protected $collection = 'mongo_site';
    const MAX_LENGTH_TITLE        = 78;
    const MAX_LENGTH_DESCRIPTION  = 255;
    const MAX_LENGTH_SLUG        = 50;

}
