<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use App\Mail\CommentMail;
use App\Models\Article;
use App\Models\User;
use App\Notifications\CommentNotify;
use App\Jobs\VeryLongJob;



class CommentController extends Controller
{

    public function index(){
        $comments = Comment::latest()->paginate(10);
        return response()->json(['comments'=>$comments]);
    }

    public function accept(int $id){ 
        
        $comment = Comment::findOrFail($id);
        $users = User::where('id', '!=', $comment->author_id)->get();
        $article = Article::findOrFail($comment->article_id);

        $caches = DB::table('cache')->whereRaw('`key` GLOB :key',  [':key'=> 'article/*[0-9]:[0-9]'])->get();
        foreach($caches as $cache){
            Cache::forget($cache->key);
        }

        $comment->accept = true;
        $res = $comment->save();
        Notification::send($users, new CommentNotifi($article));
        return response($res);
    }

    public function reject(int $id){

        $caches = DB::table('cache')->whereRaw('`key` GLOB :key',  [':key'=> 'article/*[0-9]:[0-9]'])->get();
        foreach($caches as $cache){
            Cache::forget($cache->key);
        }

        $comment = Comment::findOrFail($id);
        $comment->accept = false;
        $res = $comment->save();
        return response($res);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'article_id'=>'required'
        ]);
        $article = Article::findOrFail($request->article_id);
        $comment = new Comment;
        $comment->title = $request->title;
        $comment->text = $request->text;
        $comment->article_id = $request->article_id;
        // $comment->author_id = Auth::id();
        $comment->user()->associate(auth()->user());
        $res = $comment->save();
        //if ($res) Mail::send(new CommentMail($comment, $article->title));
        //if ($res) VeryLongJob::dispatch($comment, $article->title);
        // if ($res) {
        //     VeryLongJob::dispatch($comment, $article->title); // Dispatch the job with comment and article title
        // }
        return response()->json(['article'=>$comment->article_id, 'res'=>$res]);
    }

    public function edit($id){
        $comment = Comment::findOrFail($id);
        Gate::authorize('comment', $comment);
        return response()->json(['comment'=>$comment]);
    }

    public function update($id, Request $request){
        $caches = DB::table('cache')->whereRaw('`key` GLOB :key',  [':key'=> 'article/*[0-9]:[0-9]'])->get();
        foreach($caches as $cache){
            Cache::forget($cache->key);
        }

        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);
        $comment = Comment::findOrFail($id);
        $comment->title = $request->title;
        $comment->text = $request->text;
        $comment->article_id = $comment->article_id;
        $comment->save();
        return response()->json(['article'=>$comment->article_id]);
    }

    public function delete($id){

        $caches = DB::table('cache')->whereRaw('`key` GLOB :key',  [':key'=> 'article/*[0-9]:[0-9]'])->get();
        foreach($caches as $cache){
            Cache::forget($cache->key);
        }
        
        $comment = Comment::findOrFail($id);
        Gate::authorize('comment', $comment);
        $res = $comment->delete();
        return response($res);
    }
}