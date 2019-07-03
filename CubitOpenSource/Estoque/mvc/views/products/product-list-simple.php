<link rel="stylesheet" href="<?= URL ?>assets/css/headers/headers.css">
<link rel="stylesheet" href="<?= URL ?>assets/css/tables/stripped-table-a.css">
<link rel="stylesheet" href="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/css/list.css">
<script src="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/js/list.js"></script>

<header class="header card-shadow">
    <div class="main-container">
        <h1>Produtos</h1>

        <a class="btn btn-default" href="<?= URL ?>products/new">Cadastrar Produto</a>

        <form>
            <div class="input-group">
                <input type="search" title="Buscar Produtos" name="search" placeholder="Buscar Produtos" value="<?= $search ?>">
            </div>
        </form>

        <form action="<?= URL ?>products/list">
            

            <div class="input-group">
                <select id="select-categories" name="category" title="Mostrar por Categoria" name="filter" onchange="this.form.submit()">
                    <option value="0" <?= ($category == 0) ? "selected='true'" : "" ?>>Todas as Categorias</option>
                    <option value="-1" <?= ($category == -1) ? "selected='true'" : "" ?>>Sem Categoria<?= " (" .$noCategoryProducts .")" ?></option>
                    <?php foreach ($categories as $c) : ?>
                        <?php $i++; ?>
                        <option value="<?= $i ?>" <?= ($category == $c["id"]) ? "selected='true'" : "" ?>><?= $c["name"] . " (" .$c["products"] .")" ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php $this->loadViewPart("pagination", $data); ?>
        </form>
    </div>
</header>

<section class="main-container">
<?php if (count($products) <= 0) : ?>
    <div class="no-products-div">
        <span>Nenhum Produto</span>
    </div>
<?php else : ?>
    <div class="option-wrapper">
        <span class="item" style="display: flex; align-items: center;">
            <input id="select-all" type="checkbox" name="select-all" onclick="toggleSelectCheckboxes(this);">
            <label for="select-all" style="margin-left: 0.5rem;">Marcar tudo</label>
        </span>

        <a id="delete-selected" class="item btn btn-default" href="#" onclick="deleteAllProducts('<?= URL ?>')"><i class="fas fa-trash"></i></a>
    </div>
    
    <table class="list-table">
        <thead>
            <tr>
                <th></th>
                <?php foreach ($columns as $th) : ?>
                <th><?= $th ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody id="products-tbody">
            <?php foreach ($products as $product) : ?>
            <tr onclick="toggleSelectRow.call(this)">
                <input type="hidden" name="id" value="<?= $product["id"] ?>">

                <td style="width: 64px"><input class="checkbox" type="checkbox" name="selected[]"></td>

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
<?php endif; ?>
</section>