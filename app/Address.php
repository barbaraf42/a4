<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{


    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }


    public static function createMapLink($address) {

        # create string from address array, separated by ,+ and replace all remaining spaces with +
        $addressString = implode(",+", $address);
        $addressString = str_replace(" ", "+", $addressString);

        $mapLink = 'https://www.google.com/maps/place/'.$addressString;

        return $mapLink;

    }
    

    // from Wikipedia list: https://simple.wikipedia.org/wiki/List_of_U.S._states
    public $states = [
        'AL - Alabama',
        'AK - Alaska',
        'AZ - Arizona',
        'AR - Arkansas',
        'AS - American Samoa',
        'CA - California',
        'CO - Colorado',
        'CT - Connecticut',
        'DC - District of Columbia',
        'DE - Delaware',
        'FL - Florida',
        'GA - Georgia',
        'GU - Guam',
        'HI - Hawaii',
        'ID - Idaho',
        'IL - Illinois',
        'IN - Indiana',
        'IA - Iowa',
        'KS - Kansas',
        'KY - Kentucky',
        'LA - Louisiana',
        'ME - Maine',
        'MD - Maryland',
        'MA - Massachusetts',
        'MI - Michigan',
        'MN - Minnesota',
        'MS - Mississippi',
        'MO - Missouri',
        'MT - Montana',
        'NE - Nebraska',
        'NV - Nevada',
        'NH - New Hampshire',
        'NJ - New Jersey',
        'NM - New Mexico',
        'NY - New York',
        'NC - North Carolina',
        'ND - North Dakota',
        'MP - Northern Mariana Islands',
        'OH - Ohio',
        'OK - Oklahoma',
        'OR - Oregon',
        'PA - Pennsylvania',
        'PR - Puerto Rico',
        'RI - Rhode Island',
        'SC - South Carolina',
        'SD - South Dakota',
        'TN - Tennessee',
        'TX - Texas',
        'VI - United States Virgin Islands',
        'UT - Utah',
        'VT - Vermont',
        'VA - Virginia',
        'WA - Washington',
        'WV - West Virginia',
        'WI - Wisconsin',
        'WY - Wyoming',
    ];


}
