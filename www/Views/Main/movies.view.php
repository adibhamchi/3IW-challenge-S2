<?php include __DIR__ . "/../header.view.php"?>

<div class="container px-6 py-10 mx-auto ">

    <h1 class="text-center font-bold text-white">Tous les films</h1>

    <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 sm:grid-cols-2 xl:grid-cols-4 lg:grid-cols-3">

        <?php foreach ($films as $film): ?>
            <div class="w-full">
                <a href="/film-review?id=<?= $film->getId() ?>">
                    <div class="w-full h-64 rounded-lg flex">
                        <img src="../../public/assets/img/films/<?= $film->getImage() ?>" alt="" class="mx-auto">
                    </div>
                    <h1 class="dark:text-white mt-2 text-center"><?= $film->getTitle() ?></h1>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</div>
