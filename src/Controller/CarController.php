<?php

namespace Tlait\CarForRent\Controller;

use Exception;
use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Http\Response;
use Tlait\CarForRent\Service\CarService;
use Tlait\CarForRent\Service\UploadFileService;
use Tlait\CarForRent\Transfer\CarTransfer;
use Tlait\CarForRent\Validation\CarValidation;

class CarController extends BaseController
{
    private CarValidation $carValidation;
    private CarService $carService;
    private UploadFileService $uploadFileService;

    /**
     * @param $template
     */
    public function __construct(
        Request $request,
        Response $response,
        CarValidation $carValidation,
        CarService $carService,
        UploadFileService $uploadFileService
    ) {
        parent::__construct($request, $response);
        $this->carValidation = $carValidation;
        $this->carService = $carService;
        $this->uploadFileService = $uploadFileService;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $template = "home.php";
        $carData = $this->carService->getCars();
        return $this->reRenderView($template, ["carList" => $carData]);
    }

    public function showAdd(): Response
    {
        return $this->response->view('addCar.php');
    }

    public function addCar(): Response
    {
        $template = "addCar.php";
        try {
            $params = $this->request->getFormParams();
            $carImg = $this->request->getFiles()['img'];

            $params = [
                ...$params,
                "img" => $carImg["name"]
            ];
            $carTransfer = new CarTransfer();
            $carTransfer->formArray($params);

            $errorValidate = $this->carValidation->validate($carTransfer);
            if (!empty($errorValidate)) {
                return $this->reRenderView($template, $errorValidate);
            }

            if ($carImg['name']) {
                $errorUploadFile = $this->uploadFileService->handleUpload($carImg, "img/", "image", 500000);
                if ($errorUploadFile) {
                    return $this->reRenderView($template, ['messageError' => $errorUploadFile]);
                }
            }
            $car = $this->carService->createCar($carTransfer);
            if (empty($car)) {
                return $this->reRenderView($template, ['messageError' => "Some thing is wrong!"]);
            }
            return $this->response->redirect("/");
        } catch (Exception $exception) {
            return $this->reRenderView($template, ['messageError' => $exception->getMessage()]);
        }
    }

    /**
     * @param array $error
     * @return Response
     */
    private function reRenderView(string $template, array $options = [])
    {
        return $this->response->view(
            $template,
            $options,
            "400"
        );
    }
}
