<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include "../includes/db.php";


if (isset($_POST['add'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];

    // insert data
    $stmt = $conn->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();

    header("Location: dashboard.php?msg=added");
    exit;
}


$getArticles = mysqli_query($conn, "SELECT * FROM articles ORDER BY id DESC");
?>


<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>

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

    <div class="max-w-5xl mx-auto p-6">

        <div class="mb-6 flex justify-between items-center gap-4">
            <h2 class="text-2xl font-semibold mb-4 capitalize">
                Welcome, <?php echo $_SESSION['admin']; ?>!
            </h2>

            <button
                onclick="openModal()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 hover:scale-105 transition duration-300">
                <i class="fa-solid fa-plus"></i> Add Article
            </button>

            <a href="logout.php" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 hover:scale-105 transition duration-300">
                Logout <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>

        <!-- Message -->
        <?php if (isset($_GET['msg'])) { ?>
            <div
                id="msgBox"
                class="text-white px-4 py-2 mb-4 rounded"
                style="
                background:
                <?php
                if ($_GET['msg'] == 'added') echo '#22c55e';
                if ($_GET['msg'] == 'updated') echo '#3b82f6';
                if ($_GET['msg'] == 'deleted') echo '#ef4444';
                ?>;
            ">
                <?php
                if ($_GET['msg'] == 'added') echo 'Article added successfully';
                if ($_GET['msg'] == 'updated') echo 'Article updated successfully';
                if ($_GET['msg'] == 'deleted') echo 'Article deleted successfully';
                ?>
            </div>

            <script>
                setTimeout(() => {
                    const box = document.getElementById("msgBox");
                    if (box) box.style.display = "none";
                }, 2500);

                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.pathname);
                }
            </script>
        <?php } ?>


        <div class="bg-white border rounded">
            <table class="w-full text-left border-collapse">
                <thead class="text-center bg-gray-200">
                    <tr>
                        <th class="p-2 border border-gray-300">ID</th>
                        <th class="p-2 border border-gray-300">Title</th>
                        <th class="p-2 border border-gray-300">Content</th>
                        <th class="p-2 border border-gray-300">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($getArticles) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($getArticles)) { ?>
                            <tr class="border-t">
                                <td class="p-2 text-center text-gray-600 border border-gray-300"><?php echo $row['id']; ?></td>
                                <td class="p-2 border border-gray-300"><?php echo $row['title']; ?></td>

                                <td class="p-2 text-sm text-gray-700 border border-gray-300">
                                    <?php
                                    $words = explode(" ", $row['content']);
                                    echo implode(" ", array_slice($words, 0, 5)) . "...";
                                    ?>
                                </td>

                                <td class="p-2 text-center border border-gray-300">
                                    <a
                                        href="edit_article.php?id=<?php echo $row['id']; ?>"
                                        class="inline-block bg-blue-600 px-3 py-1 text-white hover:scale-105 mr-2 transition duration-300 rounded-md">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>

                                    <a
                                        href="delete_article.php?id=<?php echo $row['id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this article?')"
                                        class="inline-block bg-red-600 px-3 py-1 text-white hover:scale-105 mr-2 transition duration-300 rounded-md">
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                No data found
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <div id="articleModal" class="hidden fixed inset-0 bg-black bg-opacity-40">

        <div class="bg-white w-[320px] mx-auto mt-28 p-5 rounded">
            <h3 class="text-xl text-center mb-3 font-semibold">Add Article</h3>

            <form method="POST">
                <input
                    type="text"
                    name="title"
                    placeholder="Title"
                    class="w-full border p-2 mb-3 rounded-lg"
                    required>

                <textarea
                    name="content"
                    rows="4"
                    placeholder="Content"
                    class="w-full border p-2 mb-3 rounded-lg"
                    required></textarea>

                <button
                    type="submit"
                    name="add"
                    class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:scale-105 transition duration-300">
                    Save
                </button>

                <button
                    type="button"
                    onclick="closeModal()"
                    class="bg-gray-500 text-white px-3 py-1 rounded-lg ml-2 hover:scale-105 transition duration-300">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("articleModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("articleModal").classList.add("hidden");
        }
    </script>

</body>

</html>
