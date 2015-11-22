<?php

class PageController
{
	public function index()
	{
		$books = table('books')->all('id', 'desc');

		return Auth::check() ? view('admin.index', compact('books')) : view('login');
	}
}