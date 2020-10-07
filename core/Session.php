<?php

namespace Core;

class Session
{
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		if ($_SESSION[$key])
			return $_SESSION[$key];
		return false;
	}

	public static function destroy($key)
	{
		if (is_array($key))
			foreach ($keys as $key)
				unset($_SESSION[$key]);
		unset($_SESSION[$key]);
	}
}
