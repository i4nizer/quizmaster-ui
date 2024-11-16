<header class="p-2 px-5 d-flex justify-content-between bg-white shadow-sm z-1">

    <div class="px-2 gap-4 d-flex justify-content-between">
        <button class="btn btn-primary drawer-toggle"><i class="bi bi-list"></i></button>
        <a class="navbar-brand text-decoration-none text-black" href="<?= site_url(); ?>">QuizMaster</a>
    </div>

    <div class="px-2 gap-2 d-flex justify-content-between">
        <?php if (! logged_in()): ?>
            <a class="nav-link text-secondary" href="<?= site_url('auth/login'); ?>">Login</a>
            <a class="nav-link text-secondary" href="<?= site_url('auth/register'); ?>">Register</a>
        <?php endif; ?>
        <a class="nav-link text-secondary" href="#"><?= html_escape(get_username(get_user_id())); ?></a>
        <a class="nav-link text-secondary" href="<?= site_url('auth/logout'); ?>">Logout</a>
    </div>

</header>