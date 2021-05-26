<?php

namespace Sys;


class Users
{
	static function setRoleUser()
	{
		self::setRoleChangeTime();
		return SystemSession::set('user_role', TOPAZ_USER_USER);		
	}
	
	static function setRoleAdmin()
	{
		self::setRoleChangeTime();
		return SystemSession::set('user_role', TOPAZ_USER_ADMIN);
	}
	
	static function setRoleGuest()
	{
		self::setRoleChangeTime();
		return SystemSession::set('user_role', TOPAZ_USER_GUEST);
	}
	
	static function setRoleBanned()
	{		
		self::setRoleChangeTime();
		return SystemSession::set('user_role', TOPAZ_USER_BANNED);
	}
	
	static function setRoleNotVerified()
	{
		self::setRoleChangeTime();
		return SystemSession::set('user_role', TOPAZ_USER_NOTVERIFIED);
	}
	
	static function isRoleUser()
	{
		if (SystemSession::get('user_role') === TOPAZ_USER_USER)
		{
			return true;
		}
		return false;
	}
	
	static function isRoleAdmin()
	{
		if (SystemSession::get('user_role') === TOPAZ_USER_ADMIN)
		{
			return true;
		}
		return false;
	}
	
	static function isRoleGuest()
	{
		if (SystemSession::get('user_role') === TOPAZ_USER_GUEST)
		{
			return true;
		}
		return false;
	}
	
	static function isUserLoggedOn()
	{
		if (SystemSession::get('user_role') !== TOPAZ_USER_GUEST)
		{
			return true;
		}
		return false;
	}
	
	static function logout()
	{
		self::setRoleChangeTime();
		SystemSession::set('user_role', TOPAZ_USER_GUEST);
        UserSession::destroy();
        SystemSession::delete('jwt');
		self::deleteUserId();
        self::deleteUserRand8();
	}
	
	static function login($id)
	{
		self::setRoleChangeTime();
		SystemSession::set('user_role', TOPAZ_USER_USER);
        self::setUserRand8();
		self::setUserId($id);
	}
    
    static function getJwt()
	{
		return UserSession::get('jwt');		
	}
    
    static function jwtExists()
	{
       return  UserSession::keyExists('jwt');
	}    
	      
	static function isJwtExpired()
	{
        $token = self::getJwt();
        
        if ($token)
        {
            return Encrypt::isTokedExpired($token);
        }   
	}	
        
	static function isJwtValid($token)
	{
        if (is_string($token))
        {
            return Encrypt::verifyToken($token);
        }   
        
        return false;
	}        
        
	static function isRoleBanned()
	{
		if (SystemSession::get('user_role') === TOPAZ_USER_BANNED)
		{
			return true;
		}
		return false;
	}
	
	static function isRoleNotVerified()
	{
		if (SystemSession::get('user_role') === TOPAZ_USER_NOTVERIFIED)
		{
			return true;
		}
		return false;					
	}	
		
	static function haveRole()
	{
		if (SystemSession::keyExists('user_role'))
		{
			return true;
		}
		
		return false;					
	}
	
	static function setRoleChangeTime()
	{
		return SystemSession::set('user_role_changed_at', date("Y-m-d H:i:s"));
	}
	
	static function setUserId($id)
	{
		return SystemSession::set('user_id', $id);
	}
	
	static function getUserId()
	{
		return SystemSession::get('user_id');
	}
	
	static function deleteUserId()
	{
		return SystemSession::delete('user_id');
	}	
	
	static function haveUserId()
	{
		if (SystemSession::keyExists('user_id'))
		{
			return true;
		}
		
		return false;					
	}

	static function setUserRand8()
	{
		return SystemSession::set('user_rand8', Encrypt::generateRand8());
	}
	
	static function getUserRand8()
	{
		return SystemSession::get('user_rand8');
	}
	
	static function deleteUserRand8()
	{
		return SystemSession::delete('user_rand8');
	}	
	
	static function haveUserRand8()
	{
		if (SystemSession::keyExists('user_rand8'))
		{
			return true;
		}
		
		return false;					
	}

/*
	static function validateUserRand8()
	{
        
        $jwt = Cookie::get('Authorization'); 
        $jwt = str_replace('Bearer ', '', $jwt);
        
        
		if (SystemSession::keyExists('user_rand8'))
		{
			return true;
		}
		
		return false;					
	}
*/
	
	static function getRole()
	{
		return SystemSession::get('user_role');				
	}
	
	static function getRequestId()
	{
		return SystemSession::get('request_id');				
	}
	
	static function checkRequestId($id)
	{
        if (strval($id) === strval(SystemSession::get('request_id')))
        {
            return true;
        }

		return false;			
	}
    
	static function setCsrf()
	{
        $csrf = Encrypt::generateCsrfToken();                 
        SystemSession::set('csrf', $csrf);
        
		return $csrf;			
	}
        
    static function getCsrf()
	{
		return SystemSession::get('csrf');		
	}	
    
    static function isCsrfValid($csrf)
	{     
		if ($csrf === SystemSession::get('csrf'))
        {
            return true;
        }	
        return false;
	}	
    
	static function setJwt($userId, $exp, $nbf=null)
	{        
        $jwt = Encrypt::generateToken($userId, $exp, $nbf);
        SystemSession::set('jwt', $jwt);
        
		return $jwt;			
	}
	

    
    static function loginJwt($nameId)
	{      
        self::login($nameId);
        $id = self::getUserRand8();
        
        $exp = strtotime(TOPAZ_JWT_EXP);
        if (TOPAZ_JWT_NBF)
        {
            $nbf = strtotime(TOPAZ_JWT_NBF);
        }   
        else
        {
            $nbf = null;
        }
             
        $jwt = self::setJwt($id, $exp, $nbf); 
        SystemSession::set('jwt', $jwt);  
        Cookie::set('Authorization', 'Bearer ' . $jwt); //it's httpOnly
        return $jwt; 
	}
    
    static function isLoginValidJwt()
	{   
        $jwt = Cookie::get('Authorization'); 
        if ($jwt)
        {
            $jwt = str_replace('Bearer ', '', $jwt);
            
            try{
                self::isJwtValid($jwt);              
            } catch (\Exception $e) 
            {
               return false;
            }            

            return true;
        }
        
        return false;
	}
    

    
    static function logoutJwt($csrf)
	{      
        if ((self::getCsrf() === $csrf) && Cookie::keyExists('Authorization'))
        { 
            //$jwt = Cookie::get('Authorization').
            //$jwt = str_replace('Bearer ', '', $jwt);
            Cookie::delete('Authorization');
            self::logout();
        }
	} 
    
    static function forceLogoutJwt()
	{      
        if (Cookie::keyExists('Authorization'))
        { 
            Cookie::delete('Authorization');
            self::logout();
        }
	} 
    
    

}
