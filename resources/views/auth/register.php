<?php
    session_start();

    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform de blog - Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+AU+VIC+WA+NT+Arrows:wght@400..700&family=Edu+AU+VIC+WA+NT+Pre:wght@400..700&family=League+Spartan:wght@100..900&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sansita+Swashed:wght@300..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/resources/css/style.css">
</head>
<body>
    <div class="h-screen w-full">
        <div class="w-5/6 md:w-3/6 lg:w-2/6 mx-auto mt-20 bg-white shadow-[0px_0px_4px_#a5a4a4] rounded-md p-4">
            <h1 class="text-4xl text-center mb-8">Sgin up</h1>
            <form action="./newUser.php" method="post" enctype="multipart/form-data">
                <div class="flex justify-center flex-col items-center mb-6">
                    <div class="relative hover:opacity-75">
                        <img src="/resources/img/images/default.png" alt="user" class="h-28 w-28 rounded-full">
                        <input type="file" class="inputImage h-28 w-28 border-[3px] border-red-600 cursor-pointer absolute top-0 rounded-full" name="imageProfile">
                    </div>
                    <p class="font-semibold text-red-600">Upload image</p>
                </div>
                <div class="md:flex md:gap-5 md:w-full mb-6">
                    <div class="flex flex-col md:w-2/4 mb-6 md:mb-0">
                        <label class="ml-1" for="username">Username <span class="text-red-600">*</span></label>
                        <input class="p-2 w-full rounded-lg border-2 border-red-600" type="text" name="username" id="username" placeholder="Enter your username">
                        <?php if(isset($_SESSION['emptyUsername'])) echo "<p class='text-red-500 mt-1'>".$_SESSION['emptyUsername']."</p>" ?> 
                    </div>
                    <div class="flex flex-col md:w-2/4">
                        <label class="ml-1" for="email">Email <span class="text-red-600">*</span></label>
                        <input class="p-2 w-full rounded-lg border-2 border-red-600" type="text" name="email" id="email" placeholder="Enter your email">
                        <?php 
                            if(isset($_SESSION['emptyEmail'])) echo "<p class='text-red-500 mt-1'>".$_SESSION['emptyEmail']."</p>";
                            if(isset($_SESSION['invalidEmail'])) echo "<p class='text-red-500 mt-1'>".$_SESSION['invalidEmail']."</p>";
                        ?> 
                    </div>
                </div>
                <div class="flex flex-col mb-6">
                    <label class="ml-1" for="password">Pssword <span class="text-red-600">*</span></label>
                    <input class="p-2 w-full rounded-lg border-2 border-red-600" type="password" name="password" id="password" placeholder="Enter password between 4 - 8 character">
                    <?php 
                        if(isset($_SESSION['emptyPassword'])) echo "<p class='text-red-500 mt-1'>".$_SESSION['emptyPassword']."</p>";
                        if(isset($_SESSION['notSamePassword'])) echo "<p class='text-red-500 mt-1'>".$_SESSION['notSamePassword']."</p>";
                    ?> 
                </div>
                <div class="flex flex-col mb-8">
                    <label class="ml-1" for="confirm_password">Confirm Password <span class="text-red-600">*</span></label>
                    <input class="p-2 w-full rounded-lg border-2 border-red-600" type="password" name="confirm_password" id="confirm_password" placeholder="Enter password again">
                    <?php if(isset($_SESSION['emptyConfirmPassword'])) echo "<p class='text-red-500 mt-1'>".$_SESSION['emptyConfirmPassword']."</p>" ?>
                </div>

                <div class="w-full md:flex md:justify-center">
                    <button class="bg-red-600 mb-5 px-7 py-3 w-full md:w-3/5 hover:bg-red-500 text-white rounded-lg">Sgin up</button>
                </div>
    
                <div>
                    <span>Go back to &nbsp;<a href="./login.php" class="text-red-600">Login</a></span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>