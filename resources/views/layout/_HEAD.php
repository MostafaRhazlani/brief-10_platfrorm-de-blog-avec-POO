<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platfrom de blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+AU+VIC+WA+NT+Arrows:wght@400..700&family=Edu+AU+VIC+WA+NT+Pre:wght@400..700&family=League+Spartan:wght@100..900&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sansita+Swashed:wght@300..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/resources/css/style.css">
</head>
<body class="">

<div class="relative h-full">
    <div class="p-3 md:pl-20 fixed top-0 z-20 bg-white w-full shadow-[0px_0px_5px_1px_#c2c2c2]">
        <div class="flex items-center justify-between">
            <?php if(isset($_SESSION['user'])) { ?>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="cursor-pointer hover:opacity-60 showPopupUser">
                            <div class="flex justify-center items-center absolute w-5 h-5 bottom-0 bg-white rounded-full">
                                <span class="text-sm font-bold text-gray-500">
                                    <i class="fa-solid fa-circle-chevron-down"></i>
                                </span>
                            </div>
                            <img class="w-16 h-16 object-cover rounded-full" src="/resources/img/images/<?php echo $_SESSION['user']['imageProfile'] ?>" alt="">
                        </div>
        
                        <div class="popupUser hidden absolute mt-2 w-32 bg-white shadow-[0px_0px_5px_1px_#c2c2c2] p-2 rounded-md">
                            <a href class="flex items-center p-1 hover:bg-gray-200 cursor-pointer rounded-sm"><i class="fa-solid fa-user"></i>&nbsp;Profile</a>
                            <a href="/resources/views/auth/logout.php" class="flex items-center p-1 hover:bg-gray-200 cursor-pointer rounded-sm"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>
                        </div>
                    </div>
        
                    <a href="#" class="text-3xl">
                        <i class="fa-regular fa-bell"></i>
                    </a>
                </div>
            <?php }else { ?>
                <div class="w-full flex justify-end">
                    <div class="flex gap-3">
                        <a href="/resources/views/auth/login.php" class="bg-red-600 text-white py-1 px-4 rounded-md hover:bg-red-500">Sign in</a>
                        <a href="/resources/views/auth/register.php" class="bg-[#200E32] text-white py-1 px-4 rounded-md hover:bg-[#5f2f90]">Sign up</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
