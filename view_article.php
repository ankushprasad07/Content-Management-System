<?php
include "includes/db.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM articles WHERE id = $id");
$article = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $article['title']; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white p-6 rounded shadow-sm">

        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4 first-letter:uppercase">
            <?php echo $article['title']; ?>
        </h2>

        <p class="text-gray-700 leading-[2.2] text-justify mb-6 first-letter:uppercase">
            <?php echo $article['content']; ?>
        </p>

        <a 
            href="index.php" 
            class="inline-block text-blue-600 text-xl hover:scale-105 transition"
        >
            <i class="fa-solid fa-arrow-left"></i> Back to Articles
        </a>

    </div>

</div>

</body>
</html>
