<?php
class MatriculaController {
    private $service;

    // O Controller recebe o Service pronto
    public function __construct($service) {
        $this->service = $service;
    }

    public function store($request) {
        // Detect if request is AJAX/Fetch
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' || 
                  (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) ||
                  isset($_POST['is_ajax']);

        try {
            // Tenta realizar a matrícula através do Service
            $this->service->matricular($request);
            
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Inscrição realizada com sucesso!',
                    'data' => [
                        'nome' => $request['aluno'],
                        'curso' => $request['curso'],
                        'data' => date('d/m/Y H:i'),
                        'protocolo' => strtoupper(uniqid('PHILO-'))
                    ]
                ]);
                exit;
            }

            // Se der certo, redireciona (exemplo)
            header('Location: index.php?success=1');
            exit;
            
        } catch (BusinessRuleException $e) {
            $erroMensagem = $e->getMessage();
            
            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => $erroMensagem]);
                exit;
            }

            include __DIR__ . '/../../views/form.php';
        } catch (Exception $e) {
            $erroMensagem = "Ocorreu um erro inesperado. Tente novamente.";

            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => $erroMensagem]);
                exit;
            }

            include __DIR__ . '/../../views/form.php';
        }
    }
}