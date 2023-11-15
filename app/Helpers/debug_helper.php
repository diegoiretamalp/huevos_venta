<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function pre($string)
	{
		echo "<pre>";
		print_r($string);
		echo "</pre>";
	}

	function pre_die($string)
	{
		echo "<pre>";
		print_r($string);
		echo "</pre>";
		die();
	}
	