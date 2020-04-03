<?php

namespace Router;

class Request implements IRequest {

    protected $requestMethod = "";
    protected $params = [];
    protected $queries = [];

    public function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->requestURL    = $this->filterRequestURL();

        $this->parseBody();
    }

    protected function filterRequestURL() {
        $str = explode('?', $_SERVER['REQUEST_URI']);
        $str = $str[0];
        return rtrim($str, '/');
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getQueries()
    {
        return $this->queries;
    }

    public function getParam($name)
    {
        return $this->params[$name] ?? FALSE;
    }

    public function getQuery($name)
    {
        return $this->queries[$name] ?? FALSE;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getRequestURL()
    {
        return $this->requestURL;
    }

    protected function parseBody()
    {
        if ($this->requestMethod === "GET")
        {
            $this->parseQueries();
        }

        if ($this->requestMethod === "POST")
        {
            $this->parseQueries();
            $this->parseParams();
        }
    }

    protected function parseParams()
    {
        foreach($_POST as $key => $value)
        {
            $this->params[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }

    protected function parseQueries()
    {
        if (isset($_SERVER['QUERY_STRING']))
        {
            parse_str($_SERVER['QUERY_STRING'], $this->queries);
        }
    }
}
