<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include "../includes/db.php";

$id = $_GET['id'];

$get = mysqli_query($conn, "SELECT * FROM articles WHERE id = $id");
$article = mysqli_fetch_assoc($get);

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];


    $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();

    header("Location: dashboard.php?msg=updated");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Article</title>
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

<body class="bg-gray-200">

    <div class="max-w-2xl mx-auto mt-20 bg-white p-5 border rounded-xl shadow-lg">

        <h3 class="text-2xl text-center font-semibold mb-4">Edit Article</h3>

        <form method="POST">

            <div class="mb-4">
                <label class="block mb-1 text-lg font-semibold">Title :</label>
                <input
                    type="text"
                    name="title"
                    value="<?php echo $article['title']; ?>"
                    class="w-full border px-2 py-1 rounded-lg"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-lg font-semibold">Content :</label>
                <textarea
                    name="content"
                    rows="6"
                    class="w-full border px-2 py-1 rounded-lg"
                    required><?php echo $article['content']; ?></textarea>
            </div>

            <div class="flex justify-evenly">
                <button
                    type="submit"
                    name="update"
                    class="bg-blue-600 text-white font-semibold px-4 py-1 rounded-lg hover:scale-105 hover:shadow-lg transition duration-300">
                    <i class="fa-solid fa-pen-to-square"></i> Update
                </button>

                <a href="dashboard.php" class="inline-block bg-green-600 text-white font-semibold px-4 py-1 rounded-lg hover:scale-105 hover:shadow-lg transition duration-300">
                    <i class="fa-solid fa-arrow-left"></i> Go back
                </a>
            </div>

        </form>

    </div>

</body>

</html>