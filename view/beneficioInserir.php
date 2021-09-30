<?php $dados_beneficio = $html_pagina['library']['registros']; ?>
<div class="beneficio form-inserir">
    <input type="hidden" name="beneficio_id" value="<?php echo isset($dados_beneficio['beneficio'])&&!empty($dados_beneficio['beneficio'])?$dados_beneficio['beneficio']['beneficio_id']:''; ?>" readonly="readonly" />
    <div class="row">
        <div class="col">
            <label for="usuario_id">Selecione o Usuário</label>
            <select name="usuario_id" class="form-control" id="usuario_id">
                <option value="">-- Selecione --</option>
                <?php
            if(isset($dados_beneficio['usuarios']) && !empty($dados_beneficio['usuarios'])) {
                foreach($dados_beneficio['usuarios'] as $key => $value) {
                    $selected = '';

                    if(isset($dados_beneficio['beneficio']) && !empty($dados_beneficio['beneficio']) && $dados_beneficio['beneficio']['usuario_id'] == $value['id']) {
                        $selected = ' selected="selected"';
                    }

                    echo '<option value="' . $value['id'] . '"'.$selected.'>' . $value['nome'] . ' - ' . $value['cpf_cnpj'] . '</option>';
                }
            }
            ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="titulo">Título</label><input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo isset($dados_beneficio['beneficio'])&&!empty($dados_beneficio['beneficio'])?$dados_beneficio['beneficio']['tituloBeneficio']:''; ?>" placeholder="Digite TÍTULO" maxlength="200" />
        </div>
        <div class="col">
            <label for="codigo">Código</label><input type="text" name="codigo" class="form-control" id="codigo" value="<?php echo isset($dados_beneficio['beneficio'])&&!empty($dados_beneficio['beneficio'])?$dados_beneficio['beneficio']['codigo']:''; ?>" placeholder="Digite CÓDIGO" maxlength="200" />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="operadora">Operadora</label><input type="text" name="operadora" class="form-control" id="operadora" value="<?php echo isset($dados_beneficio['beneficio'])&&!empty($dados_beneficio['beneficio'])?$dados_beneficio['beneficio']['operadora']:''; ?>" placeholder="Digite OPERADORA" maxlength="200" />
        </div>
        <div class="col">
            <label for="tipo">Tipo</label><input type="text" name="tipo" class="form-control" id="tipo" value="<?php echo isset($dados_beneficio['beneficio'])&&!empty($dados_beneficio['beneficio'])?$dados_beneficio['beneficio']['tipo']:''; ?>" placeholder="Digite TIPO" maxlength="200" />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="valor">Valor</label><input type="text" name="valor" class="form-control" id="valor" value="<?php echo isset($dados_beneficio['beneficio'])&&!empty($dados_beneficio['beneficio'])?$dados_beneficio['beneficio']['valor']:''; ?>" placeholder="Digite o Valor do Benefício" maxlength="27" />
        </div>
        <div class="col">
            <label for="data_vencimento">Data do Vencimento</label><input type="text" name="data_vencimento" readonly="readonly" class="form-control" id="data_vencimento" value="<?php echo isset($dados_beneficio['beneficio'])&&!empty($dados_beneficio['beneficio'])?$dados_beneficio['beneficio']['data_vencimento']:''; ?>" placeholder="Selecione a Data do Vencimento" style="background-color:#FFF !important;" />
        </div>
    </div>
    <br /><br /><br />
    <div class="row">
        <div class="col-4">
            <a href="?controller=beneficio"><input type="button" value="VOLTAR" class="form-control voltar btn btn-warning" /></a>
        </div>
        <div class="col-4">
            <input type="reset" value="LIMPAR" class="form-control btn btn-danger" />
        </div>
        <div class="col-4">
            <input type="button" value="SALVAR" class="form-control btn btn-primary" />
        </div>
    </div>
    <br />
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
<?php if(isset($dados_beneficio['beneficio']) && !empty($dados_beneficio['beneficio'])): ?>
<script type="text/javascript">
$(function() {
    $('#beneficio_id').val('<?php echo $dados_beneficio['beneficio']['beneficio_id']; ?>');
});
</script>
<?php endif ?>