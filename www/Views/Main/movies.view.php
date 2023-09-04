<?php include __DIR__ . "/../header.view.php"?>

<div class="container px-6 py-10 mx-auto ">

    <h1 class="text-center font-bold text-white">Tous les films</h1>

    <label for="categoryFilter" class="block mt-4 text-white">Filtrer par catégorie:</label>
    <select id="categoryFilter" class="bg-gray-200 rounded-md p-2">
        <option value="all">Toutes les catégories</option>
        <option value="action">Action</option>
        <option value="drama">Drame</option>
        <option value="comedy">Comedy</option>
        <option value="horror">Horror</option>
        <option value="thriller">Thriller</option>
        <option value="western">Western</option>
        <option value="animation">Animation</option>
        <option value="documentary">Documentary</option>
        <option value="sci-fi">Science Fiction</option>
        <option value="fantasy">Fantasy</option>
        <option value="crime">Crime</option>
        <option value="adventure">Adventure</option>
        <option value="mystery">Mystery</option>
        <option value="romance">Romance</option>
        <option value="family">Family</option>
        <option value="war">War</option>
        <option value="music">Music</option>
        <option value="history">History</option>
        <option value="tv-movie">TV Movie</option>
    </select>

    <input type="text" id="searchInput" class="w-full p-2 mt-4 rounded-md bg-gray-200" placeholder="Rechercher un film...">

    <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 sm:grid-cols-2 xl:grid-cols-4 lg:grid-cols-3">

        <?php foreach ($films as $film): ?>
            <div class="w-full movie-item" data-category="<?= $film->getCategory() ?>">
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

<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const categoryFilter = document.getElementById('categoryFilter');
        const movieItems = document.querySelectorAll('.movie-item');
        const searchInput = document.getElementById('searchInput');

        categoryFilter.addEventListener('change', function() {
            const selectedCategory = categoryFilter.value;
            console.log(selectedCategory);

            movieItems.forEach(function(movie) {
                const movieCategory = movie.getAttribute('data-category'); // Utiliser getAttribute au lieu de dataset

                if (selectedCategory === 'all' || selectedCategory === movieCategory) {
                    movie.style.display = 'block';
                } else {
                    movie.style.display = 'none';
                }
            });
        });

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();

            movieItems.forEach(function(movie) {
                const movieCategory = movie.getAttribute('data-category');
                const movieTitle = movie.querySelector('h1').textContent.toLowerCase();

                const categoryMatch = (categoryFilter.value === 'all' || categoryFilter.value === movieCategory);
                const titleMatch = movieTitle.startsWith(searchTerm);

                if (categoryMatch && titleMatch) {
                    movie.style.display = 'block';
                } else {
                    movie.style.display = 'none';
                }
            });
        });
    });
</script>
