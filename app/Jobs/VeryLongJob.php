<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleMail;
use App\Mail\CommentMail;

use App\Models\Article;
use App\Models\Comment;


class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**g
     * Create a new job instance.
     */
    // protected $article;
    // public function __construct(Article $article) //присвоить свойству значение объекта статьи
    // {
    //     $this->article=$article;
    // }

    protected $article;
    protected $comment;
    public function __construct(Comment $comment, string $article)
    {
        $this->article = $article;
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        //Mail::send(new ArticleMail($this->article));
        Mail::to('anion.23@mail.ru')->send(new CommentMail($this->comment, $this->article));
    }
}
