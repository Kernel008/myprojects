<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CommentController extends Controller
{

    public function addComment(Request $request)
    {
        $user = Auth::user();
        $userEmail = $user->email;

        $comment = new Comment();
        $comment->blogId = $request->blogId;
        $comment->comment = $request->comment;
        $comment->owner = $userEmail;
        $comment->save();
        return response()->json(['message' => 'Yorum başarıyla eklendi.'], 200);

    }


    public function getComment(Request $request)
    {
        $user = Auth::user();
        $userEmail = $user->email;

        if ($request->has('blogId')) {
            $blogId = $request->blogId;
            $comments = Comment::where('blogId', $blogId)->get();
        }
        // Hiçbir parametre yoksa, tüm yorumları getir
        else {
            $comments = Comment::get();
        }

        
        return response()->json($comments);

    }

}
