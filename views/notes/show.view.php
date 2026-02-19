<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-white">
            <p class="mb-4">
                <a href="/notes">Go back...</a>
            </p>
            <p><?= htmlspecialchars($note['body']); ?></p>

            <p class="mt-4">
                <a href="/note/edit?id=<?= $note['id'] ?>" class="text-gray-500 border border-current rounded px-3 py-1">Edit</a>
            </p>

        </div>
    </main>
<?php require base_path("views/partials/footer.php"); ?>