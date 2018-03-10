<?php

define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','global');
define('DB_USER','irodionov');
define('DB_PASS','neto1570');
?>
    <html>
    <head>
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
    </head>
    <body>
    <h1>Библиотека успешного человека</h1>

    <form method="GET" action="<?=$_SERVER['SCRIPT_NAME']?>">
        <input name="isbn" placeholder="ISBN" type="text" value="<?php echo $_GET['isbn'];?>">
        <input name="name" placeholder="Название книги" type="text" value="<?php echo $_GET['name'];?>">
        <input name="author" placeholder="Автор книги" type="text" value="<?php echo $_GET['author'];?>">
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

try {

    $connect_str = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME;
    $db = new PDO($connect_str, DB_USER, DB_PASS);

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


    foreach ($db->query($sql) as $row) {
        echo "<tr><td>" . $row['name'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td>" . $row['genre'] . "</td>";
        echo "<td>" . $row['isbn'] . "</td></tr>";
    }

}
catch(PDOException $e)
{
    die("Error: ". $e->getMessage());
}




