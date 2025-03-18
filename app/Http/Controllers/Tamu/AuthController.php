<?php

namespace App\Http\Controllers\Tamu;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $apiKey = "3d52e161e9834988a183c960a5520970";
        $email = $request->email;

        try {
            $response = Http::get("https://emailvalidation.abstractapi.com/v1/", [
                'api_key' => $apiKey,
                'email' => $email
            ]);

            $result = $response->json();

            if (!$result['is_valid_format']['value'] || $result['deliverability'] !== 'DELIVERABLE') {
                return back()->withErrors(['email' => 'Email tidak valid atau tidak aktif.'])->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal memverifikasi email. Coba lagi nanti.'])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
