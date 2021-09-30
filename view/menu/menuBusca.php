<?php
$html_titulo_search = "";

switch(strtoupper($pagina_Atual)) {
    case 'USUARIO':
        $html_titulo_search = "<h2>Usuário</h2>";
        if(strtoupper($funcao_Atual) != "INSERIR" && stripos($funcao_Atual, 'editar') === false) {
            $html_titulo_search = $html_titulo_search . '
            <div class="row" id="menu_busca">
                <div class="col-5 align-items-center">
                    <input type="text" value="" class="buscar form-control" placeholder="NOME" />
                </div>
                <div class="col-5 align-items-center">
                    <input type="text" value="" class="buscar form-control" placeholder="EMAIL" />
                </div>
                <div class="col-1 align-items-center nopadding">
                    <button type="button" class="buscar_usuario"><img src="assets/img/lupa_1.png" alt="Buscar" title="Buscar" class="img-fluid" /></button>
                </div>
                <div class="col-1 align-items-center nopadding">
                    <button type="button" class="inserir_usuario"><img src="assets/img/bt_adicionar.png" alt="Adicionar" title="Adicionar" class="img-fluid" /></button>
                </div>
            </div><br />
            ';
        } else {
            $html_titulo_search = "<h2>" . strtoupper($funcao_Atual) . " Usuário</h2>";
        }
        break;
    case 'BENEFICIO':
        $html_titulo_search = "<h2>Benefícios</h2>";
        if(strtoupper($funcao_Atual) != "INSERIR" && stripos($funcao_Atual, 'editar') === false) {
            $html_titulo_search = $html_titulo_search . '
            <div class="row" id="menu_busca">
                <div class="col align-items-center">
                    <input type="text" value="" class="buscar form-control" placeholder="TÍTULO" />
                </div>
                <div class="col align-items-center">
                    <input type="text" value="" class="buscar form-control" placeholder="USUÁRIO" />
                </div>
                <div class="col align-items-center">
                    <input type="text" value="" class="buscar form-control" placeholder="VALOR" />
                </div>
                <div class="col align-items-center">
                    <input type="text" value="" class="buscar form-control" placeholder="DATA VENCIMENTO" />
                </div>
                <div class="col-1 align-items-center nopadding">
                    <button type="button" class="buscar_beneficio"><img src="assets/img/lupa_1.png" alt="Buscar" title="Buscar" class="img-fluid" /></button>
                </div>
                <div class="col-1 align-items-center nopadding">
                    <button type="button" class="inserir_beneficio"><img src="assets/img/bt_adicionar.png" alt="Adicionar" title="Adicionar" class="img-fluid" /></button>
                </div>
            </div><br />
            ';
        } else {
            $html_titulo_search = "<h2>" . strtoupper($funcao_Atual) . " Benefício</h2>";
        }
        break;
    default:
        $html_titulo_search = "<br />";
}

echo trim($html_titulo_search);
?>