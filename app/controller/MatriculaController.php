<?php
class MatriculaController {
    private $service;

    public function __construct(MatriculaService $service) {
        $this->service = $service;
    }

    public function store(array $request) {
        $payload = [
            'aluno' => trim($request['nome'] ?? $request['aluno'] ?? ''),
            'idade' => $request['idade'] ?? '',
            'curso' => trim($request['curso'] ?? '')
        ];

        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' ||
                  (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) ||
                  isset($_POST['is_ajax']);

        try {
            $newId = $this->service->matricular($payload);

            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Inscrição realizada com sucesso!',
                    'data' => [
                        'id' => $newId,
                        'nome' => $payload['aluno'],
                        'curso' => $payload['curso'],
                        'idade' => $payload['idade'],
                        'data' => date('d/m/Y H:i'),
                        'protocolo' => strtoupper(uniqid('PHILO-'))
                    ]
                ]);
                exit;
            }

            header('Location: /index.php?success=1');
            exit;

        } catch (BusinessRuleException $e) {
            $erroMensagem = $e->getMessage();
            $oldData = $request;

            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => $erroMensagem]);
                exit;
            }

            include __DIR__ . '/../../view/form.php';
        } catch (Exception $e) {
            $erroMensagem = 'Ocorreu um erro inesperado. Tente novamente.';
            $oldData = $request;

            if ($isAjax) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => $erroMensagem]);
                exit;
            }

            include __DIR__ . '/../../view/form.php';
        }
    }
}
