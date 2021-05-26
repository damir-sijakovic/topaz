<?php

namespace Sys;

class BaseController
{
	protected $twig;
	protected $validator;
	protected $stream;
	
	
	public function __construct() 
	{
		$this->twig = ServiceContainer::get('twig');
		$this->validator = ServiceContainer::get('validator');
		$this->stream = ServiceContainer::get('stream');
	}
	
	

}


