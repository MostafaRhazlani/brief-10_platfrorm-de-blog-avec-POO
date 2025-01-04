<?php 
    session_start();
    // require_once('../../../connectdb/connectiondb.php'); 
    
    // $getAllTags = mysqli_query($conn, "SELECT * FROM categories");

    // if(isset($_POST['idTag']) && $_POST['idTag'] != 0) {
    //     $idTag = isset($_POST['idTag']) ? $_POST['idTag'] : 0;
    //     $getArticles = mysqli_query($conn, "SELECT articles.*, users.username, users.email, users.imageProfile FROM tags 
    //                                         INNER JOIN articles ON articles.id = tags.idArticle 
    //                                         INNER JOIN users ON users.id = articles.idUser 
    //                                         WHERE idCategory = $idTag 
    //                                         ORDER BY id DESC");
    // } else {
    //     $getArticles = mysqli_query($conn,"SELECT articles.*, users.username, users.email, users.imageProfile FROM articles 
    //                                        INNER JOIN users ON users.id = articles.idUser 
    //                                        ORDER BY id DESC");
    // }

    
?>

<?php include('../layout/_HEAD.php') ?>
<?php include('../layout/_SIDEBAR.php') ?>


<?php include('../layout/_FOOTER.php') ?>