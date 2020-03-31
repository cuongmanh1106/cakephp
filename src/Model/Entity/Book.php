<?php

namespace App\Model\Entity;
use Cake\ORM\Entity;


class Book extends Entity {

	protected function _getName($value) {
		return $value;
	}

	protected function _getAuthor($value) {
		return $value;
	}

	protected function _getNameEmail() {

	}
}