<?php 
// Buat file LoginFilter.php di App\Filters

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Periksa apakah pengguna sudah login
        if (session()->has('login')) {
            if(session()->has('level_id') == "admin") {
                return redirect()->to('/users');
            } else {
                return redirect()->back();
            }
            // Jika tidak, redirect ke halaman login
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosongkan jika tidak ada yang perlu dilakukan setelah permintaan
    }
}

?>