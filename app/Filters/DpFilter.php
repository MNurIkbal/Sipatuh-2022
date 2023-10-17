<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use function PHPUnit\Framework\isEmpty;

class DpFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        
        $login = session('login');
        $id = session()->get('id');
        $level_id = session()->get('level_id');
        $nama = session()->get('nama');
        $username = session()->get('username');
        $created_at = session()->get('created_at');
        $updated_at = session()->get('updated_at');
        $email = session()->get('email');
        $password = session()->get('password');
        $no_hp = session()->get('no_hp');
        if($level_id == "admin") {
            $travel_id = "travel untuk admin";
            $jamaah_id = "ada jamaah admin";
            $cabang_id = "ada cabang admin";
        } elseif($level_id == "jamaah") {
            $cabang_id = "ada cabang admin";
            $jamaah_id = "ada jamaah admin";
            $travel_id = session()->get('travel_id');
        } elseif($level_id == "cabang") {
            $travel_id = session()->get('travel_id');
            $jamaah_id = "ada jamaah admin";
            $cabang_id = session()->get('cabang_id');
        } elseif($level_id == "user") {
            $travel_id = 1;
            $cabang_id = "ada cabang admin";
            $jamaah_id = 1;
        }
        
        if (!isset($login) )
	    {
	        return redirect()->to("/masuk")->with('error', "Invalid Credential");
	    }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
