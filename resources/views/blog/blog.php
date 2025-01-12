<?php 
    session_start();
    require_once __DIR__ . '/../../../controllers/ArticleController.php';
    require_once __DIR__ . '/../../../controllers/TagController.php';
    require_once __DIR__ . '/../../../controllers/LikeArticle.php';
    require_once __DIR__ . '/../../../controllers/CommentController.php';


    $articles = new ArticleController();
    $getArticles = $articles->index();

    $tags = new TagController();
    $getAllTags = $tags->index();
?>

<?php include('../layout/_HEAD.php') ?>
<?php include('../layout/_SIDEBAR.php') ?>

<div class="hideScroll w-full md:h-screen overflow-scroll md:w-4/6 md:pt-24">
    <div class="w-full h-full text-white">
        <div class="flex flex-col bg-[#202225] mb-4 rounded-lg sm:flex-row sm:justify-between gap-4 w-full px-4 py-3">
            <div class="sm:w-[50%] rounded-md bg-[#2f3236]">
                <input class="h-[40px] w-full bg-[#2f3236] rounded-md px-3 py-2" type="text" placeholder="Search...">
            </div>
            <?php if(isset($_SESSION['user'])) { ?>
                <div class="showFormArticle py-2 px-5 rounded-md bg-[#FFD37D] text-black text-center font-medium cursor-pointer hover:bg-gray-300 flex items-center gap-2">
                    <i class="fa-solid fa-newspaper"></i>
                    <h1>Add new article</h1>
                </div>
            <?php } ?>
        </div>
        <div class="w-full relative flex justify-end mb-4">
            <div class="showpopupSort rounded-md px-5 text-white font-medium cursor-pointer flex items-center gap-2">
                <p class="text-gray-400">sort by:</p>
                <span> Category</span>
            </div>
            <div class="popupSort hidden absolute flex flex-col p-1 rounded-sm top-12 right-0">
                <?php if(isset($getAllTags)) { ?>
                    <form action="./blog.php" method="post">
                        <input type="hidden" name="idCategory" value="0">
                        <button class="w-full text-start px-2 py-1 hover:bg-gray-200">All</button>
                    </form>
                    <?php foreach($getAllTags as $tag) { ?>
                        <form action="./blog.php" method="post">
                            <input type="hidden" name="idTag" value="<?php echo $tag['id'] ?>">
                            <button class="w-full text-start px-2 py-1 hover:bg-gray-200"><?php echo $tag['nameCategory'] ?></button>
                        </form>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    
        <div class="grid grid-cols-2 gap-3">
            <?php if(isset($getArticles)) { ?>
                <?php foreach($getArticles as $article) { ?>
                    <div class="w-full bg-[#202225] rounded-lg overflow-hidden p-4">
                        <!-- <div class="w-full"> -->
                            <div class="h-80 rounded-lg overflow-hidden">
                                <img class="h-full object-cover" src="../../img/images/<?php echo $article['image'] ?>" alt="">
                            </div>
                            <div class="pt-4">
                                <div class="flex justify-between items-center">
                                    <div class="flex">
                                        <img class="mr-3 object-cover w-12 h-12 rounded-full" src="/resources/img/images/<?php echo $article['imageProfile'] ?>" alt="">
                                        
                                        <div>
                                            <p class="font-semibold"><?php echo $article['username'] ?></p>
                                            <p class="text-gray-500 text-sm"><?php echo $article['email'] ?></p>
                                        </div>
                                    </div>
                                    <?php if(isset($_SESSION['user'])) { ?>
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
                                    <?php } ?>
                                </div>
                                <div class="flex gap-1 mb-2 flex-wrap mt-6">
                                    <?php
                                        $idArticle = $article['id'];
                                        $tagsOfArticle = new ArticleController($idArticle);
                                        $getTagsOfArticle = $tagsOfArticle->getTagsOfArticle();
                                    ?>
                                    <?php if(isset($getTagsOfArticle)) {?>
                                        <?php foreach($getTagsOfArticle as $tag) {?>
                                                <span class="bg-blue-400 rounded-sm py-1 px-2 text-[12px] text-white"><?php echo $tag['nameTag'] ?></span>
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
                                <div class="flex gap-2 justify-between border-t border-gray-500 pt-2">
                                    <?php if(isset($_SESSION['user'])) { ?>
                                        <!-- icon like -->
                                        <?php 
                                            $likes = new LikeArticle($article['id'], $_SESSION['user']['id']);
                                            $totalUserLike = $likes->totalUserLike();
                                        ?>
                                        <div class="w-full">
                                            <form action="./add_delete_like.php" method="post">
                                                <input type="hidden" value="<?php echo $article['id'] ?>" name="idArticle">
                                                <input type="hidden" name="likeArticle">
                                                <input type="hidden" value="<?php echo $_SERVER['PHP_SELF'] ?>" name="currentPath">
                                                <?php if($totalUserLike == 0) { ?>
                                                    <button class="flex justify-center items-center gap-1 hover:text-black hover:bg-[#FFD37D] duration-500 w-full rounded-sm p-1">
                                                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.5" d="M12 5.50098L14 7.5004" stroke="#ff2c2c" stroke-width="1.5" stroke-linecap="round"/>
                                                            <path d="M8.96173 18.9109L9.42605 18.3219L8.96173 18.9109ZM12 5.50063L11.4596 6.02073C11.601 6.16763 11.7961 6.25063 12 6.25063C12.2039 6.25063 12.399 6.16763 12.5404 6.02073L12 5.50063ZM15.0383 18.9109L15.5026 19.4999L15.0383 18.9109ZM9.42605 18.3219C7.91039 17.1271 6.25307 15.9603 4.93829 14.4798C3.64922 13.0282 2.75 11.3345 2.75 9.1371H1.25C1.25 11.8026 2.3605 13.8361 3.81672 15.4758C5.24723 17.0866 7.07077 18.3752 8.49742 19.4999L9.42605 18.3219ZM2.75 9.1371C2.75 6.98623 3.96537 5.18252 5.62436 4.42419C7.23607 3.68748 9.40166 3.88258 11.4596 6.02073L12.5404 4.98053C10.0985 2.44352 7.26409 2.02539 5.00076 3.05996C2.78471 4.07292 1.25 6.42503 1.25 9.1371H2.75ZM8.49742 19.4999C9.00965 19.9037 9.55954 20.3343 10.1168 20.6599C10.6739 20.9854 11.3096 21.25 12 21.25V19.75C11.6904 19.75 11.3261 19.6293 10.8736 19.3648C10.4213 19.1005 9.95208 18.7366 9.42605 18.3219L8.49742 19.4999ZM15.5026 19.4999C16.9292 18.3752 18.7528 17.0866 20.1833 15.4758C21.6395 13.8361 22.75 11.8026 22.75 9.1371H21.25C21.25 11.3345 20.3508 13.0282 19.0617 14.4798C17.7469 15.9603 16.0896 17.1271 14.574 18.3219L15.5026 19.4999ZM22.75 9.1371C22.75 6.42503 21.2153 4.07292 18.9992 3.05996C16.7359 2.02539 13.9015 2.44352 11.4596 4.98053L12.5404 6.02073C14.5983 3.88258 16.7639 3.68748 18.3756 4.42419C20.0346 5.18252 21.25 6.98623 21.25 9.1371H22.75ZM14.574 18.3219C14.0479 18.7366 13.5787 19.1005 13.1264 19.3648C12.6739 19.6293 12.3096 19.75 12 19.75V21.25C12.6904 21.25 13.3261 20.9854 13.8832 20.6599C14.4405 20.3343 14.9903 19.9037 15.5026 19.4999L14.574 18.3219Z" fill="#ff2c2c"/>
                                                        </svg>
                                                        <?php
                                                            $likes = new LikeArticle($article['id'], "");
                                                            $totalLikes = $likes->totalLikesArticle();
                                                            echo "<p>$totalLikes Like</p>"
                                                        ?>
                                                    </button>
                                                <?php } else { ?>
                                                    <button class="flex justify-center items-center gap-1 hover:bg-[#FFD37D] hover:bg-opacity-75 duration-500 w-full rounded-sm p-1">
                                                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.10627 18.2468C5.29819 16.0833 2 13.5422 2 9.1371C2 4.27416 7.50016 0.825464 12 5.50063L14 7.49928C14.2929 7.79212 14.7678 7.79203 15.0607 7.49908C15.3535 7.20614 15.3534 6.73127 15.0605 6.43843L13.1285 4.50712C17.3685 1.40309 22 4.67465 22 9.1371C22 13.5422 18.7018 16.0833 15.8937 18.2468C15.6019 18.4717 15.3153 18.6925 15.0383 18.9109C14 19.7294 13 20.5 12 20.5C11 20.5 10 19.7294 8.96173 18.9109C8.68471 18.6925 8.39814 18.4717 8.10627 18.2468Z" fill="#ff2c2c"/>
                                                        </svg>
                                                        <?php
                                                            $likes = new LikeArticle($article['id'],"");
                                                            $totalLikes = $likes->totalLikesArticle();
                                                            echo "<p>$totalLikes Like</p>";
                                                        ?>
                                                    </button>
                                                <?php } ?>
                                            </form>
                                            
                                        </div>
                                        <!-- icon comments for users -->
                                        <a href="./detailsArticle.php?idArticle=<?php echo $article['id'] ?>" class="flex justify-center items-center rounded-sm gap-1 group hover:bg-[#FFD37D] hover:text-black duration-500 w-full">
                                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="group-hover:stroke-black duration-500" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 14.663 3.04094 17.0829 4.73812 18.875L2.72681 21.1705C2.44361 21.4937 2.67314 22 3.10288 22H12Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7 9H17" class="group-hover:stroke-black duration-500" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7 13H11" class="group-hover:stroke-black duration-500" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <?php $comments = new CommentController("", "", $article['id']);
                                                $totalCommentsArticle = $comments->totalCommentsArticle();

                                                echo "$totalCommentsArticle Comment";
                                            ?>
                                        </a>

                                        <!-- icons saves -->
                                        <a href="#" class="flex justify-center items-center hover:bg-[#FFD37D] hover:text-black group duration-500 w-full rounded-sm">
                                            <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="group-hover:stroke-black duration-500" d="M12.89 5.87988H5.10999C3.39999 5.87988 2 7.27987 2 8.98987V20.3499C2 21.7999 3.04 22.4199 4.31 21.7099L8.23999 19.5199C8.65999 19.2899 9.34 19.2899 9.75 19.5199L13.68 21.7099C14.95 22.4199 15.99 21.7999 15.99 20.3499V8.98987C16 7.27987 14.6 5.87988 12.89 5.87988Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path class="group-hover:stroke-black duration-500" d="M16 8.98987V20.3499C16 21.7999 14.96 22.4099 13.69 21.7099L9.76001 19.5199C9.34001 19.2899 8.65999 19.2899 8.23999 19.5199L4.31 21.7099C3.04 22.4099 2 21.7999 2 20.3499V8.98987C2 7.27987 3.39999 5.87988 5.10999 5.87988H12.89C14.6 5.87988 16 7.27987 16 8.98987Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path class="group-hover:stroke-black duration-500" d="M22 5.10999V16.47C22 17.92 20.96 18.53 19.69 17.83L16 15.77V8.98999C16 7.27999 14.6 5.88 12.89 5.88H8V5.10999C8 3.39999 9.39999 2 11.11 2H18.89C20.6 2 22 3.39999 22 5.10999Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>&nbsp;
                                            Saves
                                        </a>
                                    <?php } else { ?>
                                        <a href="../auth/login.php" class="flex justify-center items-center gap-1 hover:text-black hover:bg-[#FFD37D] duration-500 w-full rounded-sm p-1">
                                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.5" d="M12 5.50098L14 7.5004" stroke="#ff2c2c" stroke-width="1.5" stroke-linecap="round"/>
                                                <path d="M8.96173 18.9109L9.42605 18.3219L8.96173 18.9109ZM12 5.50063L11.4596 6.02073C11.601 6.16763 11.7961 6.25063 12 6.25063C12.2039 6.25063 12.399 6.16763 12.5404 6.02073L12 5.50063ZM15.0383 18.9109L15.5026 19.4999L15.0383 18.9109ZM9.42605 18.3219C7.91039 17.1271 6.25307 15.9603 4.93829 14.4798C3.64922 13.0282 2.75 11.3345 2.75 9.1371H1.25C1.25 11.8026 2.3605 13.8361 3.81672 15.4758C5.24723 17.0866 7.07077 18.3752 8.49742 19.4999L9.42605 18.3219ZM2.75 9.1371C2.75 6.98623 3.96537 5.18252 5.62436 4.42419C7.23607 3.68748 9.40166 3.88258 11.4596 6.02073L12.5404 4.98053C10.0985 2.44352 7.26409 2.02539 5.00076 3.05996C2.78471 4.07292 1.25 6.42503 1.25 9.1371H2.75ZM8.49742 19.4999C9.00965 19.9037 9.55954 20.3343 10.1168 20.6599C10.6739 20.9854 11.3096 21.25 12 21.25V19.75C11.6904 19.75 11.3261 19.6293 10.8736 19.3648C10.4213 19.1005 9.95208 18.7366 9.42605 18.3219L8.49742 19.4999ZM15.5026 19.4999C16.9292 18.3752 18.7528 17.0866 20.1833 15.4758C21.6395 13.8361 22.75 11.8026 22.75 9.1371H21.25C21.25 11.3345 20.3508 13.0282 19.0617 14.4798C17.7469 15.9603 16.0896 17.1271 14.574 18.3219L15.5026 19.4999ZM22.75 9.1371C22.75 6.42503 21.2153 4.07292 18.9992 3.05996C16.7359 2.02539 13.9015 2.44352 11.4596 4.98053L12.5404 6.02073C14.5983 3.88258 16.7639 3.68748 18.3756 4.42419C20.0346 5.18252 21.25 6.98623 21.25 9.1371H22.75ZM14.574 18.3219C14.0479 18.7366 13.5787 19.1005 13.1264 19.3648C12.6739 19.6293 12.3096 19.75 12 19.75V21.25C12.6904 21.25 13.3261 20.9854 13.8832 20.6599C14.4405 20.3343 14.9903 19.9037 15.5026 19.4999L14.574 18.3219Z" fill="#ff2c2c"/>
                                            </svg>
                                        </a>
                                            <!-- icon comments for visitor -->
                                        <a href="../auth/login.php" class="flex justify-center items-center gap-1 hover:text-black group hover:bg-[#FFD37D] duration-500 w-full rounded-sm p-1">
                                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="group-hover:stroke-black duration-500" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 14.663 3.04094 17.0829 4.73812 18.875L2.72681 21.1705C2.44361 21.4937 2.67314 22 3.10288 22H12Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path class="group-hover:stroke-black duration-500" d="M7 9H17" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path class="group-hover:stroke-black duration-500" d="M7 13H11" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <!-- icons saves for visitor -->
                                        <a href="#" class="flex justify-center items-center gap-1 hover:text-black hover:bg-[#FFD37D] duration-500 w-full group rounded-sm p-1">
                                            <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="group-hover:stroke-black duration-500" d="M12.89 5.87988H5.10999C3.39999 5.87988 2 7.27987 2 8.98987V20.3499C2 21.7999 3.04 22.4199 4.31 21.7099L8.23999 19.5199C8.65999 19.2899 9.34 19.2899 9.75 19.5199L13.68 21.7099C14.95 22.4199 15.99 21.7999 15.99 20.3499V8.98987C16 7.27987 14.6 5.87988 12.89 5.87988Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path class="group-hover:stroke-black duration-500" d="M16 8.98987V20.3499C16 21.7999 14.96 22.4099 13.69 21.7099L9.76001 19.5199C9.34001 19.2899 8.65999 19.2899 8.23999 19.5199L4.31 21.7099C3.04 22.4099 2 21.7999 2 20.3499V8.98987C2 7.27987 3.39999 5.87988 5.10999 5.87988H12.89C14.6 5.87988 16 7.27987 16 8.98987Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path class="group-hover:stroke-black duration-500" d="M22 5.10999V16.47C22 17.92 20.96 18.53 19.69 17.83L16 15.77V8.98999C16 7.27999 14.6 5.88 12.89 5.88H8V5.10999C8 3.39999 9.39999 2 11.11 2H18.89C20.6 2 22 3.39999 22 5.10999Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php include('./addArticle.php') ?>
<?php include('./editArticle.php') ?>
<?php include('./deleteArticle.php') ?>

<?php include('../layout/__RIGHTBAR.php') ?>
<?php include('../layout/_FOOTER.php') ?>