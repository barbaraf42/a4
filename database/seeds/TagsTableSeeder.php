<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        # list of tags
        $tags = ['novel', 'fiction', 'classic', 'wealth', 'women', 'autobiography', 'nonfiction'];

        # Initiate a new timestamp we can use for created_at/updated_at fields
        $timestamp = Carbon\Carbon::now()->subDays(count($tags));

        foreach($tags as $tagName) {

            # Set the created_at/updated_at for each address to be one day less than
            # the tag before. That way each tag will have unique timestamps.
            $timestampForThisTag = $timestamp->addDay()->toDateTimeString();

            # add data
            Tag::insert([
                'created_at' => $timestampForThisTag,
                'updated_at' => $timestampForThisTag,
                'tag_name' => $tagName,
            ]);

        }

    }
}
