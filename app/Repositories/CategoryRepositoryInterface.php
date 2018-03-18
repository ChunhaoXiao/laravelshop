<?php
namespace App\Repositories;

interface CategoryRepositoryInterface
{
	function filter($category, $attribute) ;

	function create(Array $attribute);

	function update($id, array $attribute);

	function delete($id);

	function find($id);

	function paginate($num);

	function categoryTree($parent_id) ;
}

