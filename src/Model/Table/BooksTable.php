<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class BooksTable extends Table {
	//Code
	public function validationDefault(Validator $validator) {

		$validator
		->requirePresence("name","create","Name Should be needed")
		->add("name",[
			"length"=>[
				"rule"=>["minLength",6],
				"message" => "Book name should be more than 5"
			]
		])
		->requirePresence("email","create","Email field should be needed")
		->add("email",[
			"valid_email" => [
				"rule" => ["email"],
				"message" => "Invalid Email Address"
			]
		])
		->add("email",[
			"unique_email" => [
				"rule" => ["validateUnique"],
				"provider" => "table",
				"message" => "Email already exists"

			]
		])
		->requirePresence("author","create","Author field should be needed");

		return $validator;
	}
}