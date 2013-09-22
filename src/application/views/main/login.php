    <form method="POST" action="<? echo base_url()."main/login"; ?>" accept-charset="utf-8">
    <label for="username">Username: </label>
    <input type="text" name="username" id="password" value="" />
    <br/>
    <label for="password">Password: </label>
    <input type="text" name="password" id="password" value="" />
    <br/>
    <input type="hidden" name="login_form" value="login_form"/>
    <input type="submit" value="Connect" />

    </form>
<?
    if (isset($login_error)){
	echo "<span style='color:red'>".$login_error."</span><br/>";
    }
    
 