<nav id="sidebar" class="display-flex">
    <div id="sidebar_content">
        <div id="user" class="display-flex">
            <img src="<?php echo BASE_URL_ICONS . "logo.png" ?>" alt="Avatar">
            <p id="user_infos" class="display-flex">
                <span class="item-description">
                    Plante-se
                </span>
                <span class="item-description">
                    Tudo sobre plantas!
                </span>
            </p>
        </div>

        <ul id="side_items" class="display-flex">
            <li class="side-item active">
                <a class="display-flex" href="<?php echo BASE_URL . "index.php"?>">
                    <img class="display-flex" src="<?php echo BASE_URL_ICONS . "list.svg" ?>" alt="Icone para expandir menu.">
                    <span class="item-description">
                        Início
                    </span>
                </a>
            </li>

            <li class="side-item">
                <a class="display-flex" href="#">
                    <img class="display-flex" src="<?php echo BASE_URL_ICONS . "flower3.svg" ?>" alt="Icone para expandir menu.">
                    <span class="item-description">
                        Plantas
                    </span>
                </a>
            </li>

            <li class="side-item">
                <a class="display-flex" href="#">
                    <img class="display-flex" src="<?php echo BASE_URL_ICONS . "journal.svg" ?>" alt="Icone para expandir menu.">
                    <span class="item-description">
                        Artigos
                    </span>
                </a>
            </li>
        </ul>

        <button id="open_btn">
            <img id="open_btn_icon" src="<?php echo BASE_URL_ICONS . "chevron-compact-right.svg" ?>" alt="Expandir Menu.">
        </button>

    </div>
    <div id="logout">
        <button id="logout_btn" class="display-flex">
            <img src="<?php echo BASE_URL_ICONS . "box-arrow-left.svg" ?>" alt="Botão de logout.">
            <span class="item-description">
                Logout
            </span>
        </button>
    </div>
</nav>