<?php
class DefaultController extends baseView {

	public function index404()
	{
		$this->render("404");
	}
}