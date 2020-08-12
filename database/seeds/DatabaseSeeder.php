<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DatabaseStudent::class);
    }
}

class DatabaseStudent extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            ['name' => 'Nguyen Van Lam', 'address' => 'Bac Ninh', 'school' => 'bkhn', 'url_file' => 'test.png'],
            ['name' => 'Nguyen Thanh An', 'address' => 'Ha Nam', 'school' => 'bkhn', 'url_file' => 'test.png'],
            ['name' => 'Pham Cong Chinh', 'address' => 'Ha Noi', 'school' => 'Mo', 'url_file' => 'test.png'],
            ['name' => 'Nguyen Nhu Hung', 'address' => 'Nghe An', 'school' => 'Cong nghe', 'url_file' => 'test.png'],
            ['name' => 'Bui Van Cong', 'address' => 'Hue', 'school' => 'Mat ma', 'url_file' => 'test.png'],
        ]);
    }
}
