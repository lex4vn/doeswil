<?php
class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function switchLanguage($language) {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        // Using GET
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        $url = ($_GET['url'] == "")? base_url() : $_GET['url'];
        // return back page
        redirect($url);
    }
}