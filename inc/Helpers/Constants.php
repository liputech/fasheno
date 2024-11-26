<?php

namespace RT\Fasheno\Helpers;

class Constants {

	const FASHENO_VERSION = '1.0.0';

	public static function get_version() {
		return WP_DEBUG ? time() : self::FASHENO_VERSION;
	}
}

