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

    public function newArticle_api(Request $request)
    {
        $name = $request['name'];
        $price = $request['price'];
        $description = $request['description'] ? $request['description'] : "";
        $date = date('Y-m-d H:i:s', time());
        $creator_id = 2;

        if (isset($name) && $price > 0) {
            DB::table('ab_article')->insert([
                'ab_name' => $name,
                'ab_price' => $price,
                'ab_description' => $description,
                'ab_createdate' => $date,
                'ab_creator_id' => $creator_id
            ]);
            return route('search');
        } else {
            return "Fehler - Artikel konnte nicht gespeichert werden";
        }
    }
        public function soldMessage($id){
            $artikel= Article::getNameById((int)$id);
            $artikelName="";
            $sellerid=0;
        foreach ($artikel as $a) {
            $artikelName= $a->name;
            $sellerid=$a->seller;
        }
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        require __DIR__ . '/../../../bloatless/php-websocket/src/Client.php';
        $client = new \Bloatless\WebSocket\Client;
        $client->connect('127.0.0.1', 8100, '/sold', 'foo.lh');

        $payload = json_encode([
            'action' => 'echo',
            'data' => $sellerid.'Großartig! Ihr Artikel '. $artikelName.' wurde erfolgreich verkauft!',
        ]);
        $client->sendData($payload);
    }
    public function sendOffer($id){
        $artikel= Article::getNameById((int)$id);
        $artikelName="";
        $sellerid=0;
        foreach ($artikel as $a) {
            $artikelName= $a->name;
            $sellerid=$a->seller;
        }
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        require __DIR__ . '/../../../bloatless/php-websocket/src/Client.php';
        $client = new \Bloatless\WebSocket\Client;
        $client->connect('127.0.0.1', 8100, '/offer', 'foo.lh');

        $payload = json_encode([
            'action' => 'echo',
            'data' => $sellerid.'Der Artikel '.$artikelName.' wird nun günstiger angeboten! Greifen Sie schnell zu.',
        ]);
        $client->sendData($payload);

    }

}
