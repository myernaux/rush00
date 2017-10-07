<?php

function add_article($bdd)

if ($bdd == NULL || $_POST["name"] == "" || $_POST["name"][0] == "" ||
	$_POST["category"] == "" || $_POST["category"][0] == "" ||
	$_POST["price"] == "" || $_POST["price"][0] == "" ||
	$_POST["color"] == "" || $_POST["color"][0] == "")
	return (FALSE);

	if ($query = mysqli_query($bdd, 'SELECT name,color FROM product WHERE name='htmlspecialchars($_POST["name"])) === FALSE)
		return (FALSE);
	foreach ($query as $elem) {
		if ($elem["color"] == $_POST["color"])
			return (FALSE);
	}
	$req_pre = mysqli_prepare($bdd, 'INSERT INTO products (name, category, price, country, descript, promo, url_img, qty, poids) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)');
	mysqli_stmt_bind_param($req_pre, "sidisisis", htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["category"]), htmlspecialchars($_POST["price"]), htmlspecialchars($_POST["country"]), htmlspecialchars($_POST["dscript"]), htmlspecialchars($_POST["promo"]), htmlspecialchars($_POST["url_img"]), htmlspecialchars($_POST["qty"], $_POST["color"]));
	mysqli_stmt_execute($req_pre); 
	return (FALSE)
?>