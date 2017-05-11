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

        # First, create an array of all the books we want to associate tags with
        # The *key* will be the book title, and the *value* will be an array of tags.
        # Note: purposefully omitting the Harry Potter books to demonstrate untagged books
        $addresses =[
            'placename1' => ['novel','fiction','classic','wealth'],
            'placename2' => ['novel','fiction','classic','women'],
            'placename3' => ['autobiography','nonfiction','classic','women'],
        ];

        # Now loop through the above array, creating a new pivot for each book to tag
        foreach($addresses as $placeName => $tags) {

            # First get the book
            $address = Address::where('place_name','like',$placeName)->first();

            # Now loop through each tag for this book, adding the pivot
            foreach($tags as $tagName) {
                $tag = Tag::where('tag_name','LIKE',$tagName)->first();

                # Connect this tag to this book
                $address->tags()->save($tag);
            }

        }

    }
}
