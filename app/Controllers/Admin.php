<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Article\CategoryModel;
use App\Models\Article\ArticleModel;

class Admin extends BaseController
{
	protected $articleModel;
	protected $categoryModel;

	public function __construct()
	{
		$this->articleModel = new ArticleModel();
		$this->categoryModel = new CategoryModel();
	}

	public function index()
	{
		$session = \Config\Services::session();

		if ($session->get('is_admin') !== true) {
			return redirect()->to(base_url());
		}

		$data = [
			'title' => 'Admin',
			'articles' => $this->articleModel->articleGet()
		];

		return view('admin/index', $data);
	}

	public function insert()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$error_message = $this->articleModel->articleInsert($_POST, $_FILES);

			if (empty($error_message)) {
				return redirect()->to(base_url('admin'));
			}

			return redirect()->to(base_url('admin/insert'));
		}

		$data = [
			'title' => 'Admin | Insert',
			'categories' => $this->categoryModel->categoryGetAll()
		];

		return view('admin/insert', $data);
	}

	public function edit($articleID = -1)
	{
		if ($articleID === -1) {
			return redirect()->to(base_url('admin/edit'));
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$error_message = $this->articleModel->articleEdit($articleID, $_POST);

			if (empty($error_message)) {
				return redirect()->to(base_url('admin'));
			}

			return redirect()->to(base_url('admin/edit'));
		}

		$data = [
			'title' => 'Admin | Edit',
			'article' => $this->articleModel->articleGetByID($articleID),
			'categories' => $this->categoryModel->categoryGetAll()
		];

		return view('admin/edit', $data);
	}

	public function delete()
	{
		$articleID = $this->request->getVar('articleID');

		if ($articleID !== -1) {
			$this->articleModel->articleDelete($articleID);
		}

		return redirect()->to(base_url('admin'));
	}
}
