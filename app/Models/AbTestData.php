<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbTestData extends Model
{
    use HasFactory;

    protected $table = 'ab_testdata';
    protected $primaryKey = 'id';
}
