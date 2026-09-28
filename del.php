<?php

require 'connection.php';

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $stmt = mysqli_prepare(
        $link,
        "DELETE FROM blogs WHERE id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        'i',
        $id
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header('Location: index.php');

exit;

?>