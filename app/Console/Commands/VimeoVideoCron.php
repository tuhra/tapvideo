<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Vimeo\Laravel\Facades\Vimeo;
use App\Model\VimeoVideo;
use Illuminate\Support\Facades\Crypt;
use DB;
use Storage;

class VimeoVideoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vimeo:video';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will request vimeo api and insert viedo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $popular_vdos = json_encode(Vimeo::request('/users/68253613/projects/1193466/videos'));
        $new_vdos = json_encode(Vimeo::request('/users/68253613/projects/1212455/videos'));
        $vdos = json_encode(Vimeo::request('/users/68253613/videos'));
        $action_vdos = json_encode(Vimeo::request('/users/68253613/projects/1089181/videos'));
        $kid_vdos = json_encode(Vimeo::request('/users/68253613/projects/1212453/videos'));

        Storage::put('popular_vdos.json', json_encode($popular_vdos));
        Storage::put('new_vdos.json', json_encode($new_vdos));
        Storage::put('vdos.json', json_encode($vdos));
        Storage::put('action_vdos.json', json_encode($action_vdos));
        Storage::put('kid_vdos.json', json_encode($kid_vdos));

    }
}







