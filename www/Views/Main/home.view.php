<?php
include __DIR__ .  "/../header.view.php";
?>

<section class="">
    <div class="container px-6 py-10 mx-auto ">

        <h1 class="text-center font-bold text-white">Derniers ajouts</h1>

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
        <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mt-4 border-b-4 border-blue-700 hover:border-blue-500 rounded transition-all ease-in-out delay-200" onclick="window.location.href='/movies'">Voir tous les films</button>
    </div>
</section>
<script type="application/javascript">
    import Modal from 'flowbite';
    const $targetEl = document.getElementById('modalEl');
    const modal = new Modal($targetEl);
    modal.show();

    <?php if(isset($admin) &&  $admin === true){ ?>

        $(document).ready(function() {
            $('#film-form').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let object = {};
                formData.forEach((value, key) => {object[key] = value});
                let json = JSON.stringify(object);

                $.ajax({
                    url: '/api/films',
                    type: 'POST',
                    data: json,
                    contentType: 'application/json',
                    processData: false,
                    success: function(result) {
                        console.log("Ok"); // Afficher "Ok" dans la console en cas de succès
                        console.log(result); // Afficher le résultat de l'API dans la console
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Afficher l'erreur dans la console
                    }
                });
            });
        });
    <?php } ?>

</script>