@extend('layout')

@start('body')

<div id="login-form">
	<form action="{! url('login') !}" method="POST">
		<div class="form-group">
			<div id="login-title"><a href="{! url() !}">Library Manage System</a></div>
			<label for="username" class="label {! Css::error('error') !}">
				<i class="fa fa-user"></i>Username
			</label>
			<input id="username" name="username" type="text" autocomplete="off" value="{{ input('username') }}">
		</div>

		<div class="form-group">
			<label for="password" class="label {! Css::error('error') !}">
				<i class="fa fa-key" ></i>Password
			</label>
			<input id="password" name="password" type="password">
		</div>

		<div class="form-group">
			<button class="btn-b {! Css::error('shake') !}"><i class="fa fa-lock"></i>Login</button>
			@if (Session::has('error'))
				<div class="error error-box rotate">
					@foreach (flash('error') as $error)
					<p><i class="fa fa-exclamation-triangle"></i>{! $error !}</p>
					@endforeach
				</div>
			@endif
		</div>
	{! form_token() !}
	</form>
</div>
<script src="{! js('login') !}"></script>

@end

