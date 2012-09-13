<div id="login-container">
	<header>
		<h1>Log In</h1>		
	</header>
	<div role="main" id="login">
		<div class="alpha-layer"></div>
		<form action="/authlogin.php" method="post">
			<label for="username">Username: </label>
			<input type="text" name="username"/>
			<label for= "password">Password: </label>
			<input type="password" name="password"/>			
			<input type="submit" value="Log in"/>			
			<div class="error-message">			
			<?				
			if(isset($_GET['error']) && $_GET['error']==1) {	
				echo "Your username or password is incorrect, please try again";	
			}			
			?>			
			</div>
		</form>
	</div>
</div>