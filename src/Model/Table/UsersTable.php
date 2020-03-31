<?php 
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table 
{
	public function validationDefault(Validator $validator) 
	{
		$validator
			->notEmpty('name','Please Enter Full Name')
			->requirePresence('name');

		$validator 
			->notEmpty('username', 'Please Enter Username')
			->requirePresence('username');

		return $validator;
	}

	public function validationUpdate($validator) 
	{
		$validator
			->notEmpty('name')
			->requirePresence('name');

		$validator
			->notEmpty('username')
			->requirePresence('username');

		return $validator;
	}
}

?>