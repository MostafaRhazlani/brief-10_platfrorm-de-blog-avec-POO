<?php
    require_once('../../../connectdb/connectiondb.php');

        //  check if the id exist in url and get it
        $getIdArticle = isset($_GET['idArticle']) ? $_GET['idArticle'] : 0;
        
        if(isset($_GET['idEditComment'])) {
            $idEditComment = $_GET['idEditComment'];
            echo "<script>
                document.addEventListener('DOMContentLoaded', () => {
                    const formEdit = document.querySelector('.formEdit');
                    formEdit.classList.remove('hidden');
                });
            </script>";

            $getComment = mysqli_query($conn, "SELECT id, content FROM comments WHERE id = $idEditComment");
            $resultComment = mysqli_fetch_assoc($getComment);
        }

            
        
        $idComment = isset($_POST['idComment']) ? $_POST['idComment'] : 0;
        if($idComment) {
            $idArticle = $_POST['idArticle'];
            $content = $_POST['content'];
            $updateComment = mysqli_prepare($conn, "UPDATE comments SET content = ? WHERE id = ?");
            mysqli_stmt_bind_param($updateComment, 'si', $content, $idComment);
            if(mysqli_stmt_execute($updateComment)) {
                
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