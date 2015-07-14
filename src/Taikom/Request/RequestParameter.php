<?php
namespace Taikom\Request;

interface RequestParameter {
    public function addToRequest(\Taikom\Request\Request $request, $key);
}