<link rel="stylesheet" href="<?= URL ?>assets/css/headers/headers.css">
<link rel="stylesheet" href="<?= URL ?>assets/css/tables/stripped-table-a.css">
<link rel="stylesheet" href="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/css/list.css">
<script src="<?= URL ?>assets/js/util.js"></script>
<script src="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/js/list.js"></script>
<script src="<?= URL ?>CubitOpenSource/Estoque/mvc/views/products/js/filter-products.js"></script>

<div id="parent-div">
<header id="header" class="header card-shadow">
    <div class="main-container">
        <h1>Produtos</h1>

        <a class="btn btn-default" href="<?= URL ?>products/new">Cadastrar Produto</a>

        <form style="display: none;">
            <div class="input-group">
                <input type="search" title="Buscar Produtos" name="search" placeholder="Buscar Produtos" value="<?= $search ?>">
            </div>
        </form>

        <form action="<?= URL ?>products/list" style="display: none;">
            
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

<section class="products">
    <aside class="sidebar">
        <div class="filters">
            <h3>Filtros</h3>
            <label>Por nome:</label>
            <input id="filter-name" type="text" name="filter" placeholder="Nome do Produto" onkeyup="filterByName()">
            <a id="clear-name-filter" class="clear-filter" href="javascript:void(0)" title="Remover Filtragem por Nome" onclick="filterByName(true)"><i class="fa fa-times"></i></a>
            <br>

            <label>Por Categoria:</label>
            <select id="filter-category" onchange="filterByCategory(this[this.selectedIndex].value)">
                <option value="0">Todas</option>
                <option value="-1">Sem Categoria<?= " (" .$noCategoryProducts .")" ?></option>
                <?php foreach ($categories as $c) : ?>
                    <?php $i++; ?>
                    <option value="<?= $c["name"] ?>"><?= $c["name"] ." (" .$c["products"] .")" ?></option>
                <?php endforeach; ?>
            </select>
            <a id="clear-category-filter" class="clear-filter" href="javascript:void(0)" title="Remover Filtragem por Categoria" onclick="filterByCategory('0')"><i class="fa fa-times"></i></a>
            <br>

            <label>Por Estoque:</label>
            <select id="filter-stock" onchange="filterByStock(this[this.selectedIndex].value)">
                <option value="0">Todos</option>
                <option value="1">Baixo Estoque</option>
                <option value="2">Alto Estoque</option>
            </select>
            <a id="clear-stock-filter" class="clear-filter" href="javascript:void(0)" title="Remover Filtragem por Estoque" onclick="filterByStock(0)"><i class="fa fa-times"></i></a>
        </div>
        
        <div class="sort">
            <h3>Ordenar</h3>
            todo
        </div>
    </aside>

    <section class="product-list">
        <?php if (count($products) <= 0) : ?>
            <div class="no-products-div">
                <span>Nenhum Produto</span>
            </div>
        <?php else : ?>
            <div class="option-wrapper">
                <span class="item" style="display: flex; align-items: center;">
                    <!-- <input id="select-all" type="checkbox" name="select-all" onclick="toggleSelectCheckboxes(this);"> -->
                    <input id="select-all" type="checkbox" name="select-all" onclick="selectAllCheckboxes(this);">
                    <label id="toggle-select-label" for="select-all" style="margin-left: 0.5rem;">Marcar tudo</label>
                </span>

                <button id="delete-selected" class="item btn btn-default" title="Apagar Produtos Selecionados" onclick="deleteAllProducts('<?= URL ?>')"><i class="fas fa-trash"></i>Apagar Tudo</button>
            </div>
            
            <table class="list-table">
                <thead>
                    <tr>
                        <th></th>
                        <?php foreach ($columns as $th) : ?>
                        <th><?= $th ?></th>
                        <?php endforeach; ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="products-tbody">
                    <?php foreach ($products as $product) : ?>
                    <tr onclick="toggleSelectRow.call(this)">
                        <input type="hidden" name="id" value="<?= $product["id"] ?>">

                        <td data-type="checkbox" align="center" width="10px"><input class="checkbox" type="checkbox" name="selected[]"></td>

                        <td data-type="id"><?= $product["id"] ?></td>

                        <td data-type="description">
                            <a class="post-title" href="<?= URL ?>products/edit/<?= $product["id"] ?>" title="<?= $product["description"] ?>"><?= (strlen($product["description"]) <= 40) ? $product["description"] : substr($product["description"], 0, 40) ."..." ?></a>
                        </td>

                        <td data-type="category"><?= $product["category_name"] ?></td>

                        <td data-type="stock"><?= $product["stock"] ?></td>

                        <td width="100px">
                            <div class="options">
                                <a class="item" href="<?= URL ?>products/edit/<?= $product["id"] ?>" title="Editar Produto"><i class="fa fa-pen"></i></a>
                                <a class="item" href="<?= URL ?>products/delete/<?= $product["id"] ?>" title="Apagar Produto"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</section>



<section class="main-container">

</section>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js
"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script>
    $(document).ready( function () {
        $('.list-table').DataTable();
    } );
</script> -->

<script>
    // initializeFixElement("header");
    initStickyHeader("header");
</script>