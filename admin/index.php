<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

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

    <div class="flex justify-center items-center min-h-screen">

        <div class="bg-white p-6 w-96 border border-gray-200 rounded-xl shadow-xl">

            <h2 class="text-2xl text-center font-bold mb-4">Admin Login</h2>

            <?php if (isset($_GET['error'])) { ?>
                <div id="errorBox" class="bg-red-100 text-red-700 text-center font-semibold p-2 mb-3 rounded-lg">
                    Wrong username or password
                </div>

                <script>
                    setTimeout(function() {
                        var box = document.getElementById("errorBox");
                        if (box) {
                            box.style.display = "none";
                        }
                    }, 2500);

                    // clean url
                    if (window.history.replaceState) {
                        var cleanUrl = window.location.href.split("?")[0];
                        window.history.replaceState(null, null, cleanUrl);
                    }
                </script>
            <?php } ?>

            <form action="login.php" method="POST">

                <div class="pt-3 mb-3">
                    <label class="block text-md font-semibold mb-1">Username :</label>
                    <input
                        type="text"
                        name="username"
                        class="w-full border rounded-lg px-2 py-1"
                        required>
                </div>

                <div class="pt-3 mb-4">
                    <label class="block text-md font-semibold mb-1">Password :</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded-lg px-2 py-1"
                        required>
                </div>

                <button
                    type="submit"
                    class="mx-auto block bg-blue-600 text-white rounded-lg mt-2 px-4 py-2 hover:scale-105 active:scale-95 transition duration-300">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                </button>

            </form>

        </div>

    </div>

</body>

</html>