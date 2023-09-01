
<!-- Include dans un modal flowbite -->

<div class="relative w-full max-w-md max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="movie-add-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Nouveau film</h3>
            <form method="<?= $config["config"]["method"] ?>"
                <?php if (isset($config["config"]["enctype"])): ?>
                    enctype="<?= $config["config"]["enctype"] ?>"
                <?php endif; ?>
                  action="<?= $config["config"]["action"] ?>"
                  id="<?= $config["config"]["id"] ?>"
                  class="<?= $config["config"]["class"] ?>">

                <?php foreach ($config["inputs"] as $name=>$configInput): ?>
                    <div>
                        <label for="<?= $name ?>" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?= ucfirst($name) ?></label>
                        <?php if($configInput["type"] === "select"): ?>
                            <select
                                    name="<?= $name ?>"
                                    class="<?= $configInput["class"] ?>"
                                    id="<?= $configInput["id"] ?>"
                                <?= $configInput["required"]?"required":"" ?>
                            >
                                <?php foreach ($configInput["options"] as $value=>$label): ?>
                                    <option value="<?= $value ?>"><?= $label ?></option>
                                <?php endforeach;?>
                            </select>
                        <?php else: ?>
                            <input
                                    name="<?= $name ?>"
                                    placeholder="<?= $configInput["placeholder"] ?? null ?>"
                                    class="<?= $configInput["class"] ?>"
                                    id="<?= $configInput["id"] ?>"
                                    type="<?= $configInput["type"] ?>"
                                <?= $configInput["required"]?"required":"" ?>
                            >
                        <?php endif; ?>
                    </div>
                <?php endforeach;?>


                <input type="submit" name="submit" class="<?= $config["config"]["submit_class"] ?>" value="<?= $config["config"]["submit"] ?>">
                <?php if (isset($config["config"]["reset"])): ?>
                    <input type="reset" value="<?= $config["config"]["reset"] ?>">
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>