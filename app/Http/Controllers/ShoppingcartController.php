<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

class shoppingcartController extends Controller
{
    function AddToShoppingcart(Request $request)
    {
        $user = $request->session($id);
        $date = date('Y-m-d H:i:s',time());

        DB::table('ab_shoppingcart')->insert([
            'ab_creator_id' => $user,
            'ab_createdate' => $date
        ]);
    }
}
