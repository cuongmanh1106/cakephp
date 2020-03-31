<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;

class HomeController extends AppController
{
	public $url;
	public function initialize() {
		parent::initialize();
		$this->url = Router::url('/',true);
		$this->connection = ConnectionManager::get('default');
		$this->viewBuilder()->layout('UserLayout'); //default is default template
	}
	public function index() {
		var_dump($this->url);
		$this->set('title','Welcome Harrik!');
		$name = 'Harrik';
		$job = 'IT';
		$this->set(compact('name','job'));
		$this->Flash->set('The user has been saved',['element' => 'success']);
	}	

	public function contactUs() {
		$this->autoRender = false;
		print_r($this->request->params['pass']);
	}

	public function insertdata() {
		// $this->connection->insert("users",[
		// 	"name" => "Harrik",
		// 	"username" => "Test",
		// 	"password" => "12321321",
		// 	"email" => "cuong106@gmail.com"

		// ])

		$this->connection->update("users",[
			"email" => "harrik1106@gmail.com"
		],
		[
			//condition
			"id" => 4
		]);
	}

	

}
?>
