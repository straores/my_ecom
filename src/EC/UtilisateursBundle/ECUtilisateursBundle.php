<?php

namespace EC\UtilisateursBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ECUtilisateursBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
