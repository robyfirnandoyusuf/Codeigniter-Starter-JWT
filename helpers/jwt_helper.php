<?php 
    require_once APPPATH . '/libraries/JWT.php';
    require_once APPPATH . '/libraries/BeforeValidException.php';
    require_once APPPATH . '/libraries/ExpiredException.php';
    require_once APPPATH . '/libraries/SignatureInvalidException.php';
    use \Firebase\JWT\JWT;

    function output($status, $message, $data = array())
    {
        $output['status'] = $status;
        $output['message'] = $message;
        if($data) {
            $output['data'] = $data;
        }

        return $output;
    }

    function verifyToken(){
        $CI =& get_instance();

        $secretkey = 'Bl4ckCat!!!!';
        $jwt = $CI->input->get_request_header('Authorization');

        try {
            $decode = JWT::decode($jwt,$secretkey,array('HS256'));
            if ($decode) 
            {
                return true;
            }
        } catch (Exception $e) {
            exit(json_encode((output(401, $e->getMessage()))));
        }
    }
