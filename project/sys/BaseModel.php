<?php

namespace Sys;

class BaseModel
{
	protected $queryBuilder;
	protected $validator;
		
	
	public function __construct() 
	{
		$this->queryBuilder = ServiceContainer::get('queryBuilder');
		$this->validator = ServiceContainer::get('validator');
	}
	
	

}


