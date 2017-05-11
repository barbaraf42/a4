<?php

use Illuminate\Database\Seeder;

use App\Address;
use App\Tag;

class AddressTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        # Blatantly and thankfully taken from the Professor's notes!

        # all sample addresses with sample tags
        $addresses =[
            'home' => ['home'],
            'work' => ['work'],
            'class' => ['work', 'fun', 'education'],
            'Kimball Farm!' => ['fun', 'food', 'travel'],
            'museum in NY' => ['fun', 'culture', 'education', 'travel'],
        ];

        foreach($addresses as $placeName => $tags) {

            # get address from address table
            $address = Address::where('place_name','like',$placeName)->first();

            foreach($tags as $tagName) {

                # get tag from tag table
                $tag = Tag::where('tag_name','LIKE',$tagName)->first();

                # save tag to this address
                $address->tags()->save($tag);

            }

        }

    }
}
