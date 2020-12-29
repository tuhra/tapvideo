<?php

/**
 *   Copyright 2018 Vimeo.
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *       http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
 */
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id' => env('VIMEO_CLIENT', 'e053828fe6e7737c528ff51c1775d2fb20019eac'),
            'client_secret' => env('VIMEO_SECRET', 'rxM+gNvSRffdTsHM9Cb+JqN0YLQFzIUGpWRvPC1x6pqS9N1kly9eLA2autC9JJ+I8KXMxGW4/G0u/CotlTNgf+iqtHhgPUoh7EPkMKLHhBeY3hboPEwleF6IjtmMl9cD'),
            'access_token' => env('VIMEO_ACCESS', 'b2983b43fe99afc9a73ef0a4c2b66e37'),
        ],

        /*'main' => [
            'client_id' => env('VIMEO_CLIENT', 'f01ccbd8c4ea4e496d23464abceedd14e18e652c'),
            'client_secret' => env('VIMEO_SECRET', 'd/9lleiZWO5CKbfz81iV6wlGxJR0w4Ul+zMRMnGXG4579NCBp8hOl7+ljUauUZe9zJNf3Hixs9uzgsPDhsQXjwCquX342+DkZrKRDUJzoTWUiYAzP9OQOmMp0pCJwo81'),
            'access_token' => env('VIMEO_ACCESS', 'e3f83710af258f8edeefb5c893ab21c3'),
        ],*/

        'alternative' => [
            'client_id' => env('VIMEO_ALT_CLIENT', 'your-alt-client-id'),
            'client_secret' => env('VIMEO_ALT_SECRET', 'your-alt-client-secret'),
            'access_token' => env('VIMEO_ALT_ACCESS', null),
        ],

    ],

];
