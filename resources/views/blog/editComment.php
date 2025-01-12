<?php
    require_once __DIR__ . '/../../../controllers/CommentController.php';

        //  check if the id exist in url and get it
        if(isset($_GET['idArticle'])) {
            $getIdArticle = $_GET['idArticle'];

            if(isset($_GET['idEditComment'])) {
                $idEditComment = $_GET['idEditComment'];
                echo "<script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const formEdit = document.querySelector('.formEdit');
                        formEdit.classList.remove('hidden');
                    });
                </script>";
    
                $getComment = new CommentController($idEditComment);
                $resultComment = $getComment->getComment();
            }
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idComment = $_POST['idComment'];
            $idArticle = $_POST['idArticle'];
            $content = $_POST['content'];

            $updateComment = new CommentController($idComment, $content);
            if($updateComment->update()) {
                header("location: detailsArticle.php?idArticle=$idArticle");
            }
        }

?>

<div class="formEdit hidden w-full h-screen fixed top-0 z-30 bg-gray-500 bg-opacity-75 flex justify-center items-center">
    <div class="w-4/5 md:1/5 lg:w-1/4 bg-white p-5 top-20 rounded-md text-center">
    
        <h1 class="text-2xl font-semibold text-center mb-4">Edit Comment</h1>
        
        <form action="./editComment.php" method="post">
            
            <input type="hidden" name="idComment" value="<?php echo $resultComment['id'] ?>">
            <input type="hidden" name="idArticle" value="<?php echo $getIdArticle ?>">
            <textarea name="content" class="outline-none w-full p-2 hideScrollbar bg-gray-300 rounded-md" style="resize: none"><?php echo $resultComment['content'] ?></textarea>
            <div class="mt-10 flex justify-evenly">
                <button id="closeEdit" type="button" class="px-3 py-2 w-2/6 bg-red-600 text-white rounded-md hover:bg-red-400">Cancel</button>
                <button class="px-3 py-2 w-2/6 bg-blue-600 text-white rounded-md hover:bg-blue-400" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>


<script>
    const closeEdit = document.querySelector('#closeEdit');
    
    closeEdit.addEventListener('click', () => {
        window.location.href = "detailsArticle.php?idArticle=<?php echo $getIdArticle ?>";
    });

</script>