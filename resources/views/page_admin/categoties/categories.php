<?php 
    require_once('../../../../isLogged/isOwner.php');
    require_once __DIR__ . '/../../../../controllers/CategoryController.php';

    $categories = new CategoryController();

    $getCategories = $categories->index();


?>

<?php include('../../layout/_HEAD.php') ?>
<?php include('../../layout/_SIDEBAR.php') ?>

<div class="md:w-5/6 w-full h-screen pt-28 p-3">
    <div class="mb-3 flex flex-col md:flex-row justify-between">
        <form action="./insertCategory.php" method="post">
            <div class="flex flex-col md:flex-row-reverse mb-5 md:mb-0">
                <input class="border-2 border-red-600 rounded-md py-2 px-4" type="text" placeholder="Enter category" name="nameCategory">
                <button class="py-2 px-4 bg-red-600 rounded-md hover:bg-red-500 text-white md:mr-3 mt-2 md:mt-0"><i class="fa-solid fa-circle-plus"></i> Add Category</button>
            </div>
        </form>
        <button class="py-2 px-4 bg-red-600 rounded-md hover:bg-red-500 text-white"><i class="fa-solid fa-arrow-down-a-z"></i> Sort Categories</button>
    </div>
    <div class="w-full h-5/6 shadow-[0px_0px_4px_#c9c9c9] rounded-md">
        <div class="p-4">
            <div class="w-full overflow-scroll" style="scrollbar-width: none">
                <div class="rounded-md ">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="p-4 text-start">ID</th>
                                <th class="p-4 text-center">Name Category</th>
                                <th class="p-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- display all articles -->
                             <?php if(isset($getCategories)) { ?>
                                <?php $index = 0; 
                                    foreach($getCategories as $category) { ?>
                                    <tr class="border-b-[0.2px] text-start hover:bg-gray-100">
                                        <td class="px-4 py-4"><?php echo $index +=1 ?></td>
                                        <td class="text-center px-4 py-4"><?php echo $category['nameCategory'] ?></td>
                                        <td class="px-4 py-4 min-w-96 flex items-center justify-center">
                                            <a href="./categories.php?idDeleteCategory=<?php echo $category['id'] ?>" class="bg-red-700 rounded-full px-2 py-1 text-white text-[13px] mr-2 hover:bg-red-500 cursor-pointer">
                                                <i class="fa-regular fa-trash-can"></i>&nbsp;Delete
                                            </a>
                                            <form class="flex items-center flex-row-reverse" action="./updateCategory.php" method="post">
                                                
                                                <input type="hidden" name="idCategory" value="<?php echo $category['id'] ?>">
                                                <input class="bg-gray-200 py-1 px-2 ml-2 rounded-md outline-none focus:bg-gray-400" value="<?php echo $category['nameCategory'] ?>" type="text" name="nameCategory" placeholder="Change name category">
                                                
                                                <button type="submit" class="bg-[#301f41] rounded-full px-3 py-1 text-white text-[13px] hover:bg-[#462468] cursor-pointer">
                                                    <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit
                                                </button>
                                            </form>
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

<?php include('./deleteCategory.php') ?>

<?php include('../../layout/_FOOTER.php') ?>