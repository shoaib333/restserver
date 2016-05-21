<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Example extends REST_Controller
{
	function user_get()
    {

        $this->load->database();

        /*If phone Number is not passed*/
        if(!$this->get('phoneNumber'))
        {
         $this->response(NULL, 400);
        }

        $queryString = 'SELECT name, email, phoneNumber,autoCallEnable FROM ideameter WHERE phoneNumber=' . $this->get('phoneNumber');
        
        $query = $this->db->query(('SELECT name, email, phoneNumber,autoCallEnable FROM ideameter WHERE phoneNumber=' . $this->get('phoneNumber')));

        //check if record found
        if ($query->num_rows() > 0)
        {
            $user = array('name' => $query->row(0)->name,
                          'email'=> $query->row(0)->email,
                          'autoCallEnable'=> $query->row(0)->autoCallEnable);
            
            $this->response($user, 200);
        }
        else
        {
            $user = array('name' => "None",
                          'email'=> "None",
                          'autoCallEnable'=> "None");
            
            $this->response($user, 200);
        }

    }
    
    //to updat the contents of a user
    function signup_get()
    {
        $this->load->database();

        $name = $this->get('name');
        $email = $this->get('email');
        $phoneNumber = $this->get('phoneNumber');
        $password = $this->get('password');
        $autoCallEnable = 'false';

        //if anything is missing
        if(!$name or !$email or !$phoneNumber or !$password)
        {
            $user = array('name' => "None",
              'email'=> "None",
              'autoCallEnable'=> "None");
            
            $this->response($user, 200);
        }


        $data = array('name' => $name,
                      'email'=> $email,
                      'phoneNumber' => $phoneNumber,
                      'password' => $password,
                      'autoCallEnable'=> $autoCallEnable,
                      'token' => '00');

        $this->db->insert('ideameter', $data);
        $this->response('Successful', 200);

    }

    function user_put()
    {

        //         UPDATE ideameter
        // SET name = 'msho', email='msho@msho.com' WHERE phoneNumber=123


        $this->load->database();

        $name = $this->get('name');
        $email = $this->get('email');
        $phoneNumber = $this->get('phoneNumber');
        $password = $this->get('password');
        $autoCallEnable = 'false';

        //if anything is missing
        if(!$name or !$email or !$phoneNumber or !$password)
        {
            $user = array('name' => "None",
              'email'=> "None",
              'autoCallEnable'=> "None");
            
            $this->response($user, 200);
        }


        $data = array('name' => $name,
                      'email'=> $email,
                      'phoneNumber' => $phoneNumber,
                      'password' => $password,
                      'autoCallEnable'=> $autoCallEnable,
                      'token' => '00');

        $this->db->insert('ideameter', $data);
        $this->response('Successful', 200);



    }
    
    function user_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
			array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
			array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }


	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
}