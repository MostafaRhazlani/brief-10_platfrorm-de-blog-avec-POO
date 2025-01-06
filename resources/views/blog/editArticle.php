<!-- form edit article -->
<?php 
    require_once __DIR__ . '/../../../controllers/ArticleController.php';
    require_once __DIR__ . '/../../../controllers/TagController.php';
    require_once __DIR__ . '/../../../controllers/UserController.php';

    if(isset($_GET['idArticle'])) {
        $idArticle = isset($_GET['idArticle']) ? $_GET['idArticle'] : 0;
        echo "<script>
            document.addEventListener('DOMContentLoaded', () => {
                const formEditArticle = document.querySelector('.formEditArticle');
                formEditArticle.classList.remove('hidden');
            });
        </script>";

        $currentUser = $_SESSION['user']['id'];
        $user = new UserController($currentUser);
        $getUser = $user->getUser();

        $article = new ArticleController($idArticle);
        $resultArticle = $article->getArticle();

        $tags = new TagController();
        $getTags = $tags->index();
    }

?>

<div class="formEditArticle w-full h-full fixed top-0 z-30 bg-slate-200 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white p-4 rounded-lg w-5/6 md:w-3/5 lg:w-2/6 relative">
        
        <span class="closeForm absolute right-4 top-3 text-3xl text-gray-500 cursor-pointer hover:text-red-600">
            <i class="fa-regular fa-circle-xmark"></i>
        </span>
        <h1 class="text-center font-semibold text-xl mb-3">Edit article</h1>

        <div class="flex mb-4 border-t-2 py-3">
            <img class="mr-3 object-cover w-10 h-10 rounded-full" src="../../img/images/<?php echo $getUser['imageProfile'] ?>" alt="">
            
            <div>
                <p class="text-sm"><?php echo $getUser['username'] ?></p>
                <p class="text-gray-500 text-[12px]"><?php echo $getUser['email'] ?></p>
            </div>
        </div>

        <form action="./updateArticle.php" method="post" enctype="multipart/form-data">
            <div class="w-full">
                <?php if($resultArticle) { ?>
                    <div class="flex flex-col mb-4">
                        <input type="hidden" name="idArticle" value="<?php echo $resultArticle['id'] ?>">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="<?php echo $resultArticle['title'] ?>" placeholder="Enter title here" class="w-full p-1 mt-1 rounded-md border-2 border-red-600">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="content">Content</label>
                        <textarea class="w-full min-h-20 max-h-20 p-2 mt-1 rounded-md border-2 border-red-600" name="content" id="content" placeholder="add content here"><?php echo $resultArticle['content'] ?></textarea>
                    </div>

                    <div class="inputTags hidden flex flex-col mb-4">
                        <label for="">Choose Tag</label>
                        <select name="idCategory[]" multiple class="w-full p-2 mt-1 rounded-md border-2 border-red-600" id="">
                            <?php if(isset($getTags)) { ?>
                                <?php foreach($getTags as $tag) { ?>
                                    <option value="<?php echo $tag['id'] ?>"><?php echo $tag['nameTag'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="inputImage hidden">
                        <label for="">Upload image</label>
                        <input name="image" type="file" class="w-full p-1 mt-1 rounded-md border-2 border-red-600">
                    </div>
        
                    <div class="flex justify-between items-center border-2 rounded-md mt-4 py-2 px-4">
                        <h2>Add to your article</h2>
                        <div>
                            <span class="showInputTags text-3xl text-gray-400 hover:text-[#200E32] cursor-pointer">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>&nbsp;
                            <span class="showInputImage text-3xl text-gray-400 hover:text-[#200E32] cursor-pointer"><i class="fa-solid fa-file-image"></i></span>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="w-full">
                <button class="p-2 w-full bg-red-600 rounded-md text-white mt-6 hover:bg-red-500" type="submit">Update article</button>
            </div>
        </form>
    </div>
</div>