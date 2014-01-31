<script>
/*
 * some js to validate form before submitting
 */
 
function validateUsername(){
    var nameRegex = /^[a-zA-Z\-]+$/;
    var validfirstUsername = document.getElementById("UserUsername").value.match(nameRegex);
    if(validUsername == null){
        alert("Votre nom d\'utilisateur n'est pas valide. Only characters A-Z, a-z and '-' are  acceptable.");
        document.frm.firstName.focus();
        return false;
    }
}

function validatePassword() {
	var pass1 = document.getElementById("UserPassword").value;
    var pass2 = document.getElementById("UserConfirmpassword").value;
    //alert(pass1+"-"+pass2);
    
    if (pass1 != pass2) {
        document.getElementById("UserPassword").focus();
        document.getElementById("UserPassword").style.backgroundColor = "#E34234";
        document.getElementById("UserConfirmpassword").style.backgroundColor = "#E34234";
        alert("Les mots de passe ne correspondent pas!!!");        
        return false;
    }

    if (pass1.length < 6){
    document.getElementById("UserPassword").style.backgroundColor = "#E34234";
    document.getElementById("UserConfirmpassword").style.backgroundColor = "#E34234";
    alert("Mot de passe trop court: minimum 6 caractères!!!");
    return false;    
	} else {
	    document.getElementById("UserPassword").style.backgroundColor = "#3DEA3D";
	    document.getElementById("UserConfirmpassword").style.backgroundColor = "#3DEA3D";
	}
}

/*
 * https://github.com/spout/cakephp-starter-kit/blob/master/app/Model/User.php
 */


 </script>
 <div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Inscription'); ?></legend>
	<?php
App::import('Vendor', 'functions');
		

		echo $this->Form->input('parent_id', array('type'=>'hidden','value'=>'99'));
		echo $this->Form->input('username',array('label'=>'Nom d\'utilisateur'));
		echo $this->Form->input('role_id', array('type'=>'hidden','value'=>'99'));
		echo $this->Form->input('groupe_id', array('type'=>'hidden','value'=>'99'));
		echo $this->Form->input('status', array('type'=>'hidden','value'=>'99'));
		

		echo $this->Form->input('nom');
		echo $this->Form->input('prenom');
		echo $this->Form->input('telephone');
		echo $this->Form->input('natel');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('confirmpassword', array('type'=>'password','onChange' => 'validatePassword()'));
		echo $this->Form->input('notes',array('type'=>'hidden'));
		echo $this->Form->input('date_creation',array('dateFormat' => 'DMY','type'=>'hidden'));
		echo $this->Form->input('last_connection',array('dateFormat' => 'DMY','type'=>'hidden'));
		
		
	?>

<?php echo $this->Form->end(__('Submit'), array('onSubmit'=>'validatePassword()')); ?>
</div>

