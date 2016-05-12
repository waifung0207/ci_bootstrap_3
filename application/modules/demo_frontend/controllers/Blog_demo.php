<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo purpose only
 */
class Blog_demo extends MY_Controller {
	
	// Blog Posts
	public function posts()
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

		$this->mTitle = 'Blog Posts';
		$this->render('blog/posts');
	}
	
	// Blog Post
	public function post($post_id)
	{
		$this->load->model('demo_blog_post_model', 'posts');
		$post = $this->posts->with('category')->with('author')->get($post_id);
		$this->mViewData['post'] = $post;

		$this->push_breadcrumb('Blog Posts', 'blog/posts');
		$this->mTitle = $post->title;
		$this->render('blog/post');
	}
}
