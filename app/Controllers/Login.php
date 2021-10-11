<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Login extends BaseController
{
	protected $accountModel;

	public function __construct()
	{
		$this->accountModel = new AccountModel();
	}

	public function __destruct()
	{
		unset($this->accountModel);
	}

	public function index()
	{
		$data = [
			'title' => 'Login'
		];

		return view('account/login', $data);
	}

	public function submit()
	{
		$error_message = $this->accountModel->accountCheck($this->request->getVar());

		if (empty($error_message)) {
			return redirect()->to(base_url());
		}

		return redirect()->to(base_url('login'));
	}
}
