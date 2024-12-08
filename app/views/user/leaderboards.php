<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

    <main class="py-5 h-100" style="margin-left: 100px;">
        <div class="content px-5 h-100">
            <div class="row gy-3 top-player-list">

                <!-- Top 100 Players with Highest Total Quiz Score -->
                <div class="col-12 p-5 border rounded bg-white">
                    <h1 class="text-center my-4 fw-bold">Top Players - Highest Quiz Score</h1>

                    <!-- Players List -->
                    <?php foreach ($top_players as $index => $player): ?>
                        <?php 
                            $numStyle = $index == 0 ? "bg-success p-5 fs-1" : ($index == 1 ? "bg-warning p-4 fs-2" : ($index == 2 ? "bg-danger p-3 fs-3" : "bg-secondary p-2 fs-4"));
                            $nameStyle = $index == 0 ? "fs-1" : ($index == 1 ? "fs-2" : ($index == 2 ? "fs-3" : "fs-4"));
                        ?>
                        <div class="top-player d-flex justify-content-between align-items-center p-2 my-2 bg-light">
                            <span class="badge <?= $numStyle ?>"><?= $index + 1 ?></span>
                            <span class="fw-bold <?= $nameStyle ?> mx-5"><?= html_escape($player['username']) ?></span>
                            <span class="fw-bold <?= $nameStyle ?> mx-5">Score: <?= $player['total_score'] ?></span>
                        </div>
                    <?php endforeach ?>
                </div>

            </div>
        </div>
    </main>

    <script type="module">
        import { activateLink } from "/public/js/sidenav.js"
        activateLink('Leaderboards')
    </script>


</body>

</html>