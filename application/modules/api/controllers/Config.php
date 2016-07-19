<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends API_Controller {

	/**
	 * @SWG\Get(
	 * 	path="/config",
	 * 	tags={"config"},
	 * 	summary="Get app config",
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Config object",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Config"))
	 * 	)
	 * )
	 */
	public function index_get()
	{
		$this->load->model('config_model', 'configs');
		$config = $this->configs->get(1);
		$this->response($config);
	}
}
