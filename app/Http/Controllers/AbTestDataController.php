<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbTestData;
use Illuminate\Support\Facades\DB;

class AbTestDataController extends Controller
{
    public function ausgabe_testdaten()
    {
        $testdaten = DB::table('ab_testdata')
            ->select('id', 'ab_testname')
            ->get();
        return view ('testdaten', ['testdaten' => $testdaten]);
    }
}
