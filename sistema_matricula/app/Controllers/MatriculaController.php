<?php
class MatriculaController {
    private $service;

    // O Controller recebe o Service pronto
    public function __construct($service) {
        $this->service = $service;
    }

    public function store($request) {
        try {
            // Tenta realizar a matrícula através do Service
            $this->service->matricular($request);
            
            // Se der certo, redireciona (exemplo)
            header('Location: index.php?success=1');
            exit;
            
        } catch (BusinessRuleException $e) {
            // Se houver erro de regra de negócio, capturamos a mensagem
            $erroMensagem = $e->getMessage();
            
            // Renderiza a view passando o erro (ajuste o caminho da sua view)
            include __DIR__ . '/../../views/form.php';
        } catch (Exception $e) {
            // Erro genérico (ex: banco de dados fora do ar)
            $erroMensagem = "Ocorreu um erro inesperado. Tente novamente.";
            include __DIR__ . '/../../views/form.php';
        }
    }
}