<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geotag extends Model
{
    use HasFactory;

		protected $table = 'geotags';
		protected $guarded = ['id'];
}
