<?php

function del_article($bdd)

if ($bdd == NULL || $_POST["name"] == "" || $_POST["name"][0] == "" ||
	$_POST["category"] == "" || $_POST["category"][0] == "" ||
	$_POST["price"] == "" || $_POST["price"][0] == "" ||
	$_POST["color"] == "" || $_POST["color"][0] == "")
	return (FALSE);

	if (mysqli_query($bdd, 'SELECT name FROM product WHERE name='htmlspecialchars($_POST["name"])) === FALSE)
		return (FALSE);
	$req_pre = mysqli_prepare($bdd, 'DELETE INTO products (name, color) VALUES ( ?, ?)');
	mysqli_stmt_bind_param($req_pre, "ss", htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["name"]));
	mysqli_stmt_execute($req_pre);
	return (TRUE);
?>