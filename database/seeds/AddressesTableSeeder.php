<?php

use Illuminate\Database\Seeder;

use App\Address;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        # Blatantly and gratefully copied from Professor's notes!

        # Array of address data to add
        $addresses = [
            ['placename1', '123 Main Street', 'Anytown', 'MA', 01234],
            ['placename2', '32A Side Street', 'Anycity', 'NY', 12345],
            ['placename3', '300 Main Avenue', 'New York', 'NY', 12345],
            ['placename4', '12345 Computer Drive', 'San Francisco', 'CA', 98765],
            ['placename5', '15 DWA Road', 'Boston', 'MA', 01357],
        ];

        # Initiate a new timestamp we can use for created_at/updated_at fields
        $timestamp = Carbon\Carbon::now()->subDays(count($addresses));

        foreach($addresses as $address) {

            # Set the created_at/updated_at for each address to be one day less than
            # the address before. That way each address will have unique timestamps.
            $timestampForThisAddress = $timestamp->addDay()->toDateTimeString();

            # create google map link
            $mapLinkForThisAddress = 'http://maps.google.com';

            # add data
            Address::insert([
                'created_at' => $timestampForThisAddress,
                'updated_at' => $timestampForThisAddress,
                'place_name' => $address[0],
                'street' => $address[1],
                'city' => $address[2],
                'state' => $address[3],
                'zip' => $address[4],
                'map_link' => $mapLinkForThisAddress,
            ]);
        }

    }
}
