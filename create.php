<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'connection.php';

$edit = false;

$id = '';
$blog_name = '';
$blog_slug = '';
$blog_content = '';

if (isset($_GET['id'])) {

    $edit = true;

    $id = (int) $_GET['id'];

    $stmt = mysqli_prepare(
        $link,
        "SELECT blog_name, blog_slug, blog_content
         FROM blogs
         WHERE id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        'i',
        $id
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result(
        $stmt,
        $blog_name,
        $blog_slug,
        $blog_content
    );

    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $blog_name = $_POST['blog_name'];
    $blog_slug = $_POST['blog_slug'];
    $blog_content = $_POST['blog_content'];

    if (!empty($_POST['id'])) {

        $id = (int) $_POST['id'];

        $stmt = mysqli_prepare(
            $link,
            "UPDATE blogs
             SET blog_name = ?,
                 blog_slug = ?,
                 blog_content = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            'sssi',
            $blog_name,
            $blog_slug,
            $blog_content,
            $id
        );

    } else {

        $stmt = mysqli_prepare(
            $link,
            "INSERT INTO blogs
             (blog_name, blog_slug, blog_content)
             VALUES (?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            'sss',
            $blog_name,
            $blog_slug,
            $blog_content
        );
    }


    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        header('Location: index.php');

        exit;

    } else {

        die(
            "Database error: " .
            mysqli_error($link)
        );
    }
}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?= $edit ? 'Edit Blog' : 'Create Blog' ?>
    </title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>


<body class="bg-light">


<div class="container py-4">

    <nav class="navbar navbar-light bg-white shadow-sm rounded px-3 mb-4">

        <a
            href="index.php"
            class="navbar-brand fw-bold">

            My Blog

        </a>

    </nav>

    <div class="card shadow-sm border-0">

        <div class="card-body p-4">


            <h2 class="mb-4">

                <?= $edit ? 'Edit Blog' : 'Create Blog' ?>

            </h2>


            <form method="POST">


                <?php if ($edit): ?>

                    <input
                        type="hidden"
                        name="id"
                        value="<?= htmlspecialchars($id) ?>">

                <?php endif; ?>


                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Blog Name

                    </label>

                    <input
                        type="text"
                        name="blog_name"
                        class="form-control"
                        value="<?= htmlspecialchars($blog_name) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Blog URL (Slug)

                    </label>

                    <input
                        type="text"
                        name="blog_slug"
                        class="form-control"
                        value="<?= htmlspecialchars($blog_slug) ?>"
                        placeholder="my-first-blog"
                        required>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Content

                    </label>

                    <textarea
                        name="blog_content"
                        id="blog_content"
                        class="form-control"
                        rows="10"
                        required><?= htmlspecialchars($blog_content) ?></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-check-circle"></i>

                    <?= $edit ? 'Update Blog' : 'Save Blog' ?>

                </button>


                <a
                    href="index.php"
                    class="btn btn-secondary">

                    Cancel

                </a>


            </form>

        </div>

    </div>

</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>

CKEDITOR.replace('blog_content');

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>