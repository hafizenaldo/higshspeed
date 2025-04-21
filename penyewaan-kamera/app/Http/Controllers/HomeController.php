<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function about()
    {
        return view('about'); // Menampilkan halaman about
    }

    public function home()
    {
        return view('home'); // Menampilkan halaman home
    }

    public function contact()
    {
        return view('contact'); // Menampilkan halaman contact
    }

    public function submitContact(Request $request)
    {
    // Validasi data
    $request->validate([
        'email' => 'required|email',
        'msg' => 'required|string',
    ]);

    // Bisa simpan ke database, kirim email, dll di sini
    // Tapi untuk sekarang cukup return sukses

    return redirect()->back()->with('success', 'Your message has been sent!');
    }

    public function carasewa()
    {
        return view('carasewa'); // Menampilkan halaman cara sewa
    }
}
