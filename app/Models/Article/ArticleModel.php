<?php

namespace App\Models\Article;

use CodeIgniter\Model;

class ArticleModel extends Model
{
	protected $table      = 'articles';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';

	protected $allowedFields = [
		'title',
		'title_slug',
		'category',
		'category_slug',
		'thumbnail',
		'author',
		'content'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	protected $useSoftDeletes = false;
	// protected $deletedField  = 'deleted_at';

	// protected $validationRules    = [];
	// protected $validationMessages = [];
	// protected $skipValidation     = false;

	public function articleGet($titleSlug = '')
	{
		if (empty($titleSlug)) {
			return $this->findAll();
		}

		return $this->where('title_slug', $titleSlug)->first();
	}

	public function articleGetByID($articleID = -1)
	{
		if ($articleID === -1) {
			return $this->findAll();
		}

		return $this->where('id', $articleID)->first();
	}

	public function articleGetByCategory($categorySlug = '')
	{
		if (empty($categorySlug)) {
			return $this->findAll();
		}

		return $this->where('category_slug', $categorySlug)->findAll();
	}

	public function articleInsert($post, $files)
	{
		$error_message = '';

		try {
			$this->insert([
				'title' => $post['title'],
				'title_slug' => url_title($post['title'], '-', true),
				'category' => $post['category'],
				'category_slug' => url_title($post['category'], '-', true),
				'thumbnail' => 'default.jpg',
				'author' => $post['author'],
				'content' => $post['content']
			]);

			$insertedID = $this->getInsertID();

			$ekstensiGambar = explode('.', $files['thumbnail']['name']);
			$ekstensiGambar = strtolower(end($ekstensiGambar));
			$nama_file_baru = 'article_id_' . $insertedID . '.' . $ekstensiGambar;

			move_uploaded_file($files['thumbnail']['tmp_name'], 'images/thumbnails/' . $nama_file_baru);

			$this->update($insertedID, ['thumbnail' => $nama_file_baru]);
		} catch (\Exception $e) {
			dd($e->getMessage());
			$error_message = 'Gagal membuat artikel. Silakan coba beberapa saat lagi';

			if ($e->getCode() == '1062') {
				$error_message = 'Judul artikel telah digunakan';
			}
		}

		\Config\Services::session()->setFlashData('article_insert_error_msg', $error_message);

		return $error_message;
	}

	public function articleEdit($articleID, $data)
	{
		$error_message = '';

		try {
			$updateData = [
				'title' => $data['title'],
				'title_slug' => url_title($data['title'], '-', true),
				'category' => $data['category'],
				'category_slug' => url_title($data['category'], '-', true),
				'author' => $data['author'],
				'content' => $data['content'],
			];

			$this->update($articleID, $updateData);
		} catch (\Exception $e) {
			$error_message = 'Gagal meng-update artikel. Silakan coba beberapa saat lagi';

			if ($e->getCode() == '1062') {
				$error_message = 'Judul artikel telah digunakan';
			}
		}

		\Config\Services::session()->setFlashData('article_edit_error_msg', $error_message);

		return $error_message;
	}

	public function articleDelete($articleID)
	{
		// return $this->db->table($this->$table)->delete(['']);
		try {
			$this->delete($articleID);
		} catch (\Exception $e) {
			die($e->getMessage());
		}
	}
}
