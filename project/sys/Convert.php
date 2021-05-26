<?php 

namespace Sys;

class Convert
{
	
	public static function serialize($data) 
	{		
		return serialize($data);
	}

	public static function unserialize($data) 
	{		
		return unserialize($data);
	}
	
	public static function toBase64($data) 
    {
		return base64_encode($data);
    }
    
	public static function fromBase64($data) 
    {
		return base64_decode($data);
    }
    
	public static function toEntity($data) 
    {
		return htmlentities($data);
    }
    
	public static function fromEntity($data) 
    {
		return html_entity_decode($data);
    }
	
	public static function byteSizeToHuman($size) 
    {
		$bytes = floatval($size);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach($arBytes as $arItem)
        {
            if($bytes >= $arItem["VALUE"])
            {
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
                break;
            }
        }
        return $result;
    }
	
    
    	
}; 
	
	
	
	
	
	
	
	


