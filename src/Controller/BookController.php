<?php

namespace App\Controller;
use App\Controller\AppController;
use Cake\Routing\Router;
class BookController extends AppController {

	private $url;
	public function initialize() {
		parent::initialize();
		$this->loadModel("Books");
		$this->viewBuilder()->layout('booklayout');
		$this->url = Router::url('/',true);
	}

	public function index() {
		$books = $this->Books->find("all",[
			"order" => ["id"=>"desc"]
		]);
		$this->set("title", "Book List");
		$this->set('books',$books);
		$this->set('url', $this->url);
	}

	public function create() {
		$this->set('title', "Book Create");
		if($this->request->is('post') AND !empty($this->request->getData())) {
			$book = $this->Books->newEntity($this->request->data);
			$validation = $book->errors();
			if(!empty($validation)) {
				$this->Flash->set($validation, [
					"element" => "book_error"
				]);
				$this->set("book", $this->request->data);
			} else {
				$form_data = $this->request->getData();
				if(isset($this->request->data['file'])) {
			 		$uploaded_path = "/img/uploads/";
				 	$tmp_name = $this->request->data['file']['tmp_name'];
				 	$image_name = $this->request->data['file']['name'];
				 	move_uploaded_file($tmp_name,WWW_ROOT.$uploaded_path."/".$image_name);
			 	}

				$book->name = $form_data['name'];
				$book->email = $form_data['email'];
				$book->author = $form_data['author'];
				$book->description = $form_data['description'];
				$book->img = $uploaded_path."/".$image_name;
				if($this->Books->save($book)) {
					$this->Flash->set('Book has been added Successfully', [
					"element" => "book_success"
				]);
				} else {
					$this->Flash->set('Book has not been added Successfully', [
						"element" => "book_error"
					]);
				}
				
			}
		}

	}

	public function save() {
		$this->autoRender = false;
		$book = $this->Books->newEntity($this->request->data);
		$validation = $this->errors();
		if(!empty($validation)) {
			print_r($validation);
			$this->Flash->set($validation, [
				"element" => "book_error"
			]);
		} else {
			print_r($this->request->data);
		}
	}

	public function edit($id) {
		$this->set('title','Book Edit');
		$book = $this->Books->get($id);
		$this->set('book',$book);

		if($this->request->is('post') AND !empty($this->request->getData())) {
			 $formdata = $this->request->data;
			 if(isset($this->request->data['file'])) {
			 	$uploaded_path = "/img/uploads/";
				 $tmp_name = $this->request->data['file']['tmp_name'];
				 $image_name = $this->request->data['file']['name'];
				 move_uploaded_file($tmp_name,WWW_ROOT.$uploaded_path."/".$image_name);
			 }
			 
	 		 $book = $this->Books->get($id);
			 $book->name = $formdata['name'];
			 $book->email = $formdata['email'];
			 $book->author = $formdata['author'];
			 $book->description = $formdata['description'];
			 $book->img = $uploaded_path."/".$image_name;
			 if($this->Books->save($book)) {
			 	 $this->Flash->set('Book has been updated',[
			 	"element" => "book_success"
			 ]);
			 } else {
			 	$this->Flash->set('Book has not been updated Successfully', [
						"element" => "book_error"
					]);
			 }
			 $this->redirect(["action" => "/edit/".$id]);
			 
		}
	}

	public function update() {

	}

	public function delete($id) {
		$this->autoRender = false;
		$book = $this->Books->get($id);
		$this->Books->delete($book);
		$this->Flash->set("Book has been deleted",[
			"element" => "book_success"
		]);
		$this->redirect(["action" => "index"]);
	}

	public function search() {
		$this->autoRender = false;
		$success = false;
		$search = $this->request->data['search'];
		$books = $this->Books->find("all",[
			"conditions" => ["name LIKE" => '%'.$search.'%'],
			"order" => ["id"=>"desc"]
		])->toArray();
		$success = count($books) > 0 ? true : false;
		$resultJ = json_encode(array('result' => array('books' => $books, 'success' => $success)));
		$this->response->type('json');
	    $this->response->body($resultJ);
	    return $this->response;
	}
}