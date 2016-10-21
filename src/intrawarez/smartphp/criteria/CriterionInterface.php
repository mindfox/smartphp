<?php
namespace intrawarez\smartphp\criteria;

interface CriterionInterface
{
    
    public function getFieldName(): string;
    
    public function getOperatorId(): string;
    
    public function getValue();
    
    public function setFieldName(string $fieldName);
    
    public function setOperatorId(string $operatorId);
    
    public function setValue($value);
}
