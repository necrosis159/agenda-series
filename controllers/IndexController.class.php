<?php
class indexController{
	

	public function indexAction($args)
	{
		
		$v = new baseView("indexIndex");
		$v->assign("test", "toto");
	}

	public function contactAction($args)
	{
		
		$v = new baseView("indexContact");
		$v->assign("Titre", "Mon titre");
	}

}