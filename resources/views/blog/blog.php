<?php 
    session_start();
    require_once('../../../connectdb/connectiondb.php'); 
    
    $getAllTags = mysqli_query($conn, "SELECT * FROM categories");

    if(isset($_POST['idTag']) && $_POST['idTag'] != 0) {
        $idTag = isset($_POST['idTag']) ? $_POST['idTag'] : 0;
        $getArticles = mysqli_query($conn, "SELECT articles.*, users.username, users.email, users.imageProfile FROM tags 
                                            INNER JOIN articles ON articles.id = tags.idArticle 
                                            INNER JOIN users ON users.id = articles.idUser 
                                            WHERE idCategory = $idTag 
                                            ORDER BY id DESC");
    } else {
        $getArticles = mysqli_query($conn,"SELECT articles.*, users.username, users.email, users.imageProfile FROM articles 
                                           INNER JOIN users ON users.id = articles.idUser 
                                           ORDER BY id DESC");
    }

    
?>

<?php include('../layout/_HEAD.php') ?>
<?php include('../layout/_SIDEBAR.php') ?>

<div class="w-full md:w-4/6 lg:w-[40%] md:mx-auto pt-24">
    <div class="w-full bg-white shadow-[0px_0px_2px_#9b9b9b] rounded-lg">
        <div class="flex flex-col sm:flex-row gap-4 w-full p-4">
            <?php if(isset($_SESSION['user'])) { ?>
                <div class="showFormArticle mb-4 sm:mb-0 py-2 sm:w-2/4 px-5 rounded-md bg-gray-200 text-gray-500 font-medium cursor-pointer hover:bg-gray-300 flex items-center gap-2">
                    <i class="fa-solid fa-newspaper"></i>
                    <h1>create article</h1>
                </div>
            <?php } ?>
            <div class="sm:w-2/4 relative">
                <div class="showpopupSort w-full h-full rounded-md px-5 bg-red-600 text-white font-medium cursor-pointer hover:bg-red-500 flex items-center gap-2">
                    <span>sort by tag</span>
                </div>
                <div class="popupSort hidden absolute w-full flex flex-col bg-white shadow-[0px_0px_5px_1px_#c2c2c2] p-1 rounded-sm top-12">
                    <?php if($getAllTags) { ?>
                        <form action="./blog.php" method="post">
                            <input type="hidden" name="idCategory" value="0">
                            <button class="w-full text-start px-2 py-1 hover:bg-gray-200">All</button>
                        </form>
                        <?php while($tag = mysqli_fetch_assoc($getAllTags)) { ?>
                            <form action="./blog.php" method="post">
                                <input type="hidden" name="idTag" value="<?php echo $tag['id'] ?>">
                                <button class="w-full text-start px-2 py-1 hover:bg-gray-200"><?php echo $tag['nameCategory'] ?></button>
                            </form>
                            <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if($getArticles) { ?>
            <?php while($article = mysqli_fetch_assoc($getArticles)) { ?>
                <div class="w-full mb-3">
                    <div class="h-80 flex items-center justify-center bg-[#200E32]">
                        <img class="h-full object-contain" src="../../img/images/<?php echo $article['image'] ?>" alt="">
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-center">
                            <div class="flex">
                                <img class="mr-3 object-cover w-12 h-12 rounded-full" src="/resources/img/images/<?php echo $article['imageProfile'] ?>" alt="">
                                
                                <div>
                                    <p class="font-semibold"><?php echo $article['username'] ?></p>
                                    <p class="text-gray-500 text-sm"><?php echo $article['email'] ?></p>
                                </div>
                            </div>
                            <div class="relative">
                                <span class="showActions text-2xl cursor-pointer hover:text-red-600" data-id="<?php echo $article['id'] ?>">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </span>
    
                                <div class="popupActions absolute hidden -right-2 mt-2 w-32 bg-white shadow-[0px_0px_5px_1px_#c2c2c2] p-1 rounded-sm" data-id="<?php echo $article['id'] ?>">
                                    <?php if($_SESSION['user']['id'] == $article['idUser']) { ?>
                                        <a href="./blog.php?idArticle=<?php echo $article['id'] ?>" class="flex items-center text-sm p-1 hover:bg-gray-200 cursor-pointer rounded-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit article
                                        </a>
                                        <a href="./blog.php?idDeleteArticle=<?php echo $article['id'] ?>" class="flex items-center text-red-700 text-sm p-1 hover:bg-red-200 cursor-pointer rounded-sm">
                                            <i class="fa-solid fa-trash-can"></i>&nbsp;Delete article
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="showFormEditArticle flex items-center text-sm p-1 hover:bg-gray-200 cursor-pointer rounded-sm">
                                            <i class="fa-solid fa-bug"></i>&nbsp;Report
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-1 mb-2 flex-wrap mt-6">
                            <?php
                                $idArticle = $article['id'];
                                $getTags = mysqli_query($conn, "SELECT tags.*, categories.nameCategory FROM tags 
                                    INNER JOIN categories ON categories.id = tags.idCategory WHERE tags.idArticle = $idArticle");
                            ?>
                            <?php if($getTags) {?>
                                <?php while($tag = mysqli_fetch_assoc($getTags)) {?>
                                        <span class="bg-blue-400 rounded-sm py-1 px-2 text-[12px] text-white"><?php echo $tag['nameCategory'] ?></span>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="mb-4">
                            <h1 class="font-semibold text-3xl mb-2">
                                    <a href="./detailsArticle.php?idArticle=<?php echo $article['id'] ?>" class="hover:text-red-300">
                                        <?php echo $article['title'] ?>
                                    </a>
                                </h1>
                            <p class="break-words">
                                <?php echo $article['content'] ?>
                            </p>
                        </div>
                        <div class="flex justify-between border-b-2 border-t-2 py-2">
                            <div class="flex gap-5">
                                <div class="flex items-center">
                                    <span class="mr-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="#cf4c4c" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                                    </span>
                                    <!-- count total likes -->
                                    <?php
                                        $getAllLikes = mysqli_query($conn, "SELECT * FROM likes WHERE idArticle = $idArticle");
                                        $totalLikes = mysqli_num_rows($getAllLikes);
                                        echo "$totalLikes like";
                                    ?>
                                </div>
                                <div class="flex items-center">
                                    <!-- icon comments -->
                                    <span class="mr-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 -960 960 960" fill="#6d6972"><path d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z"/></svg>
                                    </span>
                                    <?php
                                        $getAllComments = mysqli_query($conn, "SELECT * FROM comments WHERE idArticle = $idArticle");
                                        $totalComments = mysqli_num_rows($getAllComments);
                                        echo "$totalComments comment";
                                    ?>
                                </div>
                            </div>
                            <!-- icon views -->
                            <div class="flex items-center">
                                <a href="#" class="mr-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="hover:fill-[#200E32] transition duration-300 ease-in-out" height="20px" viewBox="0 -960 960 960" width="20px" fill="#6d6972"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                </a>
                                <p>0 views</p>
                            </div>
                        </div>
                        <div class="flex justify-between py-2 mb-6">
                            <div class="flex gap-3">
                                <!-- icon like -->
                                <?php $idUser = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
                                        $getLikes = mysqli_query($conn, "SELECT * FROM likes WHERE idUser = $idUser AND idArticle = $idArticle");
                                        $userLike = mysqli_num_rows($getLikes); 
                                ?>
                                <?php if(isset($_SESSION['user'])) { ?>
                                    <form action="./add_delete_like.php" method="post">
                                        <input type="hidden" value="<?php echo $article['id'] ?>" name="idArticle">
                                        <input type="hidden" value="<?php echo $_SERVER['PHP_SELF'] ?>" name="currentPath">
                                        <?php if($userLike == 0) { ?>
                                            <button class="hover:scale-110 transition duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28px" height="28px" fill="#cf4c4c" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg>
                                            </button>
                                        <?php } else { ?>
                                            <button class="hover:scale-110 transition duration-300 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28px" height="28px" fill="#cf4c4c" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                                            </button>
                                        <?php } ?>
                                    </form>
                                    <!-- icon comments for users -->
                                    <a href="./detailsArticle.php?idArticle=<?php echo $article['id'] ?>" class="hover:scale-110 transition duration-300 ease-in-out cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 -960 960 960" fill="#6d6972"><path d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z"/></svg>
                                    </a>
                                <?php } else { ?>
                                    <a href="../auth/login.php" class="hover:scale-110 transition duration-300 ease-in-out cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28px" height="28px" fill="#cf4c4c" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg>
                                    </a>
                                        <!-- icon comments for visitor -->
                                    <a href="../auth/login.php" class="hover:scale-110 transition duration-300 ease-in-out cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 -960 960 960" fill="#6d6972"><path d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z"/></svg>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="flex">
                                <!-- icons saves -->
                                <a href="#" class="hover:scale-110 transition duration-300 ease-in-out cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#6d6972"><path d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<?php include('./deleteArticle.php') ?>

<?php include('./addArticle.php') ?>
<?php include('./editArticle.php') ?>

<?php include('../layout/_FOOTER.php') ?>