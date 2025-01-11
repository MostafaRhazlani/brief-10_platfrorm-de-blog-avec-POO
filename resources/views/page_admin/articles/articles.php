<?php 
    require_once('../../../../isLogged/isOwner.php');
    require_once __DIR__ . '/../../../../controllers/ArticleController.php';

    $articles = new ArticleController();
    
    $getArticles = $articles->index();
?>

<?php include('../../layout/_HEAD.php') ?>
<?php include('../../layout/_SIDEBAR.php') ?>

<div class="md:w-5/6 w-full h-screen pt-32 p-3">
    <div class="mb-3 flex flex-col md:flex-row justify-between">
        <button class="showFormArticle py-2 px-4 bg-red-600 rounded-md hover:bg-red-500 text-white md:mr-3 mt-2 md:mt-0"><i class="fa-solid fa-circle-plus"></i> Add Article</button>
        <button class="py-2 px-4 bg-red-600 rounded-md hover:bg-red-500 text-white"><i class="fa-solid fa-arrow-down-a-z"></i> Sort Articles</button>
    </div>
    <div class="w-full h-5/6 shadow-[0px_0px_4px_#c9c9c9] rounded-md">
        <div class="p-4">
            <div class="w-full overflow-scroll" style="scrollbar-width: none">
                <div class="rounded-md ">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="p-4 text-start">ID</th>
                                <th class="p-4 text-start">Title</th>
                                <th class="p-4 text-start">Content</th>
                                <th class="p-4 text-start">Image</th>
                                <th class="p-4 text-start">Username</th>
                                <th class="p-4 text-start">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- display all articles -->
                             <?php if($getArticles) { ?>
                                <?php $index = 0; 
                                    foreach($getArticles as $article) { ?>
                                    <tr class="border-b-[0.2px] text-start hover:bg-gray-100">
                                        <td class="px-4 py-4"><?php echo $index +=1 ?></td>
                                        <td class="px-4 py-4"><?php echo $article['title'] ?></td>
                                        <td class="px-4 py-4 max-w-20 overflow-hidden truncate"><?php echo $article['content'] ?></td>
                                        <td class="px-4 py-4"><?php echo $article['image'] ?></td>
                                        <td class="px-4 py-4"><?php echo $article['username'] ?></td>
                                        <td class="px-4 py-4 min-w-28">
                                            <a href="./articles.php?idDeleteArticle=<?php echo $article['id'] ?>" class="showFormDelete bg-red-700 rounded-full px-2 text-white text-[13px] hover:bg-red-500 cursor-pointer">
                                                <i class="fa-regular fa-trash-can"></i>&nbsp;Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./addArticle.php') ?>
<?php include('./deleteArticle.php') ?>

<?php include('../../layout/_FOOTER.php') ?>

<script>
    const closeForm = document.querySelectorAll('.close');
    closeForm.forEach(close => {
    close.addEventListener('click', () => {
        window.location.href = "articles.php";
        
    })
})
</script>