<?php
    require_once __DIR__ . "/../../../controllers/CRUDController.php";
    $page = $_SERVER['PHP_SELF'];

    $user = new CRUDContoller("users", "id", "role", 1);

    $getAdmin = $user->conditionSelect();
    

?>

<div class="w-full h-screen md:p-0 md:w-1/6 fixed md:static bottom-0 md:top-0 z-10">
    <div class="md:pt-24 pb-2 h-full flex flex-col gap-4">
        <div class="text-white lg:flex lg:flex-col lg:items-center hidden">
            <div class="border-[3px] border-[#FFD37D] overflow-hidden w-20 h-20 rounded-full p-[3px]">
                <img class="object-cover" src="../../img/images/default.png" alt="">
            </div>
            <div class="text-center">
                <h2 class="text-2xl">Mostafa</h2>
                <span class="text-sm text-gray-400">mostafa@gmmil.com</span>
            </div>
            <div class="bg-[#202225] w-full flex justify-between p-4 rounded-lg mt-4 text-center">
                <div>
                    <h3>4.6k</h3>
                    <p class="text-sm text-gray-400">Followers</p>
                </div>
                <div>
                    <h3>4.6k</h3>
                    <p class="text-sm text-gray-400">Following</p>
                </div>
                <div>
                    <h3>20</h3>
                    <p class="text-sm text-gray-400">Articles</p>
                </div>
            </div>
        </div>
        <ul class="h-4/6 flex p-4 gap-5 md:gap-3 bg-[#202225] lg:rounded-lg justify-between md:flex-col md:justify-start md:items-center lg:items-start">
            <li class="w-full hover:bg-[#FFD37D] text-white <?php if($page == '/resources/views/blog/blog.php' || $page == '/resources/views/blog/detailsArticle.php') echo 'bg-[#FFD37D]' ?> rounded-md">
                <a href="/resources/views/blog/blog.php" class="lg:flex lg:items-center lg:gap-1 group hover:text-black p-2 <?php if($page == '/resources/views/blog/blog.php' || $page == '/resources/views/blog/detailsArticle.php') echo 'text-black' ?>">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="group-hover:stroke-black <?php if($page == '/resources/views/blog/blog.php' || $page == '/resources/views/blog/detailsArticle.php') echo 'stroke-black' ?>" d="M9 21V13.6C9 13.0399 9 12.7599 9.109 12.546C9.20487 12.3578 9.35785 12.2049 9.54601 12.109C9.75993 12 10.04 12 10.6 12H13.4C13.9601 12 14.2401 12 14.454 12.109C14.6422 12.2049 14.7951 12.3578 14.891 12.546C15 12.7599 15 13.0399 15 13.6V21M2 9.5L11.04 2.72C11.3843 2.46181 11.5564 2.33271 11.7454 2.28294C11.9123 2.23902 12.0877 2.23902 12.2546 2.28295C12.4436 2.33271 12.6157 2.46181 12.96 2.72L22 9.5M4 8V17.8C4 18.9201 4 19.4802 4.21799 19.908C4.40974 20.2843 4.7157 20.5903 5.09202 20.782C5.51985 21 6.0799 21 7.2 21H16.8C17.9201 21 18.4802 21 18.908 20.782C19.2843 20.5903 19.5903 20.2843 19.782 19.908C20 19.4802 20 18.9201 20 17.8V8L13.92 3.44C13.2315 2.92361 12.8872 2.66542 12.5091 2.56589C12.1754 2.47804 11.8246 2.47804 11.4909 2.56589C11.1128 2.66542 10.7685 2.92361 10.08 3.44L4 8Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Blog
                </a>
            </li>
    
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 1) { ?>
                <li class="w-full hover:bg-[#FFD37D] text-white <?php if($page == '/resources/views/page_admin/articles/articles.php') echo 'bg-[#FFD37D]' ?> rounded-md">
                    <a href="/resources/views/page_admin/articles/articles.php" class="lg:flex lg:items-center lg:gap-1 group p-2 hover:text-black <?php if($page == '/resources/views/page_admin/articles/articles.php') echo 'text-black' ?>">
                        <svg class="group w-6 h-6" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>list_check_3_fill</title>
                            <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Editor" transform="translate(-48.000000, -240.000000)" fill-rule="nonzero">
                                    <g id="list_check_3_fill" transform="translate(48.000000, 240.000000)">
                                        <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"></path>
                                        <path class="group-hover:fill-black <?php if($page == '/resources/views/page_admin/articles/articles.php') echo 'fill-black' ?>" d="M7,13 C8.05436227,13 8.91816517,13.81585 8.99451427,14.8507339 L9,15 L9,18 C9,19.0543909 8.18412267,19.9181678 7.14926241,19.9945144 L7,20 L4,20 C2.94563773,20 2.08183483,19.18415 2.00548573,18.1492661 L2,18 L2,15 C2,13.9456091 2.81587733,13.0818322 3.85073759,13.0054856 L4,13 L7,13 Z M16,17 C16.5523,17 17,17.4477 17,18 C17,18.51285 16.613973,18.9355092 16.1166239,18.9932725 L16,19 L12,19 C11.4477,19 11,18.5523 11,18 C11,17.48715 11.386027,17.0644908 11.8833761,17.0067275 L12,17 L16,17 Z M20,13 C20.5523,13 21,13.4477 21,14 C21,14.5523 20.5523,15 20,15 L12,15 C11.4477,15 11,14.5523 11,14 C11,13.4477 11.4477,13 12,13 L20,13 Z M7,3 C8.10457,3 9,3.89543 9,5 L9,8 C9,9.10457 8.10457,10 7,10 L4,10 C2.89543,10 2,9.10457 2,8 L2,5 C2,3.89543 2.89543,3 4,3 L7,3 Z M16,7 C16.5523,7 17,7.44772 17,8 C17,8.51283143 16.613973,8.93550653 16.1166239,8.9932722 L16,9 L12,9 C11.4477,9 11,8.55228 11,8 C11,7.48716857 11.386027,7.06449347 11.8833761,7.0067278 L12,7 L16,7 Z M20,3 C20.5523,3 21,3.44772 21,4 C21,4.51283143 20.613973,4.93550653 20.1166239,4.9932722 L20,5 L12,5 C11.4477,5 11,4.55228 11,4 C11,3.48716857 11.386027,3.06449347 11.8833761,3.0067278 L12,3 L20,3 Z" id="形状" fill="#FFFFFF"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        Articles
                    </a>
                </li>
                <li class="w-full hover:bg-[#FFD37D] text-white <?php if($page == '/resources/views/page_admin/categoties/categories.php') echo 'bg-[#FFD37D]' ?> rounded-md">
                    <a href="/resources/views/page_admin/categoties/categories.php" class=" hover:text-black lg:flex lg:items-center lg:gap-1 p-2 group <?php if($page == '/resources/views/page_admin/categoties/categories.php') echo 'text-black' ?>">
                        <svg width="23px" height="23px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="group-hover:stroke-black <?php if($page == '/resources/views/page_admin/categoties/categories.php') echo 'stroke-black' ?>" d="M5 10H7C9 10 10 9 10 7V5C10 3 9 2 7 2H5C3 2 2 3 2 5V7C2 9 3 10 5 10Z" stroke="#FFFFFF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="group-hover:stroke-black <?php if($page == '/resources/views/page_admin/categoties/categories.php') echo 'stroke-black' ?>" d="M17 10H19C21 10 22 9 22 7V5C22 3 21 2 19 2H17C15 2 14 3 14 5V7C14 9 15 10 17 10Z" stroke="#FFFFFF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="group-hover:stroke-black <?php if($page == '/resources/views/page_admin/categoties/categories.php') echo 'stroke-black' ?>" d="M17 22H19C21 22 22 21 22 19V17C22 15 21 14 19 14H17C15 14 14 15 14 17V19C14 21 15 22 17 22Z" stroke="#FFFFFF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="group-hover:stroke-black <?php if($page == '/resources/views/page_admin/categoties/categories.php') echo 'stroke-black' ?>" d="M5 22H7C9 22 10 21 10 19V17C10 15 9 14 7 14H5C3 14 2 15 2 17V19C2 21 3 22 5 22Z" stroke="#FFFFFF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Categories
                    </a>
                </li>
                <li class="w-full hover:bg-[#FFD37D] text-white <?php if($page == '/resources/views/page_admin/tags/tags.php') echo 'bg-[#FFD37D]' ?> rounded-md">
                    <a href="/resources/views/page_admin/tags/tags.php" class=" hover:text-black lg:flex lg:items-center p-2 lg:gap-1 group <?php if($page == '/resources/views/page_admin/tags/tags.php') echo 'text-black' ?>">
                        <svg fill="#FFFFFF" class="group-hover:fill-black <?php if($page == '/resources/views/page_admin/tags/tags.php') echo 'fill-black' ?>" width="25px" height="25px" viewBox="0 0 24 24" version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M21.422 9.594l-6.465-6.535c-1.329-1.33-3.087-2.059-4.957-2.059s-3.628.729-4.95 2.051c-1.416 1.414-2.127 3.356-2.027 5.314-.662 1.085-1.023 2.33-1.023 3.634 0 1.87.729 3.628 2.051 4.95l3.053 2.984 3.482 3.48c.391.392.902.587 1.414.587s1.023-.195 1.414-.586l7-7c.778-.778.782-2.038.008-2.82l-.093-.094 1.085-1.086c.778-.778.782-2.038.008-2.82zm-9.422 12.406l-3.498-3.497-3.037-2.968c-1.953-1.953-1.953-5.119 0-7.07.976-.977 2.256-1.465 3.535-1.465s2.559.488 3.535 1.465l6.465 6.535-7 7zm1.957-14.941c-1.329-1.33-3.087-2.059-4.957-2.059-1.276 0-2.497.347-3.565.982.241-.55.579-1.067 1.03-1.518.976-.976 2.256-1.464 3.535-1.464s2.559.488 3.535 1.465l6.465 6.535-1.078 1.078-4.965-5.019zM9 10.499c.83 0 1.5.672 1.5 1.501 0 .83-.67 1.499-1.5 1.499s-1.5-.669-1.5-1.499c0-.829.67-1.501 1.5-1.501m0-1c-1.378 0-2.5 1.122-2.5 2.501 0 1.378 1.122 2.499 2.5 2.499s2.5-1.121 2.5-2.499c0-1.379-1.122-2.501-2.5-2.501z"/>
                            </g>
                        </svg>
                        Tags
                    </a>
                </li>
                <li class="w-full hover:bg-[#FFD37D] text-white <?php if($page == '/resources/views/page_admin/users/users.php') echo 'bg-[#FFD37D]' ?> rounded-md">
                    <a href="/resources/views/page_admin/users/users.php" class="hover:text-black lg:flex lg:items-center p-2 lg:gap-1 group <?php if($page == '/resources/views/page_admin/users/users.php') echo 'text-black' ?>">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 hover:fill-[#200E32]" height="24px" viewBox="0 -960 960 960" width="24px" fill="#aba6a6"><path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z"/></svg> -->
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="group-hover:stroke-black <?php if($page == '/resources/views/page_admin/users/users.php') echo 'stroke-black' ?>" d="M17.9998 15.8369C19.4557 16.5683 20.704 17.742 21.6151 19.2096C21.7955 19.5003 21.8857 19.6456 21.9169 19.8468C21.9803 20.2558 21.7006 20.7585 21.3198 20.9204C21.1323 21 20.9215 21 20.4998 21M15.9998 11.5322C17.4816 10.7959 18.4998 9.26686 18.4998 7.5C18.4998 5.73314 17.4816 4.20411 15.9998 3.46776M13.9998 7.5C13.9998 9.98528 11.9851 12 9.49984 12C7.01455 12 4.99984 9.98528 4.99984 7.5C4.99984 5.01472 7.01455 3 9.49984 3C11.9851 3 13.9998 5.01472 13.9998 7.5ZM2.55907 18.9383C4.15337 16.5446 6.66921 15 9.49984 15C12.3305 15 14.8463 16.5446 16.4406 18.9383C16.7899 19.4628 16.9645 19.725 16.9444 20.0599C16.9287 20.3207 16.7578 20.64 16.5494 20.7976C16.2818 21 15.9137 21 15.1775 21H3.82219C3.08601 21 2.71791 21 2.45028 20.7976C2.24189 20.64 2.07092 20.3207 2.05527 20.0599C2.03517 19.725 2.2098 19.4628 2.55907 18.9383Z" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Users
                    </a>
                </li>
                <li class="w-full hover:bg-[#FFD37D] text-white <?php if($page == '/resources/views/page_admin/dashboard.php') echo 'bg-[#FFD37D]' ?> rounded-md">
                    <a href="/resources/views/page_admin/dashboard.php" class="hover:text-black lg:flex lg:items-center p-2 lg:gap-1 group <?php if($page == '/resources/views/page_admin/dashboard.php') echo 'text-black' ?> ">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" id="dashboard_layout_screen" data-name="dashboard layout screen" xmlns="http://www.w3.org/2000/svg">
                            <rect id="Mask" width="24" height="24" fill="none"/>
                            <g id="Group_2" data-name="Group 2" transform="translate(4 4)">
                                <rect id="Rectangle_15" data-name="Rectangle 15" width="6" height="9" rx="1" transform="translate(0 0)" fill="none" stroke="#FFFFFF" class="group-hover:stroke-black <?php if($page == '/resources/views/page_admin/dashboard.php') echo 'stroke-black' ?>" stroke-miterlimit="10" stroke-width="1.5"/>
                                <rect id="Rectangle_15-2" data-name="Rectangle 15" width="16" height="4" rx="1" transform="translate(0 12)" fill="none" stroke="#FFFFFF" class="group-hover:stroke-black <?php if($page == '/resources/views/page_admin/dashboard.php') echo 'stroke-black' ?>" stroke-miterlimit="10" stroke-width="1.5"/>
                                <rect id="Rectangle_15-3" data-name="Rectangle 15" width="7" height="9" rx="1" transform="translate(9 0)" fill="none" stroke="#FFFFFF" class="group-hover:stroke-black <?php if($page == '/resources/views/page_admin/dashboard.php') echo 'stroke-black' ?>" stroke-miterlimit="10" stroke-width="1.5"/>
                            </g>
                        </svg>
                        Dashboard
                    </a>
                </li>
            <?php } else { ?>
                <li class="w-full hover:bg-[#FFD37D] hover:text-black <?php if($page == '/resources/views/videos/videos.php') echo 'text-[#202225] bg-[#FFD37D]' ?> rounded-md">
                    <a href="#" class="text-gray-300 hover:text-black lg:flex lg:items-center lg:gap-1 group p-2">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="group-hover:stroke-black" d="M19.5617 7C19.7904 5.69523 18.7863 4.5 17.4617 4.5H6.53788C5.21323 4.5 4.20922 5.69523 4.43784 7" stroke="#FFFFFF" stroke-width="1.8"/>
                            <path class="group-hover:stroke-black" d="M17.4999 4.5C17.5283 4.24092 17.5425 4.11135 17.5427 4.00435C17.545 2.98072 16.7739 2.12064 15.7561 2.01142C15.6497 2 15.5194 2 15.2588 2H8.74099C8.48035 2 8.35002 2 8.24362 2.01142C7.22584 2.12064 6.45481 2.98072 6.45704 4.00434C6.45727 4.11135 6.47146 4.2409 6.49983 4.5" stroke="#FFFFFF" stroke-width="1.8"/>
                            <path class="group-hover:stroke-black" d="M14.5812 13.6159C15.1396 13.9621 15.1396 14.8582 14.5812 15.2044L11.2096 17.2945C10.6669 17.6309 10 17.1931 10 16.5003L10 12.32C10 11.6273 10.6669 11.1894 11.2096 11.5258L14.5812 13.6159Z" stroke="#FFFFFF" stroke-width="1.8"/>
                            <path class="group-hover:stroke-black" d="M2.38351 13.793C1.93748 10.6294 1.71447 9.04765 2.66232 8.02383C3.61017 7 5.29758 7 8.67239 7H15.3276C18.7024 7 20.3898 7 21.3377 8.02383C22.2855 9.04765 22.0625 10.6294 21.6165 13.793L21.1935 16.793C20.8437 19.2739 20.6689 20.5143 19.7717 21.2572C18.8745 22 17.5512 22 14.9046 22H9.09536C6.44881 22 5.12553 22 4.22834 21.2572C3.33115 20.5143 3.15626 19.2739 2.80648 16.793L2.38351 13.793Z" stroke="#FFFFFF" stroke-width="1.8"/>
                        </svg>
                        Videos
                    </a>
                </li>


                <li class="md:hidden">
                    <a href="#" class="text-gray-500">
                        <img class="bg-red-600 rounded-full p-2 hover:bg-red-500" width="40" src="../../img/search.svg" alt="">
                    </a>
                </li>
                <li class="w-full hover:bg-[#FFD37D] <?php if($page == '/resources/views/chat/chat.php') echo 'text-[#202225] bg-[#FFD37D]' ?> rounded-md">
                    <a href="#" class= "hover:text-black text-white lg:flex lg:items-center group lg:gap-1 p-2 <?php if($page == '/resources/views/chat/chat.php') echo 'text-[#202225]' ?>">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="group-hover:stroke-black" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22Z" stroke="#FFFFFF" stroke-width="1.5"/>
                        <path class="group-hover:stroke-black" d="M8 10.5H16" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                        <path class="group-hover:stroke-black" d="M8 14H13.5" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Chat
                    </a>
                </li>
                <li class="w-full hover:bg-[#FFD37D] hover:text-black <?php if($page == '/resources/views/profile/profile.php') echo 'text-[#202225] bg-[#FFD37D]' ?> rounded-md">
                    <a href="#" class="lg:flex lg:items-center lg:gap-1 group p-2 hover:text-black text-white<?php if($page == '/resources/views/profile/profile.php') echo 'text-[#202225]' ?>">
                        <svg width="25px" height="25px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#FFFFFF" class="group-hover:fill-black" d="M16,16A7,7,0,1,0,9,9,7,7,0,0,0,16,16ZM16,4a5,5,0,1,1-5,5A5,5,0,0,1,16,4Z"/>
                            <path fill="#FFFFFF" class="group-hover:fill-black" d="M17,18H15A11,11,0,0,0,4,29a1,1,0,0,0,1,1H27a1,1,0,0,0,1-1A11,11,0,0,0,17,18ZM6.06,28A9,9,0,0,1,15,20h2a9,9,0,0,1,8.94,8Z"/>
                        </svg>
                        Profile
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>