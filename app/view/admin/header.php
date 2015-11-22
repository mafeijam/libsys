<div id="admin-head">
	<div class="container">Admin panel</div>
</div>
<div class="container">
	<nav class="admin-nav">
		<ul>
			<li><a href="{! url() !}"><i class="fa fa-book mr-5"></i>manage books</a></li>
			<li><a href="{! url('author/show') !}"><i class="fa fa-users mr-5"></i>manage authors</a></li>
			<li><a href="{! url('publisher/show') !}"><i class="fa fa-newspaper-o mr-5"></i>manage publishers</a></li>
			<li><a href="{! url('logout') !}"><i class="fa fa-sign-out mr-5"></i>logout</a></li>
		</ul>
	</nav>