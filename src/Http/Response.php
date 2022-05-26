<?php

namespace Tlait\CarForRent\Http;

class Response
{
    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_BAD_REQUEST = 400;


    private int $statusCode;
    private ?string $template = null;
    private array $options = [];
    private ?string $data = null;
    private array $headers = [];

    /**
     * @param string $template
     * @param array $options
     * @param int $statusCode
     * @return $this
     */
    public function view(string $template, array $options = [], int $statusCode = Response::HTTP_OK): Response
    {
        $this->setStatusCode($statusCode);
        $this->setTemplate($template);
        $this->setOptions($options);
        return $this;
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return $this
     */

    public function success(array $data = [], int $statusCode = Response::HTTP_OK): Response
    {
        $data = [
            'status' => 'success',
            'data' => $data
        ];
        $this->setStatusCode($statusCode);
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

    public function error( array $message = [], int $statusCode = Response::HTTP_BAD_REQUEST): Response
    {
        $data = [
            'status' => 'error',
            'message' => $message
        ];
        $this->setStatusCode($statusCode);
        $this->headers = array_merge($this->headers, [
            'Content-Type' => 'application/json'
        ]);
        $this->data = json_encode($data);

        return $this;
    }

    /**
     * @param string $route
     * @return $this
     */
    public function redirect(string $route)
    {
        header("Location: $route");
        return $this;
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
