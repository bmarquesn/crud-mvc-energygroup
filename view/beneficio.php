<div class="beneficio">
    <h3>Status Benefícios</h3>
    <ul>
        <li>Quantidade de Benefícios Vencidos: <?php echo $html_pagina['library']['registros']['beneficios_vencidas']['qtd'] . ' | Valor R$ ' . number_format($html_pagina['library']['registros']['beneficios_vencidas']['valor'], 2, ',', '.');?></li>
        <li>Quantidade de Benefícios a Pagar: <?php echo $html_pagina['library']['registros']['beneficios_apagar']['qtd'] . ' | Valor R$ ' . number_format($html_pagina['library']['registros']['beneficios_apagar']['valor'], 2, ',', '.');?></li>
    </ul>
    <br />
    <table class="table table-bordered table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th class="col-2 text-center">Título</th>
                <th class="col-2 text-center">Usuário</th>
                <th class="col-2 text-center">Valor</th>
                <th class="col-2 text-center">Data Vencimento</th>
                <th colspan="2" class="col-2 text-center">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!isset($html_pagina['library']['registros']['beneficios']) || empty($html_pagina['library']['registros']['beneficios'])) {
                echo '<tr><td colspan="6"><em>Não há Benefícios cadastrados</em></td></tr>';
            } else {
                foreach($html_pagina['library']['registros']['beneficios'] as $key => $value) {
                    echo '<tr>';
                        echo '<td><input type="hidden" value="' . $value['beneficio_id'] . '" />' . $value['tituloBeneficio'] . '</td>';
                        echo '<td>' . $value['nomeUsuario'] . '</td>';
                        echo '<td>' . number_format($value['valor'], 2, ',', '.') . '</td>';
                        echo '<td>' . date('d/m/Y', strtotime($value['data_vencimento'])) . '</td>';
                        echo '<td class="text-center"><button type="button" class="btn btn-primary beneficio_editar" title="Visualizar/Editar Benefício">V / E</button></td>';
                        echo '<td class="text-center"><button type="button" class="btn btn-danger beneficio_excluir" title="Excluir Benefício">X</button></td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="modal_valida_beneficio" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>