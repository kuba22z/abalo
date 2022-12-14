<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $table='ab_article';

    public static function getLikeName(string $name,int $lowerBound)
    {
        if($name =="")
            return DB::table('ab_article')->select('id', 'ab_name','ab_price','ab_description','ab_creator_id')
                ->offset($lowerBound)->limit(5)->get();
        else
            return DB::table('ab_article')
                ->select('id', 'ab_name','ab_price','ab_description')
                ->where(DB::raw('lower(ab_name)'), 'like', '%' . strtolower($name) . '%')
                ->offset($lowerBound)
                ->limit(5)
                ->get();
    }
    public static function getNameById(int $id){

        return DB::table('ab_article')->select( 'ab_name AS name','ab_creator_id AS seller')
            ->where('id','=',$id)->get();

    }

}
