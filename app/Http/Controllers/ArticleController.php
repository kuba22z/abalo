<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function search(Request $req){

        $article=$req->get('search');
        if(empty($article))
            return view('article',['articles'=>[]]);
                else
        return view('article',['articles'=> Article::getLikeName($article)]);
    }

}
