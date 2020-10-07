<?php

namespace App\Models;

use Core\BaseModel;

class Post extends BaseModel
{
	protected $table = "posts";

	public function rules()
	{
		return [
			'title' => 'required|min:2',
			'content' => 'min:10'
		];
	}
}
