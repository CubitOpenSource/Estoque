<link rel="stylesheet" href="<?= URL ?>assets/css/tables/stripped-table-a.css">
<link rel="stylesheet" href="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/css/list.css">
<table class="list-table">
    <thead>
        <tr>
            <?php foreach ($columns as $th) : ?>
            <th><?= $th ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
        <tr>
            <td><?= $product["id"] ?></td>

            <td style="text-align: left;">
                <div>
                    <a class="post-title" href="<?= URL ?>products/edit/<?= $product["id"] ?>" title="<?= $product["description"] ?>"><?= (strlen($product["description"]) <= 40) ? $product["description"] : substr($product["description"], 0, 40) ."..." ?></a>
                </div>
                
                <div class="options">
                    <a class="item" href="<?= URL ?>products/edit/<?= $product["id"] ?>">Editar</a>
                    <div class="item">|</div>
                    <!-- <a class="item" target="_blank" href="<?= URL ?>products/view/<?= $product["id"] ?>">Visualizar</a>
                    <div class="item">|</div> -->
                    <a class="item" href="<?= URL ?>products/delete/<?= $product["id"] ?>">Apagar</a>
                </div>
            </td>

            <td><?= $product["category_name"] ?></td>

            <td><?= $product["stock"] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>