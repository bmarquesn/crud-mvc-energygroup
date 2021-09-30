<?php
require_once('model/BeneficioModel.php');
require_once('main/MainController.php');

class BeneficioController extends Controller {
    private $BeneficioModel;
    private $UsuarioModel;

    public function __construct() {
        session_start();

        if(!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
            header('Location:?controller=login&method=logout&message=Preciso-Estar-Logado');
        } else {
            require_once('model/BeneficioModel.php');
            $this->BeneficioModel = new BeneficioModel;
            require_once('model/UsuarioModel.php');
            $this->UsuarioModel = new UsuarioModel;
        }
    }

    public function index() {
        $filtro_1 = isset($_GET['filtro_1'])&&!empty($_GET['filtro_1'])?$_GET['filtro_1']:0;
        $filtro_2 = isset($_GET['filtro_2'])&&!empty($_GET['filtro_2'])?$_GET['filtro_2']:0;
        $filtro_3 = isset($_GET['filtro_3'])&&!empty($_GET['filtro_3'])?$_GET['filtro_3']:0;
        $filtro_4 = isset($_GET['filtro_4'])&&!empty($_GET['filtro_4'])?$_GET['filtro_4']:0;

        if(!empty($filtro_1) || !empty($filtro_2) || !empty($filtro_3) || !empty($filtro_4)) {
            $array_filtro[] = ['nomeUsuario', $filtro_1];
            $array_filtro[] = ['titulo', $filtro_2];
            $array_filtro[] = ['valor', str_replace('R$ ', '', str_replace(',', '.', str_replace('.', '', $filtro_3)))];
            $array_filtro[] = ['data_vencimento', $filtro_4];

            $registros['beneficios'] = $this->BeneficioModel->trazer_dados_beneficios(null, $array_filtro, ['data_vencimento' => 'DESC', 'valor' => 'DESC'], 0);
        } else {
            $registros['beneficios'] = $this->BeneficioModel->trazer_dados_beneficios(null, null, ['data_vencimento' => 'DESC', 'valor' => 'DESC'], 0);
        }

        $registros['beneficios_vencidas']['qtd'] = 0;
        $registros['beneficios_vencidas']['valor'] = 0;
        $registros['beneficios_apagar']['qtd'] = 0;
        $registros['beneficios_apagar']['valor'] = 0;

        if(!empty($registros['beneficios'])) {
            foreach($registros['beneficios'] as $key => $value) {
                if(strtotime(date('Y-m-d')) > strtotime($value['data_vencimento'])) {
                    $registros['beneficios_vencidas']['qtd']++;
                    $registros['beneficios_vencidas']['valor'] = $registros['beneficios_vencidas']['valor'] + $value['valor'];
                } else {
                    $registros['beneficios_apagar']['qtd']++;
                    $registros['beneficios_apagar']['valor'] = $registros['beneficios_apagar']['valor'] + $value['valor'];
                }
            }
        }

        return $this->view('beneficio', [
            'registros' => $registros
            ,'css_pages' => 'jquery-ui/jquery-ui.min.css'
            ,'script_pages' => ['jquery-ui/jquery-ui.min.js', 'beneficio.js', 'jquery.maskMoney.js']
        ], 'pagina_interna');
    }

    public function inserir() {
        $ativo = 1;
        $registros['usuarios'] = $this->UsuarioModel->all($ativo, ['nome', 'ASC']);

        return $this->view('beneficioInserir', [
            'registros' => $registros
            ,'css_pages' => 'jquery-ui/jquery-ui.min.css'
            ,'script_pages' => ['jquery-ui/jquery-ui.min.js', 'beneficio.js', 'jquery.maskMoney.js']
        ], 'pagina_interna');
    }

    public function salvar() {
        $dados_salvar = $_POST;
        $id_beneficio = NULL;

        foreach($dados_salvar as $key => $value) {
            if(!empty(trim($value))) {
                /** usa-se esta parte para usar na atualização */
                if($key == 'beneficio_id' && !empty($value)) {
                    $this->BeneficioModel->__set('id', 'id-'.(int)$value);
                }

                if($key == 'usuario_id') {
                    $this->BeneficioModel->__set($key, (int)$value);
                } elseif($key == 'valor') {
                    $this->BeneficioModel->__set($key, str_replace('R$ ', '', str_replace(',', '.', str_replace('.', '', $value))));
                } elseif($key == 'data_vencimento') {
                    $this->BeneficioModel->__set($key, substr($value, 6) . '-' . substr($value, 3, -5) . '-' . substr($value, 0, -8));
                } else {
                    if($key != 'beneficio_id') {
                        $this->BeneficioModel->__set($key, $value);
                    }
                }
            }
        }

        $id_beneficio = $this->BeneficioModel->save(0);

        if(strripos($id_beneficio, 'Error') === false) {
            echo "salvou";
        } else {
            /** aqui mostrará o erro SQL */
            echo $id_beneficio;
        }

        die;
    }

    public function editar() {
        if(isset($_GET['identifier']) && !empty($_GET['identifier'])) {
            $id_beneficio = (int)$_GET['identifier'];
        }

        $ativo = 1;

        $dados_beneficio = $this->BeneficioModel->trazer_dados_beneficios($id_beneficio, null, null, 0);

        if(!empty($dados_beneficio[0])) {
            $dados_beneficio[0]['data_vencimento'] = substr($dados_beneficio[0]['data_vencimento'], 8, 2) . '/' . substr($dados_beneficio[0]['data_vencimento'], 5, 2) . '/' . substr($dados_beneficio[0]['data_vencimento'], 0, 4);
            $dados_beneficio[0]['valor'] = number_format($dados_beneficio[0]['valor'], 2, ',', '.');
        }

        $registros['beneficio'] = $dados_beneficio[0];

        $registros['usuarios'] = $this->UsuarioModel->all($ativo, ['nome', 'ASC']);

        return $this->view('beneficioInserir', [
            'registros' => $registros
            ,'css_pages' => 'jquery-ui/jquery-ui.min.css'
            ,'script_pages' => ['jquery-ui/jquery-ui.min.js', 'beneficio.js', 'jquery.maskMoney.js']
        ], 'pagina_interna');
    }

    public function excluir() {
        $dados_salvar = $_POST;

        $this->BeneficioModel->destroy(array_keys($dados_salvar)[0], array_values($dados_salvar)[0], 0);

        echo "excluiu";
        die;
    }
}