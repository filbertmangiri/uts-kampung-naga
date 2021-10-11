<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
	public function index()
	{
		\Config\Services::session()->destroy();

		return redirect()->to(base_url());
	}
}
