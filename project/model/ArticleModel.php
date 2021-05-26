<?php

namespace Model;
use Sys\BaseModel;
use Sys\Utils;

class ArticleModel extends BaseModel
{
	
	public function add($title, $body) 
	{
		// see respect/validation docs
		$titleOk = $this->validator::stringType()->length(1, 64)->validate($title);
		$bodyOk = $this->validator::stringType()->length(1, 1024)->validate($body);
		
		if ($titleOk && $bodyOk)
		{

			$query = $this->queryBuilder
			->insert('articles')
			->setValue('title', '?')
			->setValue('body', '?')
			->setParameter(0, $title)
			->setParameter(1, $body);
			
			return $query->execute();
		}
		else
		{
			return null;
		}
	}

	public function getAll() 
	{
		$query = $this->queryBuilder
		->select('id', 'title', 'created')
		->from('articles');
		
		return $query->execute()->fetchAll();
	}
	
	public function getById($id) 
	{
		$idOk = $this->validator::intType()->validate($id);
		
		if ($idOk)
		{
			$query = $this->queryBuilder		
			->select('title','body')
			->from('articles', 'a')
			->where('a.id=:id')
			->setParameter('id', $id); 
			 
			return $query->execute()->fetch();
		}
		return null;	
	}
	
	public function deleteId($id) 
	{
		$idOk = $this->validator::intType()->validate($id);
		
		if ($idOk)
		{
			$query = $this->queryBuilder		
			->delete('articles')
			->where('id=:id')
			->setParameter('id', $id); 
			 
			return $query->execute();
		}
		return null;
	}

	
}


