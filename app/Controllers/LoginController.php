<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CabangModel;
use App\Models\JamaahModel;
use App\Models\Users;
use CodeIgniter\Email\Email;

use CodeIgniter\HTTP\Request;
use Myth\Auth\Entities\User;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Database;

class LoginController extends BaseController
{
    public function __construct()
    {
        if (session()->get("login")) {
            return redirect()->to("/dashboard");
            exit;
        }
    }

    public function pass()
    {
        // try {
            $password = $this->request->getVar('password');
            $password_dua = $this->request->getVar('password_dua');
            $email = $this->request->getVar('email');
            $result = new Users();
            $main = $result->where('email', $email)->countAllResults();
            if (!$main) {
                return redirect()->back()->with('error', 'Akun Tidak Ditemukan');
            }

            if ($password != $password_dua) {
                return redirect()->back()->with('error', 'Password Tidak Sama');
            }

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $db = \Config\Database::connect();
            $db->query("UPDATE users SET password = '$hash' WHERE email = '$email'");

            return redirect()->back()->with('success', 'Password Berhasil Diupdate');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('error', 'Password Gagal Diupdate');
        //     //throw $th;
        // }
    }

    public function lupa()
    {
        return view('lupa_password');
    }

    public function ganti_password_baru($email)
    {
        $data = [
            'email' =>  $email
        ];
        return view('forgot_password', $data);
    }

    public function forgot()
    {
        try {
            $email = $this->request->getVar('email');
            $akun = new Users();
            $result = $akun->where("email", $email)->first();

            if (!$result) {
                return redirect()->back()->with('error', 'Akun Tidak Ditemukan');
            }

            $subjek = "RESET PASSWORD AKUN MANASIKITA";
            $url = base_url('ganti_password_baru/' . $email);
            $pesan = "Reset password klik link ini <a href='$url'>FORGOT EMAIL</a> Terima kasih.";

            $result = \Config\Services::email();
            $result->setTo($email);
            $result->setFrom("manasikita.com", "Manasikita");
            $result->setSubject($subjek);
            $result->setMessage($pesan);


            if ($result->send()) {
                return redirect()->back()->with('success', 'Email Berhasil Di kirim');
            } else {
                return redirect()->back()->with('error', 'Email Gagal Di kirim');
            }
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Email Gagal Di kirim');
            //throw $th;
        }
    }
    public function index()
    {
        $username = $this->request->getVar("username");
        $password = $this->request->getVar("password");

        $result = new Users();
        $data = $result->where([
            "username"  =>  $username
        ])->first();
        if ($data) {
            if (password_verify($password, $data['password'])) {
                if ($data['level_id'] == "admin") {
                    session()->set([
                        'login' =>  true,
                        'id'    =>  $data['id'],
                        'level_id'    =>  $data['level_id'],
                        'nama'    =>  $data['nama'],
                        'username'    =>  $data['username'],
                        'created_at'    =>  $data['created_at'],
                        'updated_at'    =>  $data['updated_at'],
                        'password'    =>  $data['password'],
                        'email'    =>  $data['email'],
                        'no_hp'    =>  $data['no_hp'],
                        'travel_id'    =>  $data['travel_id'],
                    ]);
                    return redirect()->to("/users");
                } elseif ($data['level_id'] == "jamaah" || $data['level_id'] == "cabang") {
                    if ($data['level_id'] == "cabang") {
                        $cabang = $data['cabang_id'];
                        $baru = new CabangModel();
                        $data_baru = $baru->where("id", $data['cabang_id'])->first();
                        $id_travel = $data_baru['travel_id'];
                    } else {
                        $cabang = null;
                        $id_travel = $data['travel_id'];
                    }
                    session()->set([
                        'login' =>  true,
                        'id'    =>  $data['id'],
                        'level_id'    =>  $data['level_id'],
                        'nama'    =>  $data['nama'],
                        'username'    =>  $data['username'],
                        'created_at'    =>  $data['created_at'],
                        'updated_at'    =>  $data['updated_at'],
                        'password'    =>  $data['password'],
                        'email'    =>  $data['email'],
                        'no_hp'    =>  $data['no_hp'],
                        'travel_id'    =>  $id_travel,
                        'cabang_id'    =>  $cabang
                    ]);
                    return redirect()->to("/dashboard");
                    // if($data['kelengkapan'] == "sudah") {
                    // } else {
                    //     return redirect("/")->with("error","Masih Ada Data Yang Belum Lengkap");
                    // }
                } elseif ($data['level_id'] == "user") {
                    $jamaah = new JamaahModel();
                    $check = $jamaah->where("id", $data['jamaah_id'])->first();

                    session()->set([
                        'login' =>  true,
                        'id'    =>  $data['id'],
                        'level_id'    =>  $data['level_id'],
                        'nama'    =>  $data['nama'],
                        'username'    =>  $data['username'],
                        'img'    =>  $data['img'],
                        'created_at'    =>  $data['created_at'],
                        'updated_at'    =>  $data['updated_at'],
                        'password'    =>  $data['password'],
                        'email'    =>  $data['email'],
                        'no_hp'    =>  $data['no_hp'],
                        'jamaah_id' =>  $data['jamaah_id'],
                        'travel_id' =>  $data['travel_id'],
                    ]);
                    return redirect()->to("/dashboard_user");
                    // if($check['kloter_id'] == null) {
                    //     return redirect()->back()->with('error','Akun Anda Belum diaktifasi');
                    // }
                    // if(!$check) {
                    //     return redirect()->to("/")->with('error',"Data Jamaah Hilang");
                    // } else {
                    //     session()->set([
                    //         'login' =>  true,
                    //         'id'    =>  $data['id'],
                    //         'level_id'    =>  $data['level_id'],
                    //         'nama'    =>  $data['nama'],
                    //         'username'    =>  $data['username'],
                    //         'created_at'    =>  $data['created_at'],
                    //         'updated_at'    =>  $data['updated_at'],
                    //         'password'    =>  $data['password'],
                    //         'email'    =>  $data['email'],
                    //         'no_hp'    =>  $data['no_hp'],
                    //         'jamaah_id' =>  $data['jamaah_id'],
                    //         'travel_id' =>  $data['travel_id'],
                    //     ]);
                    //     return redirect()->to("/dashboard_user");
                    // }
                } else {
                    return redirect()->to("/masuk")->with("error", "Level User Tidak Diketahui");
                }
            } else {
                return redirect()->to("/masuk")->with("error", "Email Atau Password Salah");
            }
        } else {
            return redirect()->to("/masuk")->with("error", "Email Atau Password Salah");
        }
    }
}
