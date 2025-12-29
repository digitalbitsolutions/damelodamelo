<?= $this->extend("layouts/nav") ?>

<?= $this->section("css") ?>
<link rel="stylesheet" href="<?= base_url()."css/app/users.css" ?>">
<?= $this->endSection() ?>

<?= $this->section("body") ?>
<div class="container-main">
    
    <div class="container-title">
        <h3 class="title is-4"><?= empty($user_level) ? "Usuarios" : "Proveedores de servicio" ?></h3>
        <div class="control has-icons-left">
            <input class="input" type="text" placeholder="Buscar" id="search-user-in-table" />
            <span class="icon is-left">
                <button><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16"><path fill="#666666" d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0a5.5 5.5 0 0 1 11 0"/></svg></button>
            </span>
        </div>
    </div>
    <div class="table-container box" id="table-container">
        <table class="table is-hoverable" id="table-for-pagination">
            <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Tipo de usuario</th>
                <?php if(empty($user_level)){ ?>
                <th>Pub.</th>
                <?php } ?>
                <th>E-mail</th>
                <th>Teléfono</th>
                <th>Teléfono fijo</th>
                <th>Dirección</th>
                <th></th>
            </thead>
            <tbody id="tbody-for-pagination">
                <?php foreach($user as $index => $u){ ?>
                    <tr>
                        <td><?= $index +1  ?></td>
                        <td><?= $u["first_name"] ?><?= !empty($u["last_name"]) ? ", ".$u["last_name"] : "" ?></td>
                        <td><?= $u["user_level_name"] ?></td>
                        <?php if(empty($user_level)){ ?>
                        <td><?= $u["quantity_post"] ?></td>
                        <?php } ?>
                        <td><?= $u["email"] ?></td>
                        <td><?= $u["phone"] ?></td>
                        <td><?= $u["landline_phone"] ?></td>
                        <td class="td-special-row"><?= $u["address"] ?></td>
                        <td>
                            <div class="container-buttons-action">
                                <a href="<?= base_url("users/".$u["id"]) ?>" class="dropdown-item">
                                    <button class="button is-small">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path fill="#666666" d="M30.94 15.66A16.69 16.69 0 0 0 16 5A16.69 16.69 0 0 0 1.06 15.66a1 1 0 0 0 0 .68A16.69 16.69 0 0 0 16 27a16.69 16.69 0 0 0 14.94-10.66a1 1 0 0 0 0-.68M16 25c-5.3 0-10.9-3.93-12.93-9C5.1 10.93 10.7 7 16 7s10.9 3.93 12.93 9C26.9 21.07 21.3 25 16 25"/><path fill="#666666" d="M16 10a6 6 0 1 0 6 6a6 6 0 0 0-6-6m0 10a4 4 0 1 1 4-4a4 4 0 0 1-4 4"/></svg>
                                    </button>
                                </a>
                                <button class="button is-small btn-open-modal-delete" data-id-user="<?= $u["id"] ?>" ><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6" color="#666666"/></svg></button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div>
        <nav class="pagination" role="navigation" aria-label="pagination">
            <a class="pagination-previous is-disabled" title="This is the first page">Previous</a>
            <a href="#" class="pagination-next">Next page</a>
            <ul class="pagination-list">
                <li>
                    <a class="pagination-link is-current" aria-label="Page 1" aria-current="page" >1</a>
                </li>
                <li>
                    <a href="#" class="pagination-link" aria-label="Goto page 2">2</a>
                </li>
                <li>
                    <a href="#" class="pagination-link" aria-label="Goto page 3">3</a>
                </li>
            </ul>
        </nav>
    </div>
    
</div>
<div class="modal" id="modal-delete-user">
    <div class="modal-background"></div>
    <div class="modal-content box">
        <div class="container-title">
            <h2>Esta seguro de eliminar al usuario?</h2>
        </div>
        <button class="button" id="btn-confirm-delete-user">Eliminar</button>
    </div>
    <button class="button modal-close is-small"></button>
</div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<script src="<?= base_url()."js/libraries/bulma.pagination.js" ?>"></script>
<script>
    BulmaTableSearch("tbody-for-pagination", "search-user-in-table");
    BulmaPagination("table-for-pagination", null, "table-container");
    const tbody = document.getElementById("tbody-for-pagination");
    const tds = tbody.querySelectorAll(".td-special-row");
    
    const btns_delete = document.querySelectorAll(".btn-open-modal-delete");
    const btn_confirm_delete_user = document.getElementById("btn-confirm-delete-user");
    let iud = null;
    btns_delete.forEach(btn =>{
        btn.addEventListener("click", ()=>{
            iud = btn.dataset.idUser
            openModal(document.getElementById("modal-delete-user"));
        })
    })

    btn_confirm_delete_user.addEventListener("click", async()=>{
        if (iud){
            btn_confirm_delete_user.disabled = true;
            btn_confirm_delete_user.textContent = "Eliminando...";
            await fetch("/user/delete?id="+String(iud)).then(res => res.json()).then(data=>{
                location.reload();
            })
        }
    })

</script>
<?= $this->endSection() ?>