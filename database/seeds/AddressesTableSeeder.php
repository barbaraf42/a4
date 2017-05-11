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
            ['home', '50 Park Plaza', 'Boston', 'MA', '02116'],
            ['work', '26 Oxford Street', 'Cambridge', 'MA', '02138'],
            ['class', '1 Harvard Yard', 'Cambridge', 'MA', '02138'],
            ['Kimball Farm!', '400 Littleton Rd', 'Westford', 'MA', '01886'],
            ['museum in NY', 'Central Park West & 79th St', 'New York', 'NY', '10024'],
        ];

        # Initiate a new timestamp we can use for created_at/updated_at fields
        $timestamp = Carbon\Carbon::now()->subDays(count($addresses));

        foreach($addresses as $address) {

            # Set the created_at/updated_at for each address to be one day less than
            # the address before. That way each address will have unique timestamps.
            $timestampForThisAddress = $timestamp->addDay()->toDateTimeString();

            # create google map link - copy array, remove placename, call function
            $addressForMapLink = $address;
            $placeName = array_shift($addressForMapLink);
            $mapLinkForThisAddress = Address::createMapLink($addressForMapLink);

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
