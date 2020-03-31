<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;


class UsersController extends AppController
{

	public function login() {
		$sign_up = $this->Users->newEntity();
		if($this->request->is('post')) {
			$post = $this->Users->patchEntity($sign_up, $this->request->getData());
			if($this->Users->save($sign_up)) {
				$this->Flash->success('User Add Success fully', ['key' => 'message']);
				return $this->redirect(['action' => 'login']);
			}
			$this->Flash->error(__('Unable to add your user!'));
		}
		$this->set('post', $sign_up);

	}

	public function signUp() {
		$signup = $this->Users->newEntity();
		if($this->request->is('post') AND !empty($this->request->getData())) {

			$signup = $post = $this->Users->patchEntity($signup, $this->request->getData(), ['validate' => 'update']);
			if($signup->errors()) {
				$this->Flash->success('Please Fill required fields', ['key' => 'message']);
			} else {
					if($this->Users->save($signup)) {
					$this->Flash->success('User Add Success fully', ['key' => 'message']);
					return $this->redirect(['action' => 'login']);
				}
				$this->Flash->error(__('Unable to add your user!'));
			}
			
		}
		$this->set('post', $signup);

		
	}
}
?>
