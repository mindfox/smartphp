<?php
namespace intrawarez\smartphp\datasource;

abstract class DSTextMatchStyle extends Enum
{
    const EXACT = "exact";
    const EXACTCASE = "exactCase";
    const SUBSTRING = "substring";
    const STARTSWITH = "startsWith";
}
