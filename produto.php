<?php
$servername = "localhost";
$username = "usuario_local";
$password = "local_usuario";
$dbname = "if966";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM produto WHERE produto.cod_categoria = " . $_GET["cod_categoria"];
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
echo "id: " . $row["cod_produto"]. " - Descrição produto: " . $row["descricao"].
"<br>";
}
} else {
echo "0 results";
}
mysqli_close($conn);
?>