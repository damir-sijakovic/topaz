<?php

namespace Model;
use Sys\BaseModel;
use Sys\Utils;

class LoginModel extends BaseModel
{
    public function getByEmail($email) 
	{
		$validated = $this->validator::email()->validate($email);
		
		if ($validated)
		{
			$query = $this->queryBuilder		
			->select('name','password', 'email')
			->from('users', 'u')
			->where('u.email=:email')
			->setParameter('email', $email); 
			 
			return $query->execute()->fetch();
		}
		return null;	
	}	
}


