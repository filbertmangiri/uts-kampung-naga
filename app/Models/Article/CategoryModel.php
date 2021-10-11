<?php

namespace App\Models\Article;

use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $table      = 'categories';
	protected $primaryKey = 'category';

	// protected $useAutoIncrement = true;

	protected $returnType     = 'array';

	protected $allowedFields = [
		'category',
		'category_slug',
	];

	// protected $useTimestamps = true;
	// protected $createdField  = 'created_at';
	// protected $updatedField  = 'updated_at';

	protected $useSoftDeletes = false;
	// protected $deletedField  = 'deleted_at';

	// protected $validationRules    = [];
	// protected $validationMessages = [];
	// protected $skipValidation     = false;

	public function categoryGetAll()
	{
		return $this->findAll();
	}
}
