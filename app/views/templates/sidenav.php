<nav id="sidenav" class="position-fixed top-0 start-0 d-flex flex-column align-items-center" style="width: 100px; height: 100dvh; background-color: #262626;">
    <img class="bg-white mt-4 mb-2" style="width: 70px; height: 70px; border-radius: 50%;" src="<?= base_url() ?>public/images/logo.png">
    <span class="text-white username"><?= html_escape(get_username(get_user_id())); ?></span>
    <hr class="bg-white w-100 h-1">
    <div class="w-100 p-1 d-flex flex-column gap-3">
        <a class="w-100 rounded text-center fs-1 Quizzes" title="Quizzes" href="/user/quizzes"><i class="bi bi-house"></i></a>
        <a class="w-100 rounded text-center fs-1 Recent" title="Recent" href="/user/recent"><i class="bi bi-clock-history"></i></a>
        <a class="w-100 rounded text-center fs-1 Leaderboards" title="Leaderboards" href="/user/leaderboards"><i class="bi bi-trophy"></i></a>
        <a class="w-100 rounded text-center fs-1 Profile" title="Profile" href="/user/profile"><i class="bi bi-person"></i></a>
        <a class="w-100 rounded text-center fs-1 Logout" title="Logout" href="/auth/logout"><i class="bi bi-box-arrow-right"></i></a>
    </div>
</nav>