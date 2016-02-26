<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Examples to work with REST endpoints
 */
class Example extends API_Controller {

	/**
	 * @SWG\Get(
	 * 	path="/example",
	 * 	tags={"example"},
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Sample result",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Example"))
	 * 	)
	 * )
	 */
	public function index_get()
	{
		$data = array(
			array('id' => 1, 'name' => 'Demo 1'),
			array('id' => 2, 'name' => 'Demo 2'),
			array('id' => 3, 'name' => 'Demo 3'),
		);
		$this->response($data);
	}

	/**
	 * @SWG\Post(
	 * 	path="/example",
	 * 	tags={"example"},
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="Created info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/Example")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function index_post()
	{
		$params = elements(array('filter', 'valid', 'fields', 'here'), $this->post());
		$this->created();
	}

	/**
	 * @SWG\Get(
	 * 	path="/example/{id}",
	 * 	tags={"example"},
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Example ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Sample result",
	 * 		@SWG\Schema(ref="#/definitions/Example")
	 * 	)
	 * )
	 */
	public function id_get($id)
	{
		$data = array('id' => $id, 'name' => 'Demo '.$id);
		$this->response($data);
	}

	/**
	 * @SWG\Put(
	 * 	path="/example/{id}",
	 * 	tags={"example"},
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Example ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function id_put($id)
	{
		$params = elements(array('filter', 'valid', 'fields', 'here'), $this->put());
		$this->error_not_implemented();
	}

	/**
	 * @SWG\Delete(
	 * 	path="/example/{id}",
	 * 	tags={"example"},
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Example ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function id_delete($id)
	{
		$this->accepted();
	}
	
	/**
	 * @SWG\Get(
	 * 	path="/example/{id}/subitem",
	 * 	tags={"example"},
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Example ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Sample result",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Example"))
	 * 	)
	 * )
	 */
	public function subitem_get($parent_id)
	{
		$data = array(
			array('id' => 1, 'name' => 'Parent '.$parent_id.' - Subitem 1'),
			array('id' => 2, 'name' => 'Parent '.$parent_id.' - Subitem 2'),
			array('id' => 3, 'name' => 'Parent '.$parent_id.' - Subitem 3'),
		);
		$this->response($data);
	}
}
