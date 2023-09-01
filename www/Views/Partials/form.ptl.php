

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>
    <form method="<?= $config["config"]["method"] ?>"
          action="<?= $config["config"]["action"] ?>"
        <?php if (isset($config["config"]["enctype"])): ?>
            enctype="<?= $config["config"]["enctype"] ?>"
        <?php endif; ?>
          id="<?= $config["config"]["id"] ?>"
          class="<?= $config["config"]["class"] ?>">

        <?php foreach ($config["inputs"] as $name=>$configInput): ?>

        <div>
            <label for="<?= $name ?>" class="block text-md font-medium leading-6 text-gray-400"><?= $name ?></label>
            <div class="mt-2">
                <input
                    name="<?= $name ?>"
                    placeholder="<?= $configInput["placeholder"] ?? null ?>"
                    class="<?= $configInput["class"] ?>"
                    id="<?= $configInput["id"] ?>"
                    type="<?= $configInput["type"] ?>"
                    <?= $configInput["required"]?"required":"" ?>
                >
            </div>
        </div>

        <?php endforeach;?>

        <br>

        <div>
            <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>" class="<?= $config["config"]["submit_class"] ?>">
            <?php if (isset($config["config"]["reset"])): ?>
                <input type="reset" value="<?= $config["config"]["reset"] ?>">
            <?php endif; ?>
        </div>
        <?php if(!empty($errors)): ?>
        <?php print_r("<p class='text-white'>" . $errors . "</p>");?>
        <?php endif;?>
    </form>