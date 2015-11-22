<?php

route('/', 'PageController@index');

route('/login', 'AuthController@login', 'guest');

route('/logout', 'AuthController@logout');

group(['/book', 'guard'],
	route('/add', 'AdminController@addBook'),
	route('/save', 'AdminController@saveBook'),
	route('/edited/:id', 'AdminController@saveEditedBook'),
	route('/edit/:id', 'AdminController@editBook'),
	route('/image/:id', 'AdminController@deleteImage'),
	route('/delete/:id', 'AdminController@deleteBook')
);

group(['/author', 'guard'],
	route('/show', 'AdminController@author')
);



