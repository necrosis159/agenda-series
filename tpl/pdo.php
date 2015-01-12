<?php
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=blog', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
	}
?>