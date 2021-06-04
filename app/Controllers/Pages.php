<?php 

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		return view('home');
	}

	//--------------------------------------------------------------------

	public function coba()
	{
		$data = [
			'title' => 'Kegiatan Pendidikan'
		];

		return view('pendidikan/index', $data);
	}

}
