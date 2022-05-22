<?php

namespace Tlait\CarForRent\Http;

class Response
{
    const httpStatusOK = 200;
    const httpStatusBadRequest = 400;
    const httpStatusNotFound = 404;

    /**
     * @var int
     */
    protected int $statusCode;
    /**
     * @var string|null
     */
    protected ?string $template = null;
    /**
     * @var array
     */
    protected array $options = [];
    /**
     * @var string|null
     */
    protected ?string $data = null;
    /**
     * @var array
     */
    protected array $headers = [];

    /**
     * @param string $template
     * @param array $options
     * @param int $statusCode
     * @return $this
     */
    public function view(string $template, array $options = [], int $statusCode = Response::httpStatusOK): Response
    {
        $this->statusCode = $statusCode;
        $this->template = $template;
        $this->options = $options;

        return $this;
    }

    /**
     * @param array $data
     * @param $statusCode
     * @return $this
     */
    public function success(array $data = [], $statusCode = Response::httpStatusOK): Response
    {
        $data = [
            'status' => 'success',
            'data' => $data
        ];
        $this->statusCode = $statusCode;
        $this->headers = array_merge($this->headers, [
            'Content-Type' => 'application/json'
        ]);
        $this->data = json_encode($data);

        return $this;
    }

    /**
     * @param string|null $message
     * @param int $statusCode
     * @return $this
     */
    public function error(?string $message = 'Some thing wrong', int $statusCode = Response::httpStatusBadRequest): Response
    {
        $data = [
            'status' => 'error',
            'message' => $message
        ];
        $this->statusCode = $statusCode;
        $this->headers = array_merge($this->headers, [
            'Content-Type' => 'application/json'
        ]);
        $this->data = json_encode($data);

        return $this;
    }

    /**
     * @param string $route
     * @return void
     */
    public function redirect(string $route)
    {
        header("Location: $route");
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string|null $template
     */
    public function setTemplate(?string $template): void
    {
        $this->template = $template;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param string|null $data
     */
    public function setData(?string $data): void
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }


}
