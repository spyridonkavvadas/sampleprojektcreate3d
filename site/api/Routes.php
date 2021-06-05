<?php
namespace ProcessWire;

require_once wire('config')->paths->AppApi . "vendor/autoload.php";
require_once wire('config')->paths->AppApi . "classes/AppApiHelper.php";

require_once __DIR__ . "/Example.php";

$routes = [
  	['OPTIONS', 'test', ['GET']], // this is needed for CORS Requests
  	['GET', 'test', Example::class, 'test'],
		['GET', 'pages', Example::class, 'getAllPages'],		
		['GET', 'pagescount', Example::class, 'getPagesCount'],
		['GET', 'modules', Example::class, 'getAllModules'],
		['GET', 'templates', Example::class, 'getAllTemplates'],
  	'page' => [			
			['OPTIONS', '{id:\d+}', ['GET']], // this is needed for CORS Requests
    	['GET', '{id:\d+}', Example::class, 'getPage', ["auth" => false]], // check: https://github.com/nikic/FastRoute
    ],
		'users' => [
			['OPTIONS', '', ['GET']], // this is needed for CORS Requests
			['GET', '', Example::class, 'getAllUsers', ["auth" => false]],
			['OPTIONS', '{id:\d+}', ['GET']], // this is needed for CORS Requests
    	['GET', '{id:\d+}', Example::class, 'getUser', ["auth" => false]], // check: https://github.com/nikic/FastRoute
    ],
];