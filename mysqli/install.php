<?
function create_table($msql, string $qry, string $tbl_name)
{
	if ((mysqli_query($msql, $qry) === FALSE))
		$errors .= "fail to create ".$tbl_name." TABLE</br>";
}

$msql = mysqli_connect("localhost", "root", "ecole42");
$qry = "CREATE DATABASE IF NOT EXISTS ploof CHARACTER SET \"utf8\"";
mysqli_query($msql, $qry);
mysqli_close($msql);

$msql = mysqli_connect("localhost", "root", "ecole42", "ploof");

$qry = "CREATE TABLE IF NOT EXISTS ploof.users (id INT NOT NULL AUTO_INCREMENT , login VARCHAR(255) NOT NULL , name VARCHAR(255) NOT NULL , fname VARCHAR(255) NOT NULL , sexe ENUM('F','M','both','none') NOT NULL , bday DATE NOT NULL , phone VARCHAR(20) NOT NULL, email VARCHAR(255) NOT NULL , mdp VARCHAR(200) NOT NULL , grp ENUM('buyer', 'seller', 'order_picker', 'admin') NOT NULL DEFAULT 'buyer', addr VARCHAR(255) NOT NULL, PRIMARY KEY (id))";
create_table($msql, $qry, "users");


$qry = "CREATE TABLE IF NOT EXISTS ploof.categ (id INT NOT NULL AUTO_INCREMENT, cat_name VARCHAR(255), PRIMARY KEY(id))";
create_table($msql, $qry, "categ");

$qry = "CREATE TABLE IF NOT EXISTS ploof.colors (id INT NOT NULL AUTO_INCREMENT, col_value VARCHAR(10), PRIMARY KEY(id))";
create_table($msql, $qry, "colors");

$qry = "CREATE TABLE IF NOT EXISTS ploof.products(id INT NOT NULL AUTO_INCREMENT, name VARCHAR(255), categ VARCHAR(255), price FLOAT NOT NULL, country ENUM('north_am', 'sud_am', 'artic', 'europe', 'africa', 'asia'), descrip TEXT, promo INT, url_image VARCHAR(255), qty INT NOT NULL, color VARCHAR(10) DEFAULT 'none', PRIMARY KEY (id))";
create_table($msql, $qry, "products");

$qry = "CREATE TABLE IF NOT EXISTS ploof.kdy (id INT NOT NULL AUTO_INCREMENT, user_id INT, CONSTRAINT id_product_num FOREIGN KEY (user_id) REFERENCES users(id), status ENUM('in_kdy', 'paid', 'sent') NOT NULL DEFAULT 'in_kdy', last_modif DATE, payday DATE, comment TEXT, PRIMARY KEY(id))";

create_table($msql, $qry, "kdy");

$qry = "CREATE TABLE IF NOT EXISTS ploof.oder_lines (id INT NOT NULL AUTO_INCREMENT, id_kdy INT NOT NULL, CONSTRAINT id_kdy_num FOREIGN KEY (id_kdy) REFERENCES kdy(id), id_product INT, CONSTRAINT product_num FOREIGN KEY (id_product) REFERENCES products(id), qty INT NOT NULL, kdy_name VARCHAR(255) NOT NULL, kdy_color VARCHAR(10), kdy_price FLOAT NOT NULL, kdy_promo INT, PRIMARY KEY(id))";
create_table($msql, $qry, "order_lines");

if (isset($errors))
	{
		include_once("functions/functions.php");
		message($errors);
	}
?>
