<?php
namespace SmartPHP\Models;

abstract class DataSourceOperationType
{
    const FETCH = "fetch";
    const ADD = "add";
    const UPDATE = "update";
    const REMOVE = "remove";
}