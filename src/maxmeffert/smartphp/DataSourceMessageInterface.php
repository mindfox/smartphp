<?php
namespace maxmeffert\smartphp;

interface DataSourceMessageInterface
{
    public function hasComponentId(): bool;
    
    public function getComponentId(): string;
    
    public function withComponentId(string $componentId): self;
    
    public function hasData(): bool;
    
    public function getData();
    
    public function withData($data): self;
    
    public function hasDataSource(): bool;
    
    public function getDataSource(): string;
    
    public function withDataSource($dataSource): self;
    
    public function hasEndRow(): bool;
    
    public function getEndRow(): int;
    
    public function withEndRow(int $endRow): self;
    
    public function hasOldValues(): bool;
    
    public function getOldValues();
    
    public function withOldValues($oldValues): self;
    
    public function hasOperationType(): bool;
    
    public function getOperationType(): string;
    
    public function withOperationType(string $operationType): self;
    
    public function hasStartRow(): bool;
    
    public function getStartRow(): int;
    
    public function withStartRow(int $startRow): self;
    
    public function hasTextMatchStyle(): bool;
    
    public function getTextMatchStyle(): string;
    
    public function withTextMatchStyle(string $textMatchStyle): self;
    
    public function hasTotalRows(): bool;
    
    public function getTotalRows(): int;
    
    public function withTotalRows(int $totalRows): self;
}