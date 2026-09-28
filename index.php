<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'connection.php';

$result = mysqli_query(
    $link,
    "SELECT * FROM blogs ORDER BY added_on DESC"
);

if (!$result) {
    die("SQL ERROR: " . mysqli_error($link));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Blog Management System</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<div class="container py-4">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded px-3 mb-4">

        <a class="navbar-brand fw-bold" href="index.php">
            My Blog
        </a>

        <div class="ms-auto">

            <a href="create.php"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>

                Add Blog

            </a>

        </div>

    </nav>


    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2 class="mb-0">
            All Posts
        </h2>

    </div>


    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-striped table-hover mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th>Title</th>

                            <th>Slug</th>

                            <th>Added On</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (mysqli_num_rows($result) === 0): ?>

                        <tr>

                            <td colspan="4"
                                class="text-center py-4 text-muted">

                                No blog posts found.

                            </td>

                        </tr>

                    <?php else: ?>


                        <?php while ($row = mysqli_fetch_assoc($result)): ?>

                            <tr>

                                <td class="fw-semibold">

                                    <?= htmlspecialchars(
                                        $row['blog_name']
                                    ) ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $row['blog_slug']
                                    ) ?>

                                </td>


                                <td>

                                    <?= date(
                                        'd M Y',
                                        strtotime($row['added_on'])
                                    ) ?>

                                </td>


                                <td>

                                    <a
                                        href="create.php?id=<?= $row['id'] ?>"
                                        class="btn btn-sm btn-outline-primary me-1"
                                        title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <a
                                        href="del.php?id=<?= $row['id'] ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this blog?');">

                                        <i class="bi bi-trash"></i>

                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>