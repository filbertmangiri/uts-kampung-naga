<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Article\ArticleModel;
use App\Models\Article\CategoryModel;
use App\Models\Article\LikeModel;
use App\Models\Article\CommentModel;
use App\Models\Article\CommentLikeModel;

class Article extends BaseController
{
	protected $articleModel;
	protected $commentModel;

	public function __construct()
	{
		$this->articleModel = new ArticleModel();
		$this->commentModel = new CommentModel();
	}

	public function __destruct()
	{
		unset($this->articleModel);
	}

	public function index()
	{
		$data = [
			'title' => 'Beranda',
			'articles' => $this->articleModel->articleGet()
		];

		return view('articles/index', $data);
	}

	public function category($categorySlug)
	{
		$data = [
			'title' => 'Beranda',
			'articles' => $this->articleModel->articleGetByCategory($categorySlug)
		];

		return view('articles/index', $data);
	}

	public function detail($titleSlug = '')
	{
		if (empty($titleSlug)) {
			return redirect()->to(base_url());
		}

		$data['detail'] = $this->articleModel->articleGet($titleSlug);
		$data['title'] = $data['detail']['title'];
		$data['comments'] = $this->commentModel->commentGet($data['detail']['id']);

		return view('articles/detail', $data);
	}

	public function addComment($articleID = -1)
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $articleID === -1) {
			return redirect()->to(base_url());
		}

		$this->commentModel->commentAdd(\Config\Services::session()->get('id'), $articleID, $this->request->getVar('comment_text'));
	}
}
