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



