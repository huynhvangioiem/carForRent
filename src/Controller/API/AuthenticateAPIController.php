<?php

namespace Tlait\CarForRent\Controller\API;

use Tlait\CarForRent\Controller\BaseController;
use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Http\Response;
use Tlait\CarForRent\Service\TokenService;
use Tlait\CarForRent\Service\UserService;
use Tlait\CarForRent\Transfer\UserTransfer;
use Tlait\CarForRent\Validation\UserValidator;

class AuthenticateAPIController extends BaseController
{
    private UserValidator $userValidator;
    private UserService $userService;
    private TokenService $tokenService;

    /**
     * @param UserValidator $userValidator
     * @param UserService $userService
     */
    public function __construct(
        Request       $request,
        Response      $response,
        UserValidator $userValidator,
        UserService   $userService,
        TokenService  $tokenService
    )
    {
        parent::__construct($request, $response);
        $this->userValidator = $userValidator;
        $this->userService = $userService;
        $this->tokenService = $tokenService;
    }

    public function login()
    {
        $params = $this->request->getFormParams();
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);

        $errorValidate = $this->userValidator->validate($userTransfer);
        if (!empty($errorValidate)) {
            return $this->response->error($errorValidate);
        }
        $user = $this->userService->login($userTransfer);
        if (is_array($user)) {
            return $this->response->error($user, Response::HTTP_UNAUTHORIZED);
        }

        $userTokenPayload = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
        ];
        $token = $this->tokenService->jwtEncodeData(
            $this->request->getHost() . $this->request->getRequestUri(),
            $userTokenPayload
        );
        return $this->response->success([
            "username" => $user->getUsername(),
            "token" => $token
        ]);
    }
}
