<?php

namespace Tlait\CarForRent\Controller;

use Exception;
use Tlait\CarForRent\Exception\PasswordInvalidException;
use Tlait\CarForRent\Exception\UserNotFoundException;
use Tlait\CarForRent\Exception\ValidationException;
use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Http\Response;
use Tlait\CarForRent\Service\SessionService;
use Tlait\CarForRent\Service\UserService;
use Tlait\CarForRent\Transfer\UserTransfer;
use Tlait\CarForRent\Validation\UserValidator;

class UserController extends BaseController
{
    private UserValidator $userValidator;
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct(
        Request        $request,
        Response       $response,
        UserValidator  $userValidator,
        UserService    $userService,
        SessionService $sessionService
    )
    {
        parent::__construct($request, $response);
        $this->userValidator = $userValidator;
        $this->userService = $userService;
        $this->sessionService = $sessionService;
    }

    /**
     * @return Response|void
     * @throws Exception
     */
    public function login()
    {
        $template = 'login.php';
        if ($this->sessionService->get('user') != null)
            return $this->response->redirect('/');

        if ($this->request->isGet()) {
            return $this->response->view($template);
        }
        try {
            $params = $this->request->getFormParams();
            $userTransfer = new UserTransfer();
            $userTransfer->formArray($params);

            $this->userValidator->validate($userTransfer);

            $user = $this->userService->login($userTransfer);
            $this->sessionService->set("user", $user->getUsername());
            $this->response->redirect("/");
        } catch (PasswordInvalidException|ValidationException|UserNotFoundException $exception) {
            return $this->response->view(
                $template,
                [
                    'message' => $exception->getMessage(),
                ],
                Response::httpStatusBadRequest
            );
        }
    }

    public function logout()
    {
        $this->sessionService->unset('user');
        $this->response->redirect("/");
    }
}
