<h2> Cr&eacute;er une t&acirc;che </h2 >
<?php echo validation_errors(); ?>
<?php echo form_open('todo/create') ?>
<label for =" title " > Enonc&eacute; de la t&acirc;che </label >
<input type ="input" name ="title" /><br />
</form >
<input type ="submit" name ="submit" value ="Cr&eacute;er une t&acirc;che " />