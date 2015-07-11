<?php
if(!empty($search_result))
{
	foreach ($search_result as $value) {

	echo '<a href="/serie/'.$value->getId().'"><img src="'.$value->getImage().'" alt="'.$value->getName().'""></a>';

	}
}