<?php

namespace Router;

interface IRequest {

    public function getParams();
    public function getQueries();

    public function getParam($name);
    public function getQuery($name);
    
    public function getRequestMethod();
    public function getRequestURL();
}
