<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Mongo_Image extends Eloquent {
    protected $connection = 'mongodb';
    protected $collection = 'mongo_image';
    const MAX_LENGTH_TITLE        = 78;
    const MAX_LENGTH_DESCRIPTION  = 255;
}
