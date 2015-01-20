<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * HTML5 Date Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_input'))
{
	function form_date($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'date', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}