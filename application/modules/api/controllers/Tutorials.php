<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorials extends API_Controller {

	/**
	 * @SWG\Get(
	 * 	path="/tutorials",
	 * 	tags={"tutorials"},
	 * 	summary="Look up tutorial list by code",
	 * 	@SWG\Parameter(
	 * 		in="query",
	 * 		name="code",
	 * 		description="Tutorial List Code",
	 * 		required=true,
	 * 		type="string"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Tutorial List object",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/TutorialList"))
	 * 	)
	 * )
	 */
	public function index_get()
	{
		$this->load->model('tutorial_model', 'tutorials');
		$this->load->model('tutorial_list_model', 'lists');
		
		$code = $this->input->get('code');
		$data = $this->lists->get_by(array('code' => $code));

		if ( empty($data) )
			$this->error_not_found();

		$data->tutorials = $this->tutorials->get_by_list_id($data->id);
		$this->response($data);
	}

	/**
	 * @SWG\Get(
	 * 	path="/tutorials/{id}",
	 * 	tags={"tutorials"},
	 * 	summary="Look up a tutorial",
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Tutorial ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Tutorial object",
	 * 		@SWG\Schema(ref="#/definitions/Tutorial")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="404",
	 * 		description="Invalid tutorial ID"
	 * 	)
	 * )
	 */
	public function id_get($id)
	{
		$this->load->model('tutorial_model', 'tutorials');
		$data = $this->tutorials->get($id);

		if ( empty($data) )
			$this->error_not_found();

		$this->response($data);
	}
}
