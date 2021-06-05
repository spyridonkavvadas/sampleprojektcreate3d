<?php
namespace ProcessWire;

class Example {
	public static function test () {
		return 'test successful';
	}

	public static function getAllUsers() {
		$response = [
			'users' => []
		];

		foreach(wire('users') as $user) {
			array_push($response['users'], [
				"id" => $user->id,
				"name" => $user->name
			]);
		}

		return $response;
	}
	//get all pages and childs
	public static function getAllPages() {
		$response = [
			'pages' => []
		];

		$childs = [
			"childrens" => []
		];

		$p = wire('pages')->find('template=project');
			
		foreach($p as $page) {

			$childs['childrens'] = [];

			foreach($page->children() as $child) {
				array_push($childs['childrens'],[
					"name" => $child->name,
					"body" => $child->body
				]);
			}
			
			array_push($response['pages'], [
				"id" => $page->id,
				"headline" => $page->getText('headline'),
				"body" => $page->getText('body'),
				'title' => $page->title,
				'childCount' => count($childs['childrens']),
				'children' => $childs		
			]);
		}

		return $response;
	}

	public static function getPage($data) {
		$data = AppApiHelper::checkAndSanitizeRequiredParameters($data, ['id|int']);
		
		$response = [
			'pages' => []
		];

		$childs = [
			"childrens" => []
		];

		$p = wire('pages')->find('id=' . $data->id);
			
		foreach($p as $page) {

			$childs['childrens'] = [];

			foreach($page->children() as $child) {
				array_push($childs['childrens'],[
					"name" => $child->name,
					"body" => $child->body,
					"pageUrl" => $page->httpUrl(),
				]);
			}
			
			array_push($response['pages'], [
				"id" => $page->id,
				"pageUrl" => $page->httpUrl(),
				"headline" => $page->getText('headline'),
				"body" => $page->getText('body'),
				'title' => $page->title,
				'childCount' => count($childs['childrens']),
				'children' => $childs		
			]);
	}

		return $response;
	}

	public static function getPagesCount() {
		$response = [
			'pages' => []
		];

		foreach(wire('pages') as $pages) {
			array_push($response['pages'], [
				"count" => $pages->count()
			]);
		}

		return $response;
	}


	public static function getAllModules() {
		$response = [
			'modules' => []
		];

		foreach(wire('modules') as $module) {
			array_push($response['modules'], [				
				"name" => $module->name				
			]);
		}

		return $response;
	}

	public static function getAllTemplates() {
		$response = [
			'templates' => []
		];

		foreach(wire('templates') as $template) {
			array_push($response['templates'], [				
				"id" => $template->id	,
				"name" => $template->name				
			]);
		}

		return $response;
	}

	public static function getUser($data) {
		$data = AppApiHelper::checkAndSanitizeRequiredParameters($data, ['id|int']);

		$response = new \StdClass();
		$user = wire('users')->get($data->id);

		if(!$user->id) throw new \Exception('User not found', 404);

		$response->id = $user->id;
		$response->name = $user->name;

		return $response;
	}
}