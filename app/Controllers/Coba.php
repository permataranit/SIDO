<?php namespace App\Controllers;

class Coba extends BaseController
{
	public function index()
	{
        return view('welcome_message');
    }

    //--------------------------------------------------------------------
    
    public function about($nama = '', $umur = 0)
	{
		echo "Halo, nama saya $nama, umur saya $umur";
    }
    
    //--------------------------------------------------------------------
	
}