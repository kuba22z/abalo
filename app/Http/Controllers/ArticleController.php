<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function search_api(Request $req){

        $article=$req->get('search');
        $lowerBound=$req->get('lowerBound');
        if(empty($article))
            return response()->json( Article::getLikeName("",(int)$lowerBound));
        else
        return response()->json(Article::getLikeName($article,(int)$lowerBound));
    }

    public function newArticle_api(Request $request){
        $name = $request['name'];
        $price = $request['price'];
        $description = $request['description'] ? $request['description'] : "" ;
        $date = date('Y-m-d H:i:s',time());
        $creator_id = 2;

        if(isset($name) && $price > 0)
        {
        DB::table('ab_article')->insert([
            'ab_name' => $name,
            'ab_price' => $price,
            'ab_description' => $description,
            'ab_createdate' => $date,
            'ab_creator_id' => $creator_id
        ]);
        return route('search');
        }
        else
            {
               return "Fehler - Artikel konnte nicht gespeichert werden";
            }
    }

}
