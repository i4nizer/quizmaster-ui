<nav id="sidenav" class="h-100 position-absolute d-flex flex-column align-items-center" style="width: 100px;">
    <img class="bg-white mt-4 mb-2" style="width: 70px; height: 70px; border-radius: 50%;" src="<?= base_url() ?>public/images/logo.png">
    <span class="text-white"><?= html_escape(get_username(get_user_id())); ?></span>
    <hr class="bg-white w-100 h-1">
    <div class="w-100 p-1 d-flex flex-column gap-3">
        <a class="w-100 rounded text-center fs-1" title="Quizzes" href="/index.php/user/quizzes"><i class="bi bi-journal"></i></a>
        <a class="w-100 rounded text-center fs-1" title="Profile" href="/index.php/user/profile"><i class="bi bi-person"></i></a>
        <a class="w-100 rounded text-center fs-1" title="Logout" href="/index.php/user/logout"><i class="bi bi-box-arrow-right"></i></a>
    </div>
</nav>

<style>

</style>