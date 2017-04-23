<?php
namespace SmartPHP\Callables;

class Comparator extends AbstractCallable implements ComparatorInterface
{

    public function compare($a, $b): int
    {
        return intval($this->call($a, $b));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\ComparatorInterface::equals()
     */
    public function equals($a, $b): bool
    {
        return $this->compare($a, $b) === 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\ComparatorInterface::lessThan()
     */
    public function lessThan($a, $b): bool
    {
        return $this->compare($a, $b) < 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\ComparatorInterface::lessOrEqual()
     */
    public function lessOrEqual($a, $b): bool
    {
        return $this->compare($a, $b) <= 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\ComparatorInterface::greaterThan()
     */
    public function greaterThan($a, $b): bool
    {
        return $this->compare($a, $b) > 0;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Collections\ComparatorInterface::greaterOrEqual()
     */
    public function greaterOrEqual($a, $b): bool
    {
        return $this->compare($a, $b) >= 0;
    }
}
