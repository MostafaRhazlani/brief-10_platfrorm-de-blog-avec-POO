<?php
    require_once('../../../../isLogged/isOwner.php');
    require_once __DIR__ . '/../../../../controllers/TagController.php';
    require_once __DIR__ . '/../../../../controllers/CategoryController.php';

    if(isset($_GET['idEditTag'])) {
        $idTag = $_GET['idEditTag'];

        echo "<script>
            document.addEventListener('DOMContentLoaded', () => {
                const formEditTag = document.querySelector('.formEditTag');
                formEditTag.classList.remove('hidden');
            });
        </script>";

        $tag = new TagController($idTag);
        $resultTag = $tag->getTag();

        $categories = new CategoryController();
        $resultCategories = $categories->index();
    }

?>

<!-- form create tag -->
<div class="formEditTag w-full h-full fixed top-0 z-30 bg-slate-200 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white p-4 rounded-lg w-5/6 md:w-3/5 lg:w-2/6 relative">
        
        <span class="closeFormTag absolute right-4 top-3 text-3xl text-gray-500 cursor-pointer hover:text-red-600">
            <i class="fa-regular fa-circle-xmark"></i>
        </span>
        <h1 class="text-center font-semibold text-xl mb-3">Edit tag</h1>

        <form action="./updateTag.php" method="post">
            <div class="w-full">
                <div class="flex flex-col mb-4">
                    <label for="nameTag">Name Tag</label>
                    <input type="hidden" name="idTag" value="<?php echo $resultTag['id'] ?>">
                    <input type="text" id="nameTag" name="nameTag" value="<?php echo $resultTag['nameTag'] ?>" placeholder="change name tag" class="w-full p-1 mt-1 rounded-md border-2 border-red-600">
                </div>

                <div class="inputTags flex flex-col mb-4">
                    <label for="">Choose Category</label>
                    <select name="idCategory" class="w-full p-2 mt-1 rounded-md border-2 border-red-600" id="">
                        <?php if(isset($resultCategories)) { ?>
                            <?php foreach($resultCategories as $category) { ?>
                                <option value="<?php echo $category['id'] ?>" <?php if($category['id'] === $resultTag['idCategory']) echo 'selected' ?>><?php echo $category['nameCategory'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="w-full">
                <button class="p-2 w-full bg-red-600 rounded-md text-white mt-6 hover:bg-red-500" type="submit">Edit tag</button>
            </div>
        </form>
    </div>
</div>