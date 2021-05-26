<?php

return [ 
	['GET',  '/',                       'App\HomeController::indexAction',           null ],
	['GET',  '/articles',               'App\ArticleController::indexAction',        \Middleware\ArticleMiddleware::class ],
	['GET',  '/articles/add',           'App\ArticleController::addAction',          \Middleware\ArticleMiddleware::class ],	
	['GET',  '/about',                  'App\AboutController::indexAction',          null ],
	['GET',  '/login',                  'App\LoginController::indexAction',          \Middleware\LoginMiddleware::class ],
	['GET',  '/logout',                 'App\LoginController::logoutAction',         null ],
	['GET',  '/login/unauthorized',     'App\LoginController::loginNullAction',      null ],
	['POST', '/logout/post',            'App\LoginController::logoutPostAction',     null ],
	['POST', '/login/post',             'App\LoginController::loginPostAction',      null ],
	['POST', '/articles/add/post',      'App\ArticleController::addPostAction',      \Middleware\PostMiddleware::class ],
	['POST', '/articles/getId/post',    'App\ArticleController::getByIdPostAction',  \Middleware\PostMiddleware::class ],
	['POST', '/articles/deleteId/post', 'App\ArticleController::deleteIdPostAction', \Middleware\PostMiddleware::class ],
];


