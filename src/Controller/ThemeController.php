<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;

class ThemeController extends AppController
{
	public $base_url;
	public function initialize() {
		parent::initialize();
		$this->base_url = Router::url('/',true);
		$this->viewBuilder()->layout('theme'); //default is default template
	}
	public function index() {
		$this->set('baseUrl',$this->base_url);
		$this->set('title','Welcome Harrik!');
		$name = 'Harrik';
		$job = 'IT';
		$this->set(compact('name','job'));
	}

	

}
?>
