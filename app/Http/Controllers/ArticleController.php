<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function search(Request $req){

        $article=$req->get('search');
        if(empty($article))
            return view('article',['articles'=> Article::getLikeName("")]);
        else
        return view('article',['articles'=> Article::getLikeName($article)]);
    }

    public function newArticle(Request $request){
        $name = $request->post('name');
        $price = $request->post('price');
        $description = $request->post('description');
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
        return redirect("./articles");
        }
        else
            {
               echo "Fehler - Artikel konnte nicht gespeichert werden";
            }


    }

}
