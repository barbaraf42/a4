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


}
