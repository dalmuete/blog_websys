<?php
require_once('conn.php');

$query = "SELECT * FROM post";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $blogEntries = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $blogEntries = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            background-color: #fafafa;
            padding-bottom: 60px;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: -1;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            border: none;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            max-height: 200px;
            object-fit: cover;
        }

        .card-title {
            color: #405de6;
            cursor: pointer; 
            transition: text-decoration 0.2s; 
        }

        .card-title:hover {
            text-decoration: underline; 
        }

        .card-text {
            color: #333;
        }

        .btn-primary {
            background-color: #405de6;
            border: none;
        }

        .btn-primary:hover {
            background-color: #34495e;
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <?php foreach ($blogEntries as $entry) : ?>
                <div class="col-md-6">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title" onclick="window.location.href='view_blog.php?blogID=<?= $entry['blogID']; ?>'"><?= htmlspecialchars($entry['blog_title']); ?></h5>
                            <?php
                            $imagePath = !empty($entry['blog_pic']) ? htmlspecialchars($entry['blog_pic']) : 'path/to/uploads';
                            ?>
                            <img src="<?= $imagePath; ?>" class="card-img-top" alt="Blog Image">
                            <p class="card-text"><?= htmlspecialchars($entry['blog_content']); ?></p>
                            <p>Filed under: <?= htmlspecialchars($entry['blog_cat']); ?></p>
                            <p>Date: <?= htmlspecialchars($entry['dateTime_created']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
