<?php 
    require_once('../../../../isLogged/isOwner.php');
    require_once __DIR__ . '/../../../../controllers/UserController.php';

    $users = new UserController();
    $resultUsers = $users->index();
?>

<?php include('../../layout/_HEAD.php') ?>
<?php include('../../layout/_SIDEBAR.php') ?>

<div class="md:pl-20 w-full h-screen pt-28 p-3">
    <div class="mb-3 flex flex-col md:flex-row">
        <button class=" py-2 px-4 bg-red-600 rounded-md hover:bg-red-500 text-white mb-6 md:mb-0 md:mr-6"><i class="fa-solid fa-arrow-down-a-z"></i> Sort Categories</button>

        
    </div>
    <div class="w-full h-5/6 shadow-[0px_0px_4px_#c9c9c9] rounded-md">
        <div class="p-4 w-full h-full overflow-scroll" style="scrollbar-width: none">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="p-4 text-start">ID</th>
                        <th class="p-4 text-start">Username</th>
                        <th class="p-4 text-start">Email</th>
                        <th class="p-4 text-center">Role</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- display all articles -->
                    <?php if($resultUsers) { ?>
                        <?php $index = 0; 
                            foreach($resultUsers as $user) { ?>
                            <?php if($_SESSION['user']['id'] !== $user['id']) { ?>
                                <tr class="border-b-[0.2px] text-start hover:bg-gray-100">
                                    <td class="px-4 py-4"><?php echo $index +=1 ?></td>
                                    <td class="px-4 py-4"><?php echo $user['username'] ?></td>
                                    <td class="px-4 py-4"><?php echo $user['email'] ?></td>
                                    <td class="px-4 py-4 text-center relative">
                                    <!-- change role -->
                                        <a href="./updateRole.php?idUser=<?php echo $user['id'] ?>" class="<?php echo ($user['role'] == 1) ? 'bg-green-600' : 'bg-blue-600' ?> text-[13px] px-3 rounded-full text-white">
                                        <?php echo ($user['role'] == 1) ? 'Admin' : 'User' ?>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 min-w-32 text-center">
                                        <a href="./users.php?idDeleteUser=<?php echo $user['id'] ?>" class="showFormDelete bg-red-700 rounded-full px-2 text-white text-[13px] mr-2 hover:bg-red-500 cursor-pointer">
                                            <i class="fa-regular fa-trash-can"></i>&nbsp;Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require('./deleteUser.php') ?>

<?php include('../../layout/_FOOTER.php') ?>