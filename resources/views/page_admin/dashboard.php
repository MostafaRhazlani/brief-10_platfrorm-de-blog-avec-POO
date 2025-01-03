<?php
    require_once('../../../isLogged/isOwner.php');
    require_once('../../../connectdb/connectiondb.php');

    $likes = mysqli_query($conn, "SELECT COUNT(*) AS totalLikes FROM likes");
    $totalLikes = mysqli_fetch_assoc($likes);

    $comments = mysqli_query($conn, "SELECT COUNT(*) AS totalComments FROM comments");
    $totalComments = mysqli_fetch_assoc($comments);

    $users = mysqli_query($conn, "SELECT COUNT(*) AS totalUsers FROM users");
    $totalUsers = mysqli_fetch_assoc($users);

    $articles = mysqli_query($conn, "SELECT COUNT(*) AS totalArticles FROM articles");
    $totalArticles = mysqli_fetch_assoc($articles);
    
?>

<?php include('../layout/_HEAD.php') ?>
<?php include('../layout/_SIDEBAR.php') ?>

<div class="p-4 mt-20 sm:grid sm:grid-cols-2 sm:gap-4 md:ml-[70px] lg:grid-cols-4 mb-10 md:mb-0">
    <div class="bg-white shadow-[0px_0px_4px_#c9c9c9] p-4 rounded-lg mb-4 sm:mb-0">
        <div class="flex gap-3 items-center mb-6">
            <span class="w-12 h-12 text-2xl text-white rounded-full bg-red-400 flex items-center justify-center">
                <i class="fa-regular fa-heart"></i>
            </span>
            <p class="text-xl"> Likes</p>
        </div>
            <p class="text-5xl font-bold"><?php echo $totalLikes['totalLikes'] ?></p>
        <div class="mt-4 w-full h-4 rounded-full py-2 px-1 border-2 flex items-center">
            <div class="totalLikes bg-red-600 h-3 rounded-full"></div>
        </div>
    </div>
    <div class="bg-white shadow-[0px_0px_4px_#c9c9c9] p-4 rounded-lg mb-4 sm:mb-0">
        <div class="flex gap-3 items-center mb-6">
            <span class="w-12 h-12 text-2xl text-white rounded-full bg-blue-400 flex items-center justify-center">
                <i class="fa-regular fa-comment"></i>
            </span>
            <p class="text-xl"> Comments</p>
        </div>
            <p class="text-5xl font-bold"><?php echo $totalComments['totalComments'] ?></p>
        <div class="mt-4 w-full h-4 rounded-full py-2 px-1 border-2 flex items-center">
            <div class="totalComments bg-blue-600 h-3 rounded-full"></div>
        </div>
    </div>
    <div class="bg-white shadow-[0px_0px_4px_#c9c9c9] p-4 rounded-lg mb-4 sm:mb-0">
        <div class="flex gap-3 items-center mb-6">
            <span class="w-12 h-12 text-2xl text-white rounded-full bg-teal-400 flex items-center justify-center">
                <i class="fa-solid fa-user-tie"></i>
            </span>
            <p class="text-xl"> Users</p>
        </div>
            <p class="text-5xl font-bold"><?php echo $totalUsers['totalUsers'] ?></p>
        <div class="mt-4 w-full h-4 rounded-full py-2 px-1 border-2 flex items-center">
            <div class="totalUsers bg-teal-600 h-3 rounded-full"></div>
        </div>
    </div>
    <div class="bg-white shadow-[0px_0px_4px_#c9c9c9] p-4 rounded-lg mb-4 sm:mb-0">
        <div class="flex gap-3 items-center mb-6">
            <span class="w-12 h-12 text-2xl text-white rounded-full bg-purple-400 flex items-center justify-center">
                <i class="fa-solid fa-newspaper"></i>
            </span>
            <p class="text-xl"> Articles</p>
        </div>
            <p class="text-5xl font-bold"><?php echo $totalArticles['totalArticles'] ?></p>
        <div class="mt-4 w-full h-4 rounded-full py-2 px-1 border-2 flex items-center">
            <div class="totalArticles bg-purple-600 h-3 rounded-full"></div>
        </div>
    </div>
</div>

<?php include('../layout/_FOOTER.php') ?>

<script>
    const totalLikes = document.querySelector('.totalLikes');
    const totalComments = document.querySelector('.totalComments');
    const totalUsers = document.querySelector('.totalUsers');
    const totalArticles = document.querySelector('.totalArticles');

    const targetElements = {
        totalLikes: <?php echo $totalLikes['totalLikes'] ?>,
        totalComments: <?php echo $totalComments['totalComments'] ?>,
        totalUsers: <?php echo $totalUsers['totalUsers'] ?>,
        totalArticles: <?php echo $totalArticles['totalArticles'] ?>,
    }

    document.addEventListener('DOMContentLoaded', () => {

        // function for animate with total Likes, comments, users, articles
        function animationWith(element, targetElement) {
            const fullWidth = 100;
            let currentWidth = fullWidth;
    
           
            const decrease = setInterval(() => {
                currentWidth--;
                element.style.width = currentWidth + "%";
    
                if (currentWidth == 0) {
                    clearInterval(decrease);
    
                    
                    let increaseWidth = 0;
                    const increase = setInterval(() => {
                        increaseWidth++;
                        element.style.width = currentWidth + "%";
    
                        if (increaseWidth == targetElement) {
                            clearInterval(increase);
                            element.style.width = targetElement + '%';
                        }
                    }, 6);
                }
            }, 6);
        }

        animationWith(totalLikes, targetElements.totalLikes);
        animationWith(totalComments, targetElements.totalComments);
        animationWith(totalUsers, targetElements.totalUsers);
        animationWith(totalArticles, targetElements.totalArticles);
    });

</script>