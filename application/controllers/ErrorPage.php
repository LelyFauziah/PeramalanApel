<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
digunakan untuk mengalihkan halaman

401 need authentication : harus login terlebih dahulu jika ingin akses
403 need authorization : harus memiliki akses jika ingin mengakses halaman
404 tidak ada halaman

*/
class ErrorPage extends CI_Controller
{

    public function error401()
    {
        echo "401 Page : harap login";
    }
    public function error403()
    {
        echo "403 Page : akses tida ada";
    }

    public function error404()
    {
        echo "404 Page : halaman tida ada kembali ke hom <a href='".base_url()."'>Home</a>";
    }
}
