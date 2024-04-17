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
            if($request->category){
                $existingBlog->category = $request->category;
            }
            $existingBlog->save();
            return response()->json(['message' => 'Blog başarıyla güncellendi.'], 200);
        } else {
            // Başlık ve sahip aynı olan bir blog gönderisi yoksa, yeni blog oluştur
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->content = $request->content;
            if($request->category){
                $blog->category = $request->category;
            }
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



        // "title" ve "category" parametreleri varsa, her ikisine de göre filtreleme yap
        if ($request->has('title') && $request->has('category')) {
            $title = $request->title;
            $category = $request->category;
            $blogs = Blog::where('owner', $userEmail)
                        ->where('title', $title)
                        ->where('category', $category)
                        ->get();
        }
        // Sadece "title" parametresi varsa, sadece ona göre filtreleme yap
        elseif ($request->has('title')) {
            $title = $request->title;
            $blogs = Blog::where('owner', $userEmail)
                        ->where('title', $title)
                        ->get();
        }
        // Sadece "category" parametresi varsa, sadece ona göre filtreleme yap
        elseif ($request->has('category')) {
            $category = $request->category;
            $blogs = Blog::where('owner', $userEmail)
                        ->where('category', $category)
                        ->get();
        }
        // Hiçbir parametre yoksa, tüm blogları getir
        else {
            $blogs = Blog::where('owner', $userEmail)->get();
        }

        return response()->json($blogs);
    }

    
}
