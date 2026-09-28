<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'connection.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $link,
    "SELECT blog_name, blog_slug, blog_content, added_on
     FROM blogs
     WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $blog_name, $blog_slug, $blog_content, $added_on);

if (!mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    header('Location: index.php');
    exit;
}

mysqli_stmt_close($stmt);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog_name) ?> - My Blog</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<div class="container py-4">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded px-3 mb-4">

        <a class="navbar-brand font-weight-bold" href="index.php">
            My Blog
        </a>

        <div class="ml-auto">

            <a href="index.php" class="btn btn-outline-secondary mr-2">
                <i class="bi bi-arrow-left"></i> All Posts
            </a>

            <a href="create.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Blog
            </a>

        </div>

    </nav>

    <article class="card shadow-sm border-0 mb-4">

        <div class="card-body p-4 p-md-5">

            <header class="mb-4 pb-3 border-bottom">

                <h1 class="font-weight-bold mb-2">
                    <?= htmlspecialchars($blog_name) ?>
                </h1>

                <div class="text-muted small d-flex flex-wrap align-items-center">

                    <span class="mr-3">
                        <i class="bi bi-calendar3 mr-1"></i>
                        <?= date('F j, Y', strtotime($added_on)) ?>
                    </span>

                    <span class="badge badge-secondary">
                        <?= htmlspecialchars($blog_slug) ?>
                    </span>

                </div>

            </header>

            <div class="blog-content mb-4 leading-relaxed">
                <?= $blog_content ?>
            </div>

            <footer class="pt-3 border-top d-flex">

                <a href="index.php" class="btn btn-secondary mr-2">
                    Back to Posts
                </a>

                <a href="create.php?id=<?= $id ?>" class="btn btn-primary mr-2">
                    <i class="bi bi-pencil mr-1"></i> Edit
                </a>

                <a href="del.php?id=<?= $id ?>" class="btn btn-danger ml-auto" onclick="return confirm('Are you sure you want to delete this blog?');">
                    <i class="bi bi-trash mr-1"></i> Delete
                </a>

            </footer>

        </div>

    </article>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
