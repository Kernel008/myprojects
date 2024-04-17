<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
    

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
    
        try {
            $user->save();
            echo "Kullanıcı başarıyla kaydedildi.";
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                echo "Bu e-posta adresi zaten kullanımda.";
            } else {
                echo "Kullanıcı kaydedilirken bir hata oluştu.";
            }
        }
       
    }
}
