<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;
use Core\Validator;

class PostsController extends BaseController
{
	private $post;

	public function __construct()
	{
		parent::__construct();
		$this->post = Container::getModel("Post");
	}

	public function index()
	{
		$this->setPageTitle('Posts');
		
		$this->view->posts = $this->post->All();

		return $this->renderView('posts/index', 'layout');
	}

	public function show($id)
	{
		$this->view->post = $this->post->find($id);

		$this->setPageTitle("{$this->view->post->title}");

		return $this->renderView('posts/show', 'layout');
	}

	public function create()
	{
		$this->setPageTitle('New Post');

		return $this->renderView('posts/create', 'layout');
	}

	public function store($request)
	{
		$data = [
			'title' => $request->post->title,
			'content' => $request->post->content
		];

		if ($this->post->create($data)) {
			Redirect::route('/posts');
		} else {
			return Redirect::route('/posts', [
				'errors' => ['Oops! não foi possível realizar esta ação.']
			]);
		}
	}

	public function edit($id)
	{
		$this->view->post = $this->post->find($id);

		$this->setPageTitle("Edit Post - {$this->view->post->title}");

		return $this->renderView('/posts/edit', 'layout');
	}

	public function update($id, $request)
	{
		$data = [
			'title' => $request->post->title,
			'content' => $request->post->content
		];

		if (Validator::make($data, $this->post->rules())) {
			return Redirect::route("/post/{$id}/edit");
		}

		if ($this->post->update($data, $id)) {
			return Redirect::route('/posts', [
				'success' => ['Post Atualizado com sucesso!']
			]);
		} else {
			return Redirect::route('/posts', [
				'errors' => ['Oops! não foi possível realizar esta ação.']
			]);
		}
	}

	public function delete($id)
	{
		if ($this->post->delete($id)) {
			return Redirect::route('/posts');
		} else {
			return Redirect::route('/posts', [
				'errors' => ['Oops! não foi possível realizar esta ação.']
			]);
		}
	}
}
