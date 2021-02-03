<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance();
    }

    public function app($template, $title, $data = null)
    {
        $data['content'] = $this->_ci->load->view($template, $data, true);
        $data['title'] = $title;
        $this->_ci->load->view('template.php', $data);
    }
}
