<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
use \Firebase\JWT\JWT;

class AuthAPI extends REST_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('jwt');
    }

	public function token_get()
	{
		$date = new DateTime();
		$token['iat'] = $date->getTimestamp();
		$token['exp'] = $date->getTimestamp() + 60*60*5;
		$token = JWT::encode($token, "Bl4ckCat!!!!");

		$data = array(
			'token' => $token
		);
		$this->response(output(200, 'OK', $data), REST_Controller::HTTP_OK);
	}


	public function testing_get()
    {
        //put it to verify is the token valid
        verifyToken();

        $this->response(output(200, 'Wokeh !'), REST_Controller::HTTP_OK);
    }
}

/* End of file DummyApi.php */
/* Location: ./application/controllers/DummyApi.php */