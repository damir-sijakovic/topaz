<?php

namespace Sys;
use DI\ContainerBuilder;

class ServiceContainer
{
	private function __construct() {}
	private function __clone() {}
	
	static public function get(string $service)
	{
		static $t = null;
		
		if (is_null($t))
		{
			$containerBuilder = new ContainerBuilder();
			$containerBuilder->addDefinitions( TOPAZ_SERVICES_FILE );
			$t = $containerBuilder->build();
			return $t->get($service);

		}
		else
		{
			return $t->get($service);
		}	
	}
}


