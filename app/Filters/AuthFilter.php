<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // jika user belum login
        if (!session()->get('masuk')) {
            // maka redirct ke halaman login
            return redirect()->to('/');
        } else {
            $akses = session()->get('akses');
            $uri = current_url(true);
            $c_segm = $uri->getSegment(1);

            // dd($c_segm);

            if ($akses == 1 && (($c_segm == 'kadep') || ($c_segm == 'dosen'))) {
                return TRUE;
            } else if ($akses == 2 && $c_segm == 'dosen') {
                return TRUE;
            } else if ($akses == 3 && $c_segm == 'mahasiswa') {
                return TRUE;
            } else if ($akses == 4 && $c_segm == 'admin') {
                return TRUE;
            } else {
                return redirect()->to('/auth/blocked');
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
