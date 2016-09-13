<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MY_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
    } 
	
	//Home Page (Default Function. If no function is called, this function will be called).
	public function index()
	{

		$language = $this->session->userdata('site_lang');
		$language = $language == 'english'? 1 : 2;
		$table 							= $this->db->dbprefix('articles');
		$news 				= $this->base_model->run_query(
		"select id, articles_description.title as title,image,articles_description.body as body,slug,cat_id,pubdate,created  from ".$table." LEFT JOIN articles_description ON articles.id = articles_description.article_id where lang = ".$language." ORDER BY articles.created DESC LIMIT 5"
		);
		$this->data['news'] 	= $news;
		$this->data['active_menu'] 		= 'news';
		$this->data['content'] 			= 'articles/news';
		$this->_render_page('temp/template', $this->data);
	}
	public function news($id)
	{
		$language = $this->session->userdata('site_lang');
		$language = $language == 'english'? 1 : 2;
		$table 							= $this->db->dbprefix('articles');
		$news 				= $this->base_model->run_query(
			"select id, articles_description.title as title,image,articles_description.body as body,slug,cat_id,pubdate,created  from ".$table." LEFT JOIN articles_description ON articles.id = articles_description.article_id where id=".$id." and lang = ".$language
		);
		$this->data['news'] 	= $news;
		$this->data['active_menu'] 		= 'news';
		$this->data['content'] 			= 'articles/details';
		$this->_render_page('temp/template', $this->data);
	}
 }
