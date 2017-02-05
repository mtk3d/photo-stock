<?php

use Illuminate\Database\Seeder;

class photos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
        		'id' => NULL,
            'name' => md5(uniqid(rand(), true)),
            'title' => 'Sunny grass',
            'description' => 'Ut semper sed nulla a dictum. Proin ultrices risus sit amet lacus eleifend, id tincidunt erat cursus.',
            'tags' => 'grass, sun, trees, sky',
            'user_id' => 3
        ]);
    }
}


/*$data = array
        (
            array('id' => NULL,
            'name' => md5(uniqid(rand(), true)).'.jpg',
            'title' => 'Forest',
            'description' => 'Suspendisse a tortor nulla. Proin eros lorem, ultricies ac aliquet eget, pellentesque ut elit.',
            'tags' => 'forest, stones, green',
            'user_id' => 3),            
            array('id' => NULL,
            'name' => md5(uniqid(rand(), true)).'.jpg',
            'title' => 'Sunny grass',
            'description' => 'Ut semper sed nulla a dictum. Proin ultrices risus sit amet lacus eleifend, id tincidunt erat cursus.',
            'tags' => 'grass, sun, trees, sky',
            'user_id' => 3)
        );*/