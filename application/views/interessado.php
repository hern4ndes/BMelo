<?php include ("footer_admin.php");?>

<script type="text/javascript">

	<?php if (validation_errors()){
			$validation_errors = validation_errors('\n"+"', '\n"+"');
			$validation_errors = trim($validation_errors);
	 ?>

        alert("<?php echo $validation_errors; ?>");
	
	<?php } elseif($this->session->flashdata('msg')){ ?>
         alert("<?php echo $this->session->flashdata('msg'); ?>");
    
    <?php } ?>

    window.close();
</script>
