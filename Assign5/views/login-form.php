<head>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<?php foreach($data['errors'] as $err){ ?>
	<div class="error"><?php echo $err; ?></div>
<?php } ?>

<form method="post">
	Username<br>
	<input type="text" name="username">
	
	<br><br>
	Password<br>
	<input type="password" name="password">
	<br>

	<div class="g-recaptcha" data-sitekey="6LcEHRkUAAAAADbLTly-lYz-CDo4sMoGb2a0nTBQ"></div>

	<input type="submit" name="login" value="Sign in">
</form>

<style>
	.error{ 
	    border: solid 1px red;
	    color: red;
	    background-color: yellow;
	    font-size: 20px;
	 }
</style>