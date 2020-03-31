<br><br>

<?php
	echo $this->Form->create('', ['type'=>'POST']);
	echo $this->Form->controls(
	[
		'name'  		=> ['class' => "form-control", 'required' => false, 'label' => ['text' => 'User Full Name']],
		'username'  	=> ['class' => "form-control", 'required' => false, 'label' => ['text' => 'User Full Name']],
		'email' 		=> ['class' => "form-control", 'required' => false, 'label' => ['text' => 'Email']],
		'password' 		=> ['class' => "form-control", 'required' => false],
		'phone' 		=> ['class' => "form-control", 'required' => false],
	],
	['legend' => 'User Sign Up Here']
	);

	echo $this->Form->button('Sign Up', ['class' => 'btn btn-success btn-block']);
	echo $this->Form->end();
?>
