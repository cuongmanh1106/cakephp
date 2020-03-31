<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TestsTable extends Table {
	public function validationDefault(Validator $validator) {
		$validator->requirePresence("email","create","Email should be needed")
			->add("email",[
				"unique"=>[
					"rule" => "validateUnique",
					"provider" => "table",
					"message" => "Email should be unique"
				]
			])
			->requirePresence("password","create","password should be needed")
			->requirePresence("confirm_password","create","Confirm Password id needed")
			->add("confirm_password",[
				"password_mismatch" => [
					"rule" => ["compareWith","password"],
					"message" => "Password didn't match "
				]
			]);
		return $validator;
	}
	
}