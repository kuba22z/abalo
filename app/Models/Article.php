<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $table='ab_article';

    public static function getLikeName(string $name)
    {
        return DB::table('ab_article')->select('id', 'ab_name','ab_price','ab_description')->where('ab_name', 'LIKE', "%{$name}%")->get();
    }

}
