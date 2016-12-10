<?php

header("Content-type: text/javascript");
$num = rand(1,99);
?>

<!-- código JavaScript que es enviado al cliente -->

document.getElementById("numero").innerHTML="<h2><?php echo $num;?></h2>";
console.info("<?php echo $num; ?>");
