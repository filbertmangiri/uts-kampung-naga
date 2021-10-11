<?php

namespace App\Models\Article;

use CodeIgniter\Model;

class CommentModel extends Model
{
	protected $table      = 'article_comments';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';

	protected $allowedFields = [
		'account_id',
		'article_id',
		'comment_text'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	protected $useSoftDeletes = false;
	// protected $deletedField  = 'deleted_at';

	// protected $validationRules    = [];
	// protected $validationMessages = [];
	// protected $skipValidation     = false;

	public function commentAdd($accountID, $articleID, $commentText)
	{
		try {
			$this->insert([
				'account_id' => $accountID,
				'article_id' => $articleID,
				'comment_text' => $commentText
			]);
		} catch (\Exception $e) {
			die($e->getMessage());
		}
	}

	public function commentGet($articleID = -1)
	{
		// if ($commentID === -1) {
		// 	return $this->findAll();
		// }

		return $this->where('article_id', $articleID)->findAll();
	}
}
