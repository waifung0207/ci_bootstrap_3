<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo purpose only
 */
class Demo extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->push_breadcrumb('Demo');
	}

	public function index()
	{
		redirect('demo/item/1');
	}

	public function item($demo_id)
	{
		$this->mViewData['demo_id'] = $demo_id;
		$this->render('demo/item');
	}
	
	// Bootstrap Carousel
	public function carousel()
	{
		// grab records from database table "cover_photos"
		$this->load->model('demo_cover_photo_model', 'photos');
		$this->mViewData['photos'] = $this->photos->get_all();
		$this->render('demo/carousel');
	}
	
	// Blog Posts
	public function blog_posts()
	{
		$page = $this->input->get('p');
		$page = empty($page) ? 1 : $page;

		$this->load->model('demo_blog_post_model', 'posts');
		$results = $this->posts->with('category')->with('author')->paginate($page);
		$posts = $results['data'];
		$counts = $results['counts'];
		
		// call render() from MY_Pagination
		$this->load->library('pagination');
		$pagination = $this->pagination->render($counts['total_num'], $counts['limit']);

		$this->mViewData['posts'] = $posts;
		$this->mViewData['counts'] = $counts;
		$this->mViewData['pagination'] = $pagination;
		$this->render('demo/blog_posts');
	}
	
	// Blog Post
	public function blog_post($post_id)
	{
		$this->load->model('demo_blog_post_model', 'posts');
		$post = $this->posts->with('category')->with('author')->get($post_id);

		$this->push_breadcrumb('Blog Posts', 'demo/blog_posts');
		$this->mTitle = $post->title;
		$this->mViewData['post'] = $post;
		$this->render('demo/blog_post');
	}

	public function pagination()
	{
		// library from: application/libraries/MY_Pagination.php
		// config from: application/config/pagination.php
		$this->load->library('pagination');
		$this->mViewData['pagination'] = $this->pagination->render(200, 20);
		$this->render('demo/pagination');
	}

	// Form without Bootstrap theme
	// See views/demo/form_basic.php for sample code
	public function form_basic()
	{
		// library from: application/libraries/Form_builder.php
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			$this->system_message->set_success('Success!');
			refresh();
		}

		// require reCAPTCHA script at page head
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';

		$this->mTitle = 'Form (Basic)';
		$this->mViewData['form'] = $form;
		$this->render('demo/form_basic');
	}
	
	public function form_bs3()
	{
		// library from: application/libraries/Form_builder.php
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			$this->system_message->set_success('Success!');
			refresh();
		}

		// require reCAPTCHA script at page head
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';
		
		$this->mTitle = 'Form (Bootstrap 3)';
		$this->mViewData['form'] = $form;
		$this->render('demo/form_bs3');
	}
}
