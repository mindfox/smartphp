<?php
namespace intrawarez\smartphp;

abstract class DSTextMatchStyle extends Enum
{
    const EXACT = "exact";
    const EXACTCASE = "exactCase";
    const SUBSTRING = "substring";
    const STARTSWITH = "startsWith";
}
