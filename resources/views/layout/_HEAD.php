<?php 
    require_once __DIR__ . "/../../../controllers/CRUDController.php";

    if(isset($_SESSION['user'])) {
        $user = new CRUDContoller("users", "imageProfile", "id", $_SESSION['user']['id']);

        $getAdmin = $user->conditionSelect();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platfrom de blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/resources/css/style.css">
</head>
<body class="bg-[#131415]">

<div class="relative lg:static md:flex md:justify-between md:px-4 md:gap-5">
    <div class="p-3 md:pl-20 min-h-[65px] fixed top-0 left-0 z-20 bg-[#25272A] w-full">
        <div class="flex items-center justify-between">
            <?php if(isset($_SESSION['user'])) { ?>
                <div class="flex items-center gap-4">
                    <div class="">
                        <div class="cursor-pointer hover:opacity-60 showPopupUser w-14 h-14 rounded-xl bg-white">
                            <img class="object-cover" src="/resources/img/images/<?php echo $getAdmin['imageProfile'] ?>" alt="">
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
