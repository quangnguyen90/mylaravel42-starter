<!DOCTYPE HTML>
<html>
<head>
    <title>Login Laravel</title>
    <meta charset="UTF-8" />
</head>
<body>
<?php echo Form::open(array('url' => '/login')); ?>
    <fieldset class="boxBody">
        <label>Username</label>
        <input type="text" tabindex="1" name="username" required>
        <input type="password" name="password" tabindex="2" required>
        <input type="submit" class="btnLogin" value="Login" tabindex="4">
    </fieldset>
<?php echo Form::close(); ?>
</body>
</html>