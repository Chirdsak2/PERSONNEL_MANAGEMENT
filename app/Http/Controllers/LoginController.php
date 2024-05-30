<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // import User model
//use App\Models\Prefix; // import Prefix model
use Illuminate\Http\Response;

// use Illuminate\Support\Facades\Auth; // import Auth facade

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // รับข้อมูล username และ password จากคำขอ POST
        $username = $request->input('username');
        $password = $request->input('password');

        // ตรวจสอบว่ามีผู้ใช้ที่มีชื่อผู้ใช้และรหัสผ่านตรงกับที่รับมาหรือไม่
        $user = User::select('users.*', 'prefixes.prefix_name_th')
            ->leftJoin('prefixes', 'prefixes.id', '=', 'users.prefix_id')
            ->where('users.username', '=', $username)
            ->where('password', '=',  $password)
            ->first();

        return $this->checkPassword($user, $username);    
        
    }

    private function checkPassword($user, $username)
    {
        if ($user ) {
            // if ($user && Hash::check($password, $user->password)) {
            // ถ้ามีผู้ใช้และรหัสผ่านถูกต้อง

            session([
                'username' => $username,
                'prefix_id' => $user->prefix_id, // ประกาศ prefix_id จากข้อมูลผู้ใช้
                'prefix_name_th' => $user->prefix_name_th, // ประกาศ prefix_name_th จากข้อมูลผู้ใช้
                'firstname' => $user->firstname, // ประกาศ firstname จากข้อมูลผู้ใช้
                'lastname' => $user->lastname, // ประกาศ lastname จากข้อมูลผู้ใช้
                'user_picture' => $user->user_picture // ประกาศ user_picture จากข้อมูลผู้ใช้
            ]);

            // ล็อกอินผู้ใช้งาน
            // Auth::login($user);


            return response()->json([
                'status' => Response::HTTP_OK,
                'message_text' => 'เข้าสู่ระบบสำเร็จ',
                'detail' => '/home' // URL ที่จะเปลี่ยนเส้นทางไปหลังจากล็อกอินสำเร็จ
            ]);
        } else {
            // ถ้าไม่พบผู้ใช้หรือรหัสผ่านไม่ถูกต้อง    
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message_text' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'
            ]);
        }
    }

    public function logout(Request $request)
    {
        // Auth::logout(); // ออกจากระบบผู้ใช้
        session()->flush();

        // คืนค่าไปยังหน้าหลักหลังจากออกจากระบบ
        return redirect('/login');
    }
}
