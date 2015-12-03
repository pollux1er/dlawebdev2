<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('datetime_to_mysql'))
{
    function datetime_to_mysql($date, $heure)
    {
		$arr = $date;
		$h_arr = $heure;
		
		list($d, $m, $y) = preg_split('/\//', $arr);
		$arr_date = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		$match = "/^2[0-3]|[01][0-9]:[0-5][0-9]$/";

		if (preg_match($match, $h_arr)) {
			$arr_date = $arr_date . ' ' . $h_arr . ':00';
		}
		else
		{
			$arr_date = $arr_date . ' ' . '11:00:00';
		}
        return $arr_date;
    }   
}