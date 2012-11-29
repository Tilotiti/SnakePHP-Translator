<p>The translation is protected by a password.</p>
<form id="login" method="POST">
	{if $error}
		<div class="alert">
			<strong>Error !</strong> The password is not correct.
		</div>
	{/if}
	<center>
		<div class="input-append">
			<input class="span2" placeholder="Password" type="text" name="password">
			<button class="btn" type="submit">Login</button>
		</div>
	</center>
</form>