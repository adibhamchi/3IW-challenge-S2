<?php

include __DIR__ . "/../header.view.php";

?>
<div class="h-16">

</div>

<div class="container mx-auto px-6 py-10">
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
            <img src="../../public/assets/img/films/<?= $film->getImage() ?>" alt="<?= $film->getTitle() ?>" class="mx-auto">
            <h1 class="text-center text-xl font-bold mt-4 text-gray-200"><?= $film->getTitle() ?></h1>
            <p class="text-center text-gray-500">Year: <?= $film->getYear() ?></p>
            <p class="text-center text-gray-500">Length: <?= $film->getLength() ?></p>
            <p class="text-center text-gray-500">Category: <?= $film->getCategory() ?></p>
            <p class="text-center text-gray-500">Average Note: <?= $averageNote ?></p>
        </div>
        <div class="w-full md:w-1/2 lg:w-2/3 xl:w-3/4">

            <?php if((isset($user) && $user === true) || (isset($admin) && $admin === true) ){ ?>
                <!-- Ajout du formulaire pour poster un commentaire -->
                <div class="mt-4">
                    <h3 class="text-lg font-bold mb-2 text-white">Add a Comment</h3>
                    <form id="comment-form" class="w-full max-w-lg">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="comment-content">
                                    Comment
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="comment-content" name="comment" type="text">
                                <p class="text-red-500 text-xs italic hidden" id="comment-error"></p>
                            </div>
                            <div class="w-full md:w-full px-3">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                                    Post Comment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Fin du formulaire -->
            <?php } ?>
            <h2 class="text-xl font-bold mb-4 text-white">Comments</h2>
            <?php foreach ($comments as $comment): ?>
                <?php
                $commentUser = $comment->getUserInfo();
                ?>
                <div class="bg-gray-100 px-4 py-2 mb-2">
                    <p class="text-gray-800"><?= $comment->getContent() ?></p>
                    <p class="text-gray-500 font-bold">Posted by <?= $commentUser->getFirstname() ?> on <?= $comment->getDateInserted() ?></p>
                    <?php if(isset($admin) && $admin === true){ ?>
                    <button class="delete-comment" data-comment-id="<?= $comment->getId() ?>">Supprimer</button>
                    <?php } ?>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>
<script type="application/javascript">
    function getFilmIdFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('id');
    }

    <?php if($user){ ?>
    $(document).ready(function() {
        $('#comment-form').on('submit', function(e) {
            e.preventDefault();

            var content = $('#comment-content').val();

            let filmId = getFilmIdFromUrl();
            $.ajax({
                url: '/api/comments', // plus besoin de passer les variables dans l'URL
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    film_id: filmId,
                    user_id: <?= $_SESSION['user_id'] ?>,
                    content: content
                }),
                success: function() {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#comment-error').text('Erreur lors de l\'ajout du commentaire : ' + errorThrown).show();
                }
            });
        });
    });
    <?php } ?>

    <?php if($admin){ ?>
        $(document).ready(function() {
            $('.delete-comment').on('click', function() {
                var commentId = $(this).data('comment-id');

                $.ajax({
                    url: '/api/comments?id=' + commentId,
                    type: 'DELETE',
                    success: function() {
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#comment-error').text('Erreur lors de la suppression du commentaire : ' + errorThrown).show();
                    }
                });
            });
        });
    <?php } ?>
</script>
