<?php
include "includes/db.php";

$result = mysqli_query($conn, "SELECT * FROM articles ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Articles</title>
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

    <div class="max-w-4xl mx-auto p-6">

        <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">
            Articles
        </h2>
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="bg-white p-5 mb-5 rounded-md shadow-sm hover:shadow-md transition">

                    <h3 class="text-xl md:text-2xl font-semibold text-gray-900 mb-2 capitalize">
                        <?php echo $row['title']; ?>
                    </h3>

                    <p class="text-gray-600 text-sm md:text-base mb-3 first-letter:uppercase">
                        <?php
                        $words = explode(" ", $row['content']);
                        $shortText = array_slice($words, 0, 20);
                        echo implode(" ", $shortText) . "...";
                        ?>
                    </p>

                    <a
                        href="view_article.php?id=<?php echo $row['id']; ?>"
                        class="inline-block text-blue-600 text-sm hover:scale-105 transition">
                        Read more <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

            <?php } ?>
        <?php } else { ?>
            <div class="bg-white p-6 text-center text-lg rounded-md shadow-sm text-gray-600">
                No articles available
            </div>
        <?php } ?>

    </div>

</body>

</html>