<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\StatMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Path;
use Carbon\Carbon;
use App\Models\Comment;

class sendStatistic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendStatistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

     public function __construct()
     {
        parent::__construct();
     }

    public function handle()
    {
        $countShowArticle = Path::all()->count();
        Log::alert($countShowArticle);
        Path::whereNotNull('id')->delete();
        $countComment = Comment::whereDate('created_at', Carbon::today())->count();
        Mail::to('anion.23@mail.ru')->send(new StatMail($countShowArticle, $countComment));
    }
}
