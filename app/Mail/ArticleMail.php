<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class ArticleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $article;
    public function __construct(Article $article) //присвоить свойству значение объекта статьи
    {
        $this->article=$article;
    }

    public function build()
    {
        return $this->from(env('MAIL_USERNAME'))
                    ->to('anion.23@mail.ru')
                    ->with('article', $this->article)
                    ->view('mail.article');
    }
}
