<?php
include __DIR__ . "/../adminHeader.view.php";
?>
<div class="h-16">

</div>
<div id="movie-add-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <?php $this->partial("movieForm", $movieForm, $formErrors) ?>
</div>
<?php //var_dump(count($users)); ?>
<div class="" id="userTableDiv">
    <table id="userTable" class="">
        <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr data-user-id="<?= $user->getId() ?>">
                <td><?= $user->getFirstname() . " " . $user->getLastname() ?></td>
                <td>
                    <input type="email" value="<?= $user->getEmail() ?>" class="email-input bg-slate-800"/>
                </td>
                <td>
                    <select class="bg-blue-900 text-white px-4 py-2 rounded-md status-select">
                        <option value="0" <?php echo ($user->getStatus() === 0) ? "selected" : ""; ?>>Unconfirmed</option>
                        <option value="1" <?php echo ($user->getStatus() === 1) ? "selected" : ""; ?>>User</option>
                        <option value="2" <?php echo ($user->getStatus() === 2) ? "selected" : ""; ?>>Admin</option>
                    </select>
                </td>
                <td class="text-center">
                    <!-- Notez que j'ai ajouté la classe "btn-save-status" à ce bouton -->
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded btn-save-status">Valider</button>
                    <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded btn-delete-user">Supprimer</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="hidden" id="filmTableDiv">
    <table id="filmTable" class=" " style="">
        <thead>
        <tr>
            <th class="text-center">Titre</th>
            <th class="text-center">Synopsis</th>
            <th class="text-center">Année</th>
            <th class="text-center">Durée</th>
            <th class="text-center">Catégorie</th>
            <th class="text-center"></th>
        </tr>
        </thead>
        <tbody class="">
        <!-- Vos lignes iront ici -->
        <?php foreach ($films as $film): ?>
            <tr data-film-id="<?= $film->getId() ?>">
                <td>
                    <input type="text" value="<?= $film->getTitle() ?>" class="title-input bg-slate-800" />
                </td>
                <td>
                    <textarea class="description-input bg-slate-800"><?= $film->getDescription() ?></textarea>
                </td>
                <td>
                    <input type="number" value="<?= $film->getYear() ?>" class="year-input bg-slate-800" />
                </td>
                <td>
                    <input type="number" value="<?= $film->getLength() ?>" class="length-input bg-slate-800" />
                </td>
                <td>
                    <select class="category-input bg-slate-800">
                        <!-- Les options de votre catégorie iront ici -->
                        <?php foreach ($options as $value => $text): ?>
                            <option value="<?= $value ?>" <?= ($film->getCategory() == $value) ? "selected" : "" ?> class="bg-slate-800"><?= $text ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td class="text-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded btn-save-film">Valider</button>
                    <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded btn-delete-film">Supprimer</button>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<script>
    $('#userTable').DataTable({
        "paging": true
    });
    $('#filmTable').DataTable({
        order: [[0, 'asc']],
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    if (type === 'sort') {
                        const api = new $.fn.dataTable.Api(meta.settings);
                        const tr = api.row(meta.row).node();
                        return $(tr).data('film-id');
                    }
                    return data;
                }
            }
        ]
    });



    // jQuery click handler
    $('.btn-save-status').on('click', function() {
        // Get the selected status value
        const newStatus = $(this).closest('tr').find('.status-select').val();

        // Récupérez le nouvel email
        const newEmail = $(this).closest('tr').find('.email-input').val();

        // Get the user ID from the data attribute "data-user-id"
        const userId = $(this).closest('tr').data('user-id');

        console.log(newStatus + " " + newEmail + " " + userId);

        // Prepare data to be sent to the server
        const data = {
            status: newStatus,
            id: userId,
            email: newEmail
        };

        // Send AJAX PATCH request
        $.ajax({
            url: `/api/users`, // Replace with your actual API URL
            type: 'PATCH',
            contentType: 'application/json',
            data: JSON.stringify(data), // Convert the JavaScript object to a JSON string
            success: function(response) {
                console.log(response);
                location.reload();
                //alert('User status updated successfully.');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
                alert('Failed to update user status.');
            }
        });
    });

    $('.btn-save-film').on('click', function() {
        const filmId = $(this).closest('tr').data('film-id');
        const title = $(this).closest('tr').find('.title-input').val();
        const description = $(this).closest('tr').find('.description-input').val();
        const year = $(this).closest('tr').find('.year-input').val();
        const length = $(this).closest('tr').find('.length-input').val();
        const category = $(this).closest('tr').find('.category-input').val();

        const data = {
            id: filmId,
            title: title,
            description: description,
            year: year,
            length: length,
            category: category
        };

        $.ajax({
            url: `/api/films`, // Remplacez par votre véritable URL API
            type: 'PATCH',
            contentType: 'application/json',
            data: JSON.stringify(data),
            // Ajouter un header avec le token d'authentification
            headers: {
                'Authorization': 'Bearer ' + <? $_SESSION['token'] ?> // Remplacez "yourAuthToken" par votre token d'authentification
            },
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
                alert('Failed to update film.');
            }
        });
    });



    $('.btn-delete-user').on('click', function() {
        // Get the user ID from the data attribute "data-user-id"
        const userId = $(this).closest('tr').data('user-id');

        // Prepare data to be sent to the server
        const data = {
            id: userId
        };

        // Send AJAX DELETE request
        $.ajax({
            url: `/api/users`, // Replace with your actual API URL
            type: 'DELETE',

            contentType: 'application/json',
            data: JSON.stringify(data), // Convert the JavaScript object to a JSON string
            // Ajouter un header avec le token d'authentification
            headers: {
                'Authorization': 'Bearer ' + <? $_SESSION['token'] ?> // Remplacez "yourAuthToken" par votre token d'authentification
            },
            success: function(response) {
                console.log(response);
                location.reload();
                //alert('User deleted successfully.');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
                alert('Failed to delete user.');
            }
        });
    });

    $('.btn-delete-film').on('click', function() {
        // Get the user ID from the data attribute "data-user-id"
        const filmId = $(this).closest('tr').data('film-id');

        // Prepare data to be sent to the server
        const data = {
            id: filmId
        };

        // Send AJAX DELETE request
        $.ajax({
            url: `/api/films`, // Replace with your actual API URL
            type: 'DELETE',
            contentType: 'application/json',
            data: JSON.stringify(data), // Convert the JavaScript object to a JSON string
            // Ajouter un header avec le token d'authentification
            headers: {
                'Authorization': 'Bearer ' + '<? $_SESSION['token'] ?>' // Remplacez "yourAuthToken" par votre token d'authentification
            },
            success: function(response) {
                console.log(response);
                location.reload();
                //alert('User deleted successfully.');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
                alert('Failed to delete user.');
            }
        });
    });







    document.addEventListener('DOMContentLoaded', function() {

        let userTableDiv = document.getElementById('userTableDiv');
        let filmTableDiv = document.getElementById('filmTableDiv');

        let usersButton = document.getElementById('showUsers');
        let filmsButton = document.getElementById('showFilms');

        usersButton.addEventListener('click', function() {
            filmTableDiv.classList.add('hidden');
            userTableDiv.classList.remove('hidden');

            // Hide films button and show users button
            filmsButton.classList.remove('hidden');
            usersButton.classList.add('hidden');
        });

        filmsButton.addEventListener('click', function() {
            userTableDiv.classList.add('hidden');
            filmTableDiv.classList.remove('hidden');

            // Hide users button and show films button
            usersButton.classList.remove('hidden');
            filmsButton.classList.add('hidden');
        });
    });
</script>



