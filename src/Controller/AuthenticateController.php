<?php

namespace Tlait\CarForRent\Controller;

use Exception;
use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Http\Response;
use Tlait\CarForRent\Service\SessionService;
use Tlait\CarForRent\Service\UserService;
use Tlait\CarForRent\Transfer\UserTransfer;
use Tlait\CarForRent\Validation\UserValidator;

class AuthenticateController extends BaseController
{
    private UserValidator $userValidator;
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct(
        Request $request,
        Response $response,
        UserValidator $userValidator,
        UserService $userService,
        SessionService $sessionService
    ) {
        parent::__construct($request, $response);
        $this->userValidator = $userValidator;
        $this->userService = $userService;
        $this->sessionService = $sessionService;
    }

    /**
     * @return Response|void
     */
    public function login()
    {
        $template = 'login.php';
        // case user is logged
        if ($this->sessionService->get('username') != null) {
            return $this->response->redirect('/');
        }

        //case the user log in
        if ($this->request->isPost()) {
            try {
                $params = $this->request->getFormParams();
                $userTransfer = new UserTransfer();
                $userTransfer->formArray($params);

                $errorValidate = $this->userValidator->validate($userTransfer);
                if (!empty($errorValidate)) {
                    return $this->reRenderViewLogin($template, $errorValidate);
                }

                $user = $this->userService->login($userTransfer);
                if (is_array($user)) {
                    return $this->reRenderViewLogin($template, $user);
                }
                $this->sessionService->set("username", $user->getUsername());

                return $this->response->redirect("/");
            } catch (Exception $exception) {
                return $this->reRenderViewLogin(
                    $template,
                    [
                        'errorMessage' => $exception->getMessage(),
                    ]
                );
            }
        }

        //case other
        return $this->response->view($template);
    }

    public function logout(): Response
    {
        $this->sessionService->unset('username');
        return $this->response->redirect("/");
    }

    /**
     * @param String $template
     * @param array $error
     * @return Response
     */
    private function reRenderViewLogin(string $template, array $error)
    {
        return $this->response->view(
            $template,
            $error,
            400
        );
    }
}
