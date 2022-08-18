<?php
$servername = "localhost";
$username = "usuario_local";
$password = "local_usuario";
$dbname = "if966";
// Create connection
$conn = mysqli_connect($servername, $username, $password,
$dbname);

// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM categoria_produto";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
echo "id: " . $row["cod_categoria"]. " - Descrição: <a
href='produto.php?cod_categoria=" . $row["cod_categoria"]. "'>" .
$row["descricao"]. "</a><br>";
}
} else {
echo "0 results";
}
mysqli_close($conn);

?>