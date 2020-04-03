<?php

namespace Router;

class Router {

    private $request;

    private $allowedMethods = ["GET", "POST"];

    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    public function __call($name, $args)
    {
        list($route, $method) = $args;

        if (!in_array(strtoupper($name), $this->allowedMethods))
        {
            $this->methodNotAllowed();
        }

        $this->{strtolower($name)}[rtrim($route, '/')] = $method;
    }

    public function __destruct()
    {
        $this->execute();
    }

    protected function execute()
    {
        $method = $this->{strtolower($this->request->getRequestMethod())};
        $act = $method[$this->request->getRequestURL()] ?? NULL;

        if (is_null($act))
        {
            http_response_code(404);
            echo "404 Route Not Found";
            return;
        }

        echo call_user_func_array($act, [$this->request]);
    }

    protected function methodNotAllowed()
    {
        http_response_code(405);
        
        echo $this->request->getRequestMethod()." 405 Method Not Allowed";
        return;
    }
}
