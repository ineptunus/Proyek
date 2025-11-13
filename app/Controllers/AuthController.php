<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function __construct()
    {
        // Load model dan helper yang dibutuhkan
        $this->userModel = new UserModel();
        helper(['form']);
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // Memproses data login
    public function processLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Email tidak ditemukan.');
        }

        // Kita gunakan password_verify() untuk memeriksa hash password
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('error', 'Password salah.');
        }

        // Jika berhasil, set session
        $session = session();
        $sessionData = [
            'user_id'    => $user->id,
            'nama'       => $user->nama,
            'email'      => $user->email,
            'isLoggedIn' => TRUE
        ];
        $session->set($sessionData);

        // Arahkan ke halaman dashboard (yang akan kita buat nanti)
        return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
    }

    // Menampilkan halaman registrasi
    public function register()
    {
        return view('auth/register');
    }

    // Memproses data registrasi
    public function processRegister()
    {
        $rules = [
            'nama'      => 'required|min_length[3]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[6]',
            'pass_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama'     => $this->request->getVar('nama'),
            'email'    => $this->request->getVar('email'),
            // Password di-hash sebelum disimpan
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];

        $this->userModel->save($data);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Proses logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }
}