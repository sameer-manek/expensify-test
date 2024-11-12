<div class="window login" id="loginForm">
	<div class="container">
		<img src="https://d2k5nsl2zxldvw.cloudfront.net/images/brand/expensify-logo-green.svg" alt="" width="75%">
		<form>
			<h2>Login</h2>
			<input type="email" id="username" 
				placeholder="User Email" required /> <br />
			
			<input type="password" id="password" 
				placeholder="password" required /> <br />

			<button type="button" class="primary" id="login_btn" 
				onclick="handle_login()">Submit
			</button>
		</form>
		<p>Do not have an Accout? <a href="/register" target="_blank">Sign up now</a></p>
	</div>
</div>