<?php

class Layouts
{
	// hold CI instance
	private $CI;
	
	// hold Layout title
	private $layout_title = null;
	
	// hold Layout description
	private $layout_description = null;
	
	// hold includes like css and js
	private $includes = array(
		'css/bootstrap.css',
		'css/bootstrap.css.map',
		'css/bootstrap.min.css',
		'css/bootstrap-checkbox.css',
		'css/bootstrap-theme.css',
		'css/bootstrap-theme.css.map.css',
		'css/bootstrap-theme.min.css',
		'css/carousel.css',
		'css/dataTables.bootstrap.css'
		/*'css/cus-icons.css',
		'css/DT_bootstrap.css',
		'css/responsive-tables.css',
		'css/bootstrap.css',
		'css/TableTools.css',
		'css/bootstrap-timepicker.min.css',
		'css/bootstrap.min.css?v=1',
		'css/theme.css?v=1',
		'css/accordion-menu.css',
		'css/glossymenu-2.css'*/
	);
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function set_title($title)
	{
		$this->layout_title = $title;
	}
	
	public function set_description($description)
	{
		$this->layout_description = $description;
	}
	
	/*public function add_includes($path, $prepend_base_url = true)
	{
		if($prepend_base_url)
		{
			$this->CI->load->helper('url');
			$this->includes[] = base_url().$path;
		}
		else
		{
			$this->includes[] = $path;
		}
		
		return $this;
	}*/
	
	public function print_includes()
	{
		//$this->includes[] = 'css/main.css';
		//die(print_r($this->includes));
		$final_includes = '';
		
		foreach($this->includes as $include)
		{
			if(preg_match('/js/', $include))
			{
				$final_includes .= '<script src="' . base_url().$include . '"></script>
	';
			}
			elseif(preg_match('/css/' , $include))
			{
				$final_includes .= '<link href="' . base_url().$include . '" rel="stylesheet" />
	';
			}
		}
		
		return $final_includes;
	}
	
	public function view($view_name, $layouts = array(), $params = array(), $default = true)
	{
		if(is_array($layouts) && count($layouts) >= 1)
		{
			foreach($layouts as $layout_key=>$layout)
			{
				$params[$layout_key] = $this->CI->load->view($layout, $params, true);
			}
		}
		
		if($default)
		{
			// set layout title
			$header_params["layout_title"] = $this->layout_title;
			
			// set layout description
			$header_params["layout_description"] = $this->layout_description;
			
			// render default header
			$this->CI->load->view("Layouts/header", $header_params);
			
			// render content
			$this->CI->load->view($view_name, $params);
			
			// render footer
			$this->CI->load->view("Layouts/footer");
		}
		else
		{
			// render view
			$this->CI->load->view($view_name, $params);
		}
	}
}
?>