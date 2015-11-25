<?php

namespace Keynetic\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KeyneticUserBundle extends Bundle {
	/**
	 * @return string
	 */
	public function getParent() {
		return 'FOSUserBundle';
	}

}
