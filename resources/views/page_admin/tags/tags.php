<?php 
    require_once('../../../../isLogged/isOwner.php');
    require __DIR__ . '/../../../../controllers/TagController.php';

    $tags = new TagController();
    $getTags = $tags->index();
?>

<?php include('../../layout/_HEAD.php') ?>
<?php include('../../layout/_SIDEBAR.php') ?>

<div class="md:pl-20 w-full h-screen pt-28 p-3">
    <div class="mb-3 flex flex-col md:flex-row justify-between">
        <button class="showFormTag py-2 px-4 bg-red-600 rounded-md hover:bg-red-500 text-white md:mr-3 mt-2 md:mt-0"><i class="fa-solid fa-circle-plus"></i> Add Tag</button>
        <button class="py-2 px-4 bg-red-600 rounded-md hover:bg-red-500 text-white"><i class="fa-solid fa-arrow-down-a-z"></i> Sort Tags</button>
    </div>
    <div class="w-full h-5/6 shadow-[0px_0px_4px_#c9c9c9] rounded-md">
        <div class="p-4">
            <div class="w-full overflow-scroll" style="scrollbar-width: none">
                <div class="rounded-md ">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="p-4 text-start">ID</th>
                                <th class="p-4 text-center">Name Tag</th>
                                <th class="p-4 text-center">Name Category</th>
                                <th class="p-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- display all articles -->
                             <?php if(isset($getTags)) { ?>
                                <?php $index = 0; 
                                    foreach($getTags as $tag) { ?>
                                    <tr class="border-b-[0.2px] text-start hover:bg-gray-100">
                                        <td class="px-4 py-4"><?php echo $index +=1 ?></td>
                                        <td class="text-center px-4 py-4"><?php echo $tag['nameTag'] ?></td>
                                        <td class="text-center px-4 py-4"><?php echo $tag['nameCategory'] ?></td>
                                        <td class="px-4 py-4 min-w-96 flex items-center justify-center">
                                            <a href="./tags.php?idEditTag=<?php echo $tag['id'] ?>" class="bg-[#301f41] rounded-full px-3 py-1 text-white text-[13px] hover:bg-[#462468] cursor-pointer">
                                                <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit
                                            </a>
                                            <a href="./tags.php?idDeleteTag=<?php echo $tag['id'] ?>" class="bg-red-700 rounded-full px-2 py-1 text-white text-[13px] ml-2 hover:bg-red-500 cursor-pointer">
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
<?php include('./addTag.php') ?>
<?php include('./editTag.php') ?>

<script>
    const closeFormTag = document.querySelectorAll('.closeFormTag');
    closeFormTag.forEach(close => {
        close.addEventListener('click', () => {
            window.location.href = "tags.php";
            
        })
    })
</script>

<?php include('../../layout/_FOOTER.php') ?>
