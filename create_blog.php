<?php
require_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blogEntry = $_POST['blogEntry'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $picturePath = '';
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);
        $picturePath = $uploadFile;
    }

    $stmt = $conn->prepare("INSERT INTO post (blog_title, blog_content, dateTime_created, blog_cat, blog_pic) VALUES (?, ?, NOW(), ?, ?)");
    $stmt->bind_param('ssss', $blogEntry, $content, $category, $picturePath);

    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Blog Entry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            background-color: #fafafa;
        }

        body::before {
            content: "";
            position: absolute;
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
            text-align: center;
            color: #405de6;
        }

        label {
            color: #333;
        }

        .form-control {
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        .form-control:focus {
            border-color: #405de6;
            box-shadow: 0 0 5px rgba(64, 93, 230, 0.5);
        }

        .form-group select {
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        .form-group select:focus {
            border-color: #405de6;
            box-shadow: 0 0 5px rgba(64, 93, 230, 0.5);
        }

        .form-control-file {
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        .form-control-file:focus {
            border-color: #405de6;
            box-shadow: 0 0 5px rgba(64, 93, 230, 0.5);
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
        <h2>Create Blog Entry</h2>
        <form action="create_blog.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="blogEntry">Blog Entry:</label>
                <input type="text" class="form-control" id="blogEntry" name="blogEntry" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Filed under:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="technology">Technology</option>
                    <option value="travel">Travel</option>
                    <option value="fashion">Fashion</option>
                    <option value="fitness">Fitness</option>
                    <option value="food">Food</option>
                    <option value="lifestyle">Lifestyle</option>
                    <option value="health">Health</option>
                    <option value="finance">Finance</option>
                    <option value="entertainment">Entertainment</option>
                    <option value="education">Education</option>
                </select>
            </div>
            <div class="form-group">
                <label for="picture">Insert Picture:</label>
                <input type="file" class="form-control-file" id="picture" name="picture">
            </div>
            <button type="submit" class="btn btn-primary">ADD ENTRY</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
