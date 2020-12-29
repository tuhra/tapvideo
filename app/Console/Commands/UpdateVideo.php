<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Vimeo\Laravel\Facades\Vimeo;
use App\Model\VimeoVideo;
use App\Model\Video;

class UpdateVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:video {--per_page=} {--page=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will be update video name';

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
        $per_page = $this->option('per_page', '');
        $page = $this->option('page', '');
        $data = [];
        $videos = Vimeo::request('/users/68253613/videos', ['per_page' => $per_page, 'page' => $page], 'GET');
        foreach ($videos['body']['data'] as $key => $value) {
            $uri = explode("/", $value['uri']);
            $video_id = end($uri);
            $data[] = [
                'video_id' => end($uri),
                'name' => $value['name']
            ];
        }
        Video::insert($data);
    }
}
