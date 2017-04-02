<?php
use SmartPHP\Interfaces\DataSourceMessageInterface;
use SmartPHP\Interfaces\DataSourceServiceInterface;

class CountryService implements DataSourceServiceInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::fetch()
     */
    public function fetch(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        $data = [];
        for ($i=0; $i < 10; $i++) {
            $country = new Country();
            $country->setId($i);
            $country->setCountryName("Country$i");
            $country->setCountryCode("C$i");
            $country->setCapital("Capital$i");
            $data[] = $country;
        }
        
        $message->setStartRow(0);
        $message->setEndRow(9);
        $message->setTotalRows(10);
        $message->setData($data);
        
        return $message;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::add()
     */
    public function add(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        // TODO: Auto-generated method stub
    }
}