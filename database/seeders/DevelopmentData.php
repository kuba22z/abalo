<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DevelopmentData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $salt = "DBWT2";
            $users = $this->readCSV("user.csv");
            foreach ($users as $key => $user) {
                if ($key != 0 && $key != 8) {
                    DB::table('ab_user')->insert([
                        'ab_name' => $user[1],
                        'ab_password' => Hash::make($user[2] . $salt),
                        'ab_mail' => $user[3]
                    ]);
                }
            }
        });


        DB::transaction(function () {
            $users = $this->readCSV("articles.csv");
            foreach ($users as $key => $user) {
                if ($key != 0) {
                    DB::table('ab_article')->insert([
                        'ab_name' => $user[1],
                        'ab_price' => str_replace('.','',$user[2]),
                        'ab_description' => $user[3],
                        'ab_creator_id' => $user[4],
                        'ab_createdate' => $user[5]
                    ]);
                }
            }
        });

        DB::transaction(function () {
            $users = $this->readCSV("articlecategory.csv");
            foreach ($users as $key => $user) {
                if ($key != 0 && $key != 22) {
                    if ($user[2] !== 'NULL')
                        DB::table('ab_articlecategory')->insert([
                            'ab_name' => $user[1],
                            'ab_parent' => $user[2]
                        ]);
                    else
                        DB::table('ab_articlecategory')->insert([
                            'ab_name' => $user[1]
                        ]);
                }
            }
        });


    }

    public function readCSV($csvFileName)
    {
        $file_path = storage_path('app/data/' . $csvFileName);

        $file_handle = fopen($file_path, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, ';');
        }
        fclose($file_handle);
        return $line_of_text;
    }

}
