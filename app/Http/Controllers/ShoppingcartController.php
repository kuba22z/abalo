<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

class ShoppingcartController extends Controller
{
    function addToShoppingcart_api(Request $request)
    {
        $date = date('Y-m-d H:i:s',time());

        //insertOrIgnore doesnt inserts if the record already exists or there is other inconsistency
        DB::table('ab_shoppingcart_item')->insertOrIgnore([
            'ab_shoppingcart_id' => 2,
            'ab_article_id' => $request['articleID'],
            'ab_createdate' => $date
        ]);
    }
 function getShoppingcart_api(){
    $articlesInCart =  DB::table('ab_shoppingcart_item')
        ->leftJoin('ab_article',"ab_article.id","=","ab_shoppingcart_item.ab_article_id")
        ->where("ab_shoppingcart_id","=",2)
        ->select('ab_article.id','ab_article.ab_name','ab_article.ab_price')
        ->get();
        return response()->json($articlesInCart);
    }

function deleteFromShoppingcart_api($shoppingcartid, $articleid){
    DB::table('ab_shoppingcart_item')
    ->where('ab_shoppingcart_id','=',$shoppingcartid)
    ->where('ab_article_id','=',$articleid)->delete();
}
}
