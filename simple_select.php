<?php
$connect = mysqli_connect("localhost", "irodionov", "neto1570", "global");
mysqli_set_charset( $connect, 'utf8');
$sql = "SELECT * FROM books";
$res = mysqli_query($connect,$sql);
$n = $_GET['name'];
$i = $_GET['isbn'];
$a = $_GET['author'];

?>
<html>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style>
    table {
        border-spacing: 0;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }

    table th {
        background: #eee;
    }
</style>
<body>
<h1>Библиотека успешного человека</h1>

<form method="GET" action="<?=$_SERVER['SCRIPT_NAME']?>">
    <input name="isbn" placeholder="ISBN" type="text" value="<?php echo $i;?>">
    <input name="name" placeholder="Название книги" type="text" value="<?php echo $n;?>">
    <input name="author" placeholder="Автор книги" type="text" value="<?php echo $a;?>">
    <input value="Поиск" type="submit">
</form>

<table>
    <tbody>
    <tr>
        <th>Название</th>
        <th>Автор</th>
        <th>Год выпуска</th>
        <th>Жанр</th>
        <th>ISBN</th>
    </tr>
<?php

    $sql = 'SELECT * FROM `books` WHERE 1 ';
    $name = $_GET['name'];
    $isbn = $_GET['isbn'];
    $author = $_GET['author'];

    if(!empty($isbn)) {
    $sql .= "AND isbn LIKE '%$isbn%' ";
    }
    if(!empty($name)) {
    $sql .= "AND name LIKE '%$name%' ";
    }
    if(!empty($author)) {
    $sql .= "AND author LIKE '%$author%' ";
    }

    while($data = mysqli_fetch_array($res)) {
        echo "<tr><td>" . $data['name'] . "</td><td>" . $data['author'] . "</td><td>" . $data['year'] . "</td><td>". $data['genre'] ."</td><td>". $data['isbn'] ."</td></tr>" ;
    }
    ?>

    </tbody>
</table>
</body>
</html>
