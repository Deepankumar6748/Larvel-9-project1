<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];  //when we declare this all the field  is fillable,we need not to declare or mention the variables fillable.

    use HasFactory;
}
