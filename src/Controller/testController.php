<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class testController extends AppController
{
	public $url;
	private $table;
	public function initialize() {
		parent::initialize();
		$this->url = Router::url('',true);
		$this->connection = ConnectionManager::get('default');
		$this->viewBuilder()->layout('UserLayout'); //default is default template
		$this->table = TableRegistry::get("users");
		$this->loadModel("Fruits");
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

		// $this->connection->update("users",[
		// 	"email" => "harrik1106@gmail.com"
		// ],
		// [
		// 	//condition
		// 	"id" => 4
		// ]);
		// 
		$this->connection->delete("users",[
			"id" => 4
		]);
		
		
	}

	public function selectdata() {
		$this->autoRender  = false;
		// $datas = $this->connection->execute("SELECT * from users where id = :id",["id" => 2])->fetchAll('assoc');
		$datas = $this->connection->newQuery()->select("*")->from("users")->order(["id"=>"desc"])->execute()->fetch('assoc');
		foreach($datas as $data) {
			var_dump($data);
		}
	}

	public function tabledata() {
		$this->autoRender = false;
		$tableIns = $this->table->newEntity();

		$tableIns['name'] = "test Table";
		$tableIns['username'] = "Harrik write";
		$tableIns['password'] = '123123123';
		$tableIns['email'] = 'cuongtable@gmail.com';

		$this->table->save($tableIns);
		echo $tableIns->id;
	}

	public function selecttable() {
		$this->autoRender = false;
		// $datas = $this->table->find('all',[
		// 	"conditions" => ["id" => 2],
		// 	"order" => ["id" => "desc"],
		// 	"limit" => 2
		// ])->toList();

		$datas = $this->table->find('all')->select(["name","email"])->order(['id'=>'desc'])->limit(4)->toArray(); 
		foreach ($datas as $key => $value) {
			print_r($value->name);
			
		}
	}

	public function updatedata() {
		$this->autoRender = false;
		$data = $this->table->get(2);
		
		$data->name = "Hello";
		$data->username = "Harrik";
		$data->password = "hello harrik";
		$data->email = "harrik1231@gmail.com";
		$this->table->save($data);
	}

	public function deletedata() {
		$this->autoRender = false;
		$data = $this->table->get(2);
		$this->table->delete($data);
	}

	public function insertmodel() {
		$this->autoRender = false;
		// $fruitsObj = $this->Fruits->newEntity();

		// $fruitsObj->name = "Apple";
		// $fruitsObj->description = "Sweet & yummy";
		// $this->Fruits->save($fruitsObj);
		
		$fruitsObjQuery = $this->Fruits->query();

		$fruitsObjQuery->insert(["name","description"])->values(["name"=>"Mango", "description"=>"King of fruits"])->execute();
	}

	public function getdatamodel() {
		$this->autoRender = false;
		$data = $this->Fruits->find('all',[
			// "conditions" => ["id"=>1]
			"order" => ["id" => "desc"]
		])->toArray();

		foreach ($data as $key => $value) {
			echo $value->name . "<br />";
		}
	}

	public function updatemodel() {
		$this->autoRender = false;
		// $data = $this->Fruits->get(2);
		// $data->name = "Orange";
		// $this->Fruits->save($data);
		
		$data = $this->Fruits->query();
		$data->update()->set(
			[
				"name" => "Grapes",
				"description" => "this is update fruit"
			]
		)->where([
			"id" => 2
		])->execute();


	}


	public function deletemodeldata() {
		$this->autoRender = false;

		// $data = $this->Fruits->get(1);
		// $this->Fruits->delete($data);
		
		$data = $this->Fruits->query();
		$data->delete()->where([
			"id" => 2
		])->execute();
	}

	public function testdatavalidate() {
		$this->autoRender = false;

		$validator = new Validator;

		$req_data = array(
			"name" => "asdadsa",
			"email" => "cuongmanh110@gmail.com",
			"age" => 23,
			"url" => 'http://google.com'
		);

		//rules
		$validator->requirePresence("name","create","Name field should be needed")
		->add("name","length",[
			"rule" => ["minLength",6],
			"message" => "Name Should min length > 5"
		])
		->requirePresence("email", "create", "Email Should be needed")
		->add("email",[
			"email"=>[
				"rule" => ["email"],
				"message" => "Invalid email"
			]
		])
		->requirePresence("age", "create", "Age should be needed")
		->numeric("age", "Age should be numberic value", "create")
		->requirePresence("url", "Url should be required", "create")
		->url("url","invalid url" , "create");

		$validation = $validator->errors($req_data);

		if(!empty($validation)) {
			print_r($validation);
		} else {
			echo "Passed Successfully";
		}
	}

	public function validatedatabtmodel() {
		$this->autoRender = false;
		$req_data = [
			"email" => "cuccongmanh1106@gmail.com",
			"password" => "123",
			"confirm_password" => "123"
		];

		$this->loadModel('Tests');
		$validation = $this->Tests->newEntity($req_data); //$this->request->data
		$validationErrors = $validation->errors();
		if(!empty($validationErrors)) {
			print_r($validationErrors);
		} else {
			echo "Successfully Passed";
		}
	}

	

}
?>
