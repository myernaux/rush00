<?php

function	get_content_table($bdd, $table);
{
	if ($bdd == NULL)
		return (NULL);
	if ($query = mysqli_query($bdd, 'SELECT * FROM '$table) === FALSE)
		return (NULL);
	return ($query);
}

?>

