<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{

    public function search(Request $req){

        $article=$req->get('article_name');
        return view('article',['articles'=> Article::getLikeName($article)]);
    }

}
