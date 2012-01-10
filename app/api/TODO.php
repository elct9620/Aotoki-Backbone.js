<?php
/**
 * TODO-List
 * 
 * @author Aotoki
 * @version 1.0
 */

$app->map('/api/note(/:id)', function($id = FALSE) use ($app){
	
	$requestMethod = $app->request()->getMethod();
	
	$app->response()->header('Content-Type', 'application/json');
	//$statusCode = 200;
	$result = array();
	
	$Note = Model::factory('Note');
	
	switch($requestMethod){
		case 'GET':
			if(!$id){
				$res = $Note->find_many();
				foreach($res as $r){
					$result[] = array('ID' => $r->ID, 'data' => $r->data);
				}
				
			}else{
				$result = $Note->find_one($id);
				if(!$result){
					//$statusCode = 404;
					$result = array('error' => array('text' => 'Nothing be found!'));
				}
				$result = array('ID' => $result->ID, 'data' => $result->data);
			}
			break;
		case 'POST':
			
			$data = json_decode($app->request()->getBody());
			if(!$data){
				$result = array('error' => array('text' => 'Nothing to add!'));
				break;
			}
			
			$result = $Note->create();
			$result->data = htmlspecialchars($data->data);
			$result->save();
			
			$result = array('ID' => $result->ID, 'data' => $result->data);
			
			break;
		case 'PUT':
			
			if(!$id){
				$result = array('error' => array('text' => 'Nothing be found!'));
				break;
			}
			
			$result = $Note->find_one($id);
			if(!$result){
				$result = array('error' => array('text' => 'Nothing be found!'));
				break;
			}
			$data = json_decode($app->request()->getBody());
			$result->data = htmlspecialchars($data->data);
			$result->save();
			
			$result = array('ID' => $result->ID, 'data' => $result->data);
			
			break;
		case 'DELETE':
			if(!$id){
				$result = array('error' => array('text' => 'Nothing be found!'));
				break;
			}
			
			$data = json_decode($app->request()->getBody());
			$result = $Note->find_one($id);
			if(!$result){
				$result = array('error' => array('text' => 'Nothing be found!'));
			}
			
			if($result->delete()){
				$result = array('success' => array('test' => 'Remove successed!'));
			}else{
				$result = array('error' => array('text' => 'Remove failed!'));
			}
			
			break;
		default:
			
	}
	
	//$app->response()->status($statusCode);
	print(json_encode($result));
	
})->via('GET', 'POST', 'PUT', 'DELETE');
