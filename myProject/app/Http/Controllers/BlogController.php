<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{

    public function addBlog(Request $request)
    {

        $user = Auth::user();
        $userEmail = $user->email;
        
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
    
    
        $existingBlog = Blog::where('title', $request->title)
        ->where('owner', $userEmail)
        ->first();

        if ($existingBlog) {
            // Başlık ve sahip aynı olan bir blog gönderisi zaten varsa, güncelle
            $existingBlog->content = $request->content;
            $existingBlog->save();
            return response()->json(['message' => 'Blog başarıyla güncellendi.'], 200);
        } else {
            // Başlık ve sahip aynı olan bir blog gönderisi yoksa, yeni blog oluştur
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->owner = $userEmail;
            $blog->save();
            return response()->json(['message' => 'Blog başarıyla eklendi.'], 200);
        }

    }


    public function deleteBlog(Request $request)
    {

        $user = Auth::user();
        $userEmail = $user->email;
    
        $request->validate([
            'title' => 'required',
        ]);
    
        $blog = Blog::where('title', $request->title)
                    ->where('owner', $userEmail)
                    ->first();
    
        if ($blog) {
            // Blog gönderisi bulunduğunda, sil
            $blog->delete();
            return response()->json(['message' => 'Blog başarıyla silindi.'], 200);
        } else {
            // Belirtilen başlığa sahip ve sahibi login kullanıcı olan bir blog gönderisi bulunamadığında hata dön
            return response()->json(['error' => 'Blog bulunamadı.'], 200);
        }

    }


    public function getBlog(Request $request)
    {

        $user = Auth::user();
        $userEmail = $user->email;

        // Eğer "title" parametresi varsa, filtreleme yap
        if ($request->has('title')) {
            $title = $request->input('title');
            $blogs = Blog::where('owner', $userEmail)
                         ->where('title', $title)
                         ->get();
        }else{
            $blogs = Blog::where('owner', $userEmail)->get();
        }

        return response()->json($blogs);
    }

}
