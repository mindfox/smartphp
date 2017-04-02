<?php
class Country
{
    
    private $id;
    
    private $countryName;
    
    private $countryCode;
    
    private $capital;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getCountryName()
    {
        return $this->countryName;
    }
    
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
        return $this;
    }
    
    public function getCountryCode()
    {
        return $this->countryCode;
    }
    
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }
    
    public function getCapital()
    {
        return $this->capital;
    }
    
    public function setCapital($capital)
    {
        $this->capital = $capital;
        return $this;
    }
}