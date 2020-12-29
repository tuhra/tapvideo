<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
// Define the status type
define("STATUS_ACTIVE", 1);
define("STATUS_INACTIVE", 0);
define("STATUS_PENDING", 2);

define("MALE", 1);
define("FEMALE", 0);

// define Date time
define('DB_DATE', 'Y-m-d H:i:s');

// Media File Upload
define('CATEGORY_MEDIA_UPLOAD', 16);
define('LOCAL_MEDIA_UPLOAD', 17);
define('VIDEO_UPLOAD', 18);

define('PAGINATE', 25);

define('MEDIA_PATH', json_encode(
    array(
        16 => 'upload/category',        
        17 => 'upload/videos',     
        18 => 'upload/videos'     
    )
));

define('MEDIA_TYPE', json_encode(
    array(
        'image' => array('field_name' => 'image_media', 'extension' => array("jpg", "gif", "png", "jpeg"), 'max_size' => 500000000000),
    	'video' => array('field_name' => 'video', 'extension' => array("mp4"), 'max_size' => 50000000000),
    )
));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
