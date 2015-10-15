<?php 
	if($cursos){
	foreach ($cursos->result() as $curso) { ?>
		<ul>
			<li><?= $curso->nombre;  ?></li>
		</ul>
		<?php }
		 }else{
		 	echo "<p>Error en la aplicacion</p>";
		 }
	?>