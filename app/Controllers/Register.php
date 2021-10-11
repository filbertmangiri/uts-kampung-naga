<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Register extends BaseController
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
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$error_message = $this->accountModel->accountInsert($_POST, $_FILES);

			if (empty($error_message)) {
				return redirect()->to(base_url());
			}

			return redirect()->to(base_url('register'));
		}

		$data = [
			'title' => 'Daftar'
		];

		return view('account/register', $data);
	}

	public function emailCheck()
	{
		if ($this->accountModel->isEmailExist($this->request->getVar('email')))
			echo 'false';
		else
			echo ' true';
	}

	public function usernameCheck()
	{
		if ($this->accountModel->isUsernameExist($this->request->getVar('username')))
			echo 'false';
		else
			echo ' true';
	}
}
