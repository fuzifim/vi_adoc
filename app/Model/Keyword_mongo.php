<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Keyword_mongo extends Eloquent {
    protected $connection = 'mongodb';
    protected $collection = 'mongo_keyword';

}
