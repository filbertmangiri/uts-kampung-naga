<?php

namespace App\Models\Article;

use CodeIgniter\Model;

class CommentLikeModel extends Model
{
	protected $table      = 'article_comment_likes';
	protected $primaryKey = 'pk_comment_like';

	// protected $useAutoIncrement = true;

	protected $returnType     = 'array';

	protected $allowedFields = [
		'account_id',
		'comment_id'
	];

	protected $useTimestamps = false;
	// protected $createdField  = 'created_at';
	// protected $updatedField  = 'updated_at';

	protected $useSoftDeletes = false;
	// protected $deletedField  = 'deleted_at';

	// protected $validationRules    = [];
	// protected $validationMessages = [];
	// protected $skipValidation     = false;
}
