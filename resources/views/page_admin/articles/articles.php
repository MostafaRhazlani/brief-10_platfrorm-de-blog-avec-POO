<?php 
    require_once('../../../../isLogged/isOwner.php');
    require_once('../../../../connectdb/connectiondb.php');

    $getArticles = mysqli_query($conn, "SELECT articles.*, users.username FROM articles INNER JOIN users ON users.id = articles.idUser");
?>

<?php include('../../layout/_HEAD.php') ?>
<?php include('../../layout/_SIDEBAR.php') ?>

<div class="md:pl-20 w-full h-screen pt-32 p-3">
    <div class="mb-3 flex justify-between">
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
                                    while($article = mysqli_fetch_assoc($getArticles)) { ?>
                                    <tr class="border-b-[0.2px] text-start hover:bg-gray-100">
                                        <td class="px-4 py-4"><?php echo $index +=1 ?></td>
                                        <td class="px-4 py-4"><?php echo $article['title'] ?></td>
                                        <td class="px-4 py-4 max-w-20 overflow-hidden truncate"><?php echo $article['content'] ?></td>
                                        <td class="px-4 py-4"><?php echo $article['image'] ?></td>
                                        <td class="px-4 py-4"><?php echo $article['username'] ?></td>
                                        <td class="px-4 py-4 min-w-28">
                                            <a href="./articles.php?idDeleteArticle=<?php echo $article['id'] ?>" class="showFormDelete bg-red-700 rounded-full px-2 py-1 text-white text-[13px] hover:bg-red-500 cursor-pointer">
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

<?php include('./deleteArticle.php') ?>

<?php include('../../layout/_FOOTER.php') ?>