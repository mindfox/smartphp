<?php
namespace intrawarez\smartphp\criteria;

interface OperatorInterface
{

    public function condition(array $record, CriterionInterface $criterion): bool;
    
    public function getId(): string;
}
