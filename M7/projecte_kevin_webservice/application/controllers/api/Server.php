<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Server extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
    
    public function comprovacioLogin_post()
    {
        $app_key=$this->post("APP_KEY");
        $secret=$this->post("SECRET");
        $this->load->model('usuaris');
        $aux=$this->usuaris->getToken($secret, $app_key);
        //var_dump($aux);
        $this->set_response($aux,REST_Controller::HTTP_OK);
    }
	
	public function tancarComanda_post()
	{
		$com_num=$this->post("comanda");
		$secret=$this->post("secret");
		$app_key=$this->post("app_key");
		$this->load->model("usuaris");
		$token=$this->usuaris->getToken($secret, $app_key);
		// var_dump($token);
		// exit;
		if($token==null){//si no hi ha token
			$this->set_response(null,REST_Controller::HTTP_OK);
		}
		$this->load->model("comanda");
		$info_comanda=$this->comanda->tancarComanda($com_num);
		$this->set_response($info_comanda, REST_Controller::HTTP_OK);
	}
	
	public function mostrarCatesFiltre_post()
	{
		$filtre=$this->post('filtre');
		$this->load->model('cata');
		$resultat=$this->cata->getAllFiltre($filtre);
		//$info=$this->producte->getProducte($prod);
		$this->set_response($resultat, REST_Controller::HTTP_OK);
	}
	
	public function mostrarCatesAll_get(){
		$this->load->model('cata');
		$resultat=$this->cata->getAllDetallat();
		$this->set_response($resultat,REST_Controller::HTTP_OK);
		
	}

    

}

