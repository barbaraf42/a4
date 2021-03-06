<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'AddressController@index');

Route::get('/addresses/view/{id}', 'AddressController@view');

Route::get('/addresses/add', 'AddressController@add');
Route::post('/addresses/add', 'AddressController@saveTheNewAddress');

Route::get('/addresses/edit/{id}', 'AddressController@edit');
Route::post('/addresses/edit', 'AddressController@saveTheEdit');

Route::get('/addresses/delete/{id}', 'AddressController@delete');
Route::post('/addresses/delete', 'AddressController@saveTheDelete');


if(App::environment('local')) {
    Route::get('/debug', function() {

    	echo '<pre>';

    	echo '<h1>Environment</h1>';
    	echo App::environment().'</h1>';

    	echo '<h1>Debugging?</h1>';
    	if(config('app.debug')) echo "Yes"; else echo "No";

    	echo '<h1>Database Config</h1>';
        	echo 'DB defaultStringLength: '.Illuminate\Database\Schema\Builder::$defaultStringLength;
        	/*
    	The following commented out line will print your MySQL credentials.
    	Uncomment this line only if you're facing difficulties connecting to the database and you
            need to confirm your credentials.
            When you're done debugging, comment it back out so you don't accidentally leave it
            running on your production server, making your credentials public.
            */
    	//print_r(config('database.connections.mysql'));

    	echo '<h1>Test Database Connection</h1>';
    	try {
    		$results = DB::select('SHOW DATABASES;');
    		echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
    		echo "<br><br>Your Databases:<br><br>";
    		print_r($results);
    	}
    	catch (Exception $e) {
    		echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    	}

    	echo '</pre>';

    });
}


if(App::environment('local')) {
    Route::get('/drop', function() {
        $db = 'a4';
        DB::statement('DROP database '.$db);
        DB::statement('CREATE database '.$db);
        return 'Dropped '.$db.'; created '.$db.'.';
    });
}
