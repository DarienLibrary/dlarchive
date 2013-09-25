<div>
    <div style="font-size:40px; font-weight: bold; margin:20px;">Library Archiver</div>
    <img src="<? echo base_url()."images/archiver.png"?>" style="width:50px; margin:10px" />
</div>
   
    <form method="POST" action="<? echo base_url()."main/login"; ?>" accept-charset="utf-8" id="login-form">
    <?
    if (isset($login_error)){
	echo "<div style='color:red'>".$login_error."</div>";
    }
    ?>
    <label for="username" style="margin-top:10px;">Username: </label>
    <input type="text" name="username" id="password" value="" />
    <br/>
    <label for="password" style="margin-top:10px;">Password: </label>
    <input type="password" name="password" id="password" value="" />
    <br/><br/>
    <input type="hidden" name="login_form" value="login_form"/>
    <div align="center">
	<input type="submit" value="Connect" class="btn btn-primary" />
    </div>

    </form>

    
 