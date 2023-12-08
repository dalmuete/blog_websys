<?php
require_once('conn.php');

if (isset($_GET['blogID'])) {
    $blogID = $_GET['blogID'];

    $stmt = $conn->prepare("SELECT * FROM post WHERE blogID = ?");
    $stmt->bind_param('i', $blogID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $blogEntry = $result->fetch_assoc();
    } else {
        echo "Blog entry not found.";
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM comment WHERE blogID = ?");
    $stmt->bind_param('i', $blogID);
    $stmt->execute();
    $commentsResult = $stmt->get_result();

    if ($commentsResult->num_rows > 0) {
        $comments = $commentsResult->fetch_all(MYSQLI_ASSOC);
    } else {
        $comments = [];
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Blog Entry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            background-color: #fafafa;
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

        h2 {
            color: #405de6;
            font-size: 15px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            
        }

        p {
            margin-top: 20px;
            color: #333;
        }

        h3 {
            color: #405de6;
            margin-top: 20px;
        }

        .card {
            margin-top: 10px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 15px;
        }

        .card-text {
            color: #333;
        }

        .form-group {
            margin-top: 20px;
        }

        label {
            color: #333;
        }

        textarea {
            border: 2px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }

        textarea:focus {
            border-color: #405de6;
            box-shadow: 0 0 5px rgba(64, 93, 230, 0.5);
        }

        .btn-primary {
            background-color: #405de6;
            border: none;
            width: 100%;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #34495e;
        }
        body {
            margin-bottom: 200px;
        }
        .btn-primary {
            margin-bottom: 60px;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        footer{
            padding-bottom: 60px;
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <h2><?= htmlspecialchars($blogEntry['blog_title']); ?></h2>
        <?php if (!empty($blogEntry['blog_pic'])) : ?>
            <img src="<?= htmlspecialchars($blogEntry['blog_pic']); ?>" class="img-fluid mx-auto d-block" alt="Blog Image">
        <?php endif; ?>
        <p><?= htmlspecialchars($blogEntry['blog_content']); ?></p>
        <p>Filed under: <?= htmlspecialchars($blogEntry['blog_cat']); ?></p>
        <p>Date: <?= htmlspecialchars($blogEntry['dateTime_created']); ?></p>

        <h3>Comments</h3>
        <?php foreach ($comments as $comment) : ?>
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><?= htmlspecialchars($comment['UserNAME']) ?> says: <?= htmlspecialchars($comment['Comment']); ?> <?= htmlspecialchars($comment['DateTime']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <form action="post_comment.php" method="post">
            <input type="hidden" name="blogID" value="<?= $blogID; ?>">
            <div class="form-group">
                <label for="comment">Your Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post a Comment</button>
        </form>
    </div>
</body>

</html>
