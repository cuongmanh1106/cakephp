<br><br>

<?php
	$this->Form->setTemplate([
		'inputContainer' => '<div class = "form-group{{required}}">
			{{content}} <span class = "help">{{help}}</span></div>'
	]);
	echo $this->Form->create('', ['type'=>'POST']);
	echo $this->Form->controls(
	[
		'email' 		=> ['class' => "form-control", 'required' => true, 'label' => ['text' => 'Email']],
		'password' 		=> ['class' => "form-control", 'required' => true],
	],
	['legend' => 'User Sign Up Here']
	);

	echo $this->Form->button('Sign Up', ['class' => 'btn btn-success btn-block']);
	echo $this->Form->end();
?>
