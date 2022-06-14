<?php
//Ping @ov3rflow1

highlight_file('index.php');
$sanitized_1=htmlentities($_GET['payload'],ENT_QUOTES);

$sanitized_2=trim(json_encode($_GET['payload'],true),'"');
?>


<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<?=$sanitized_1?>
<input id='in1' type='text' value=''>
<input id='in2' type='text' value=''>
<?=$sanitized_2?>
<script>
	$(document).ready(function(){
		//$("#in1").val('<?=$sanitized_1?>');
		$("#in2").val('<?=$sanitized_2?>');
	});
</script>
