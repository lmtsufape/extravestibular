<!DOCTYPE html>

<html>

<head>

	<title>Hi</title>

</head>

<body>

	<?php
	$i = 1;
	 foreach ($lista as $nota): ?>
		{{$i}} -- {{$nota->usuarioId}}   :: {{$nota->nota}}  
		<p>
 	<?php $i++;
endforeach; ?>



</body>

</html>
