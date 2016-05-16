<?php

namespace px\FormBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class DatePickerTransformer implements DataTransformerInterface
{
    /**
     * Transforms an object (DateTime) to a string.
     *
     * @param DateTime $date
     *
     * @return string
     */
    public function transform($date)
    {
        if (null === $date) {
            return '';
        }

        return $date->format('d/m/Y');
    }

    /**
     * Transforms a string to an object (DateTime).
     *
     * @param string $stringDate
     *
     * @return DateTime
     */
    public function reverseTransform($stringDate)
    {
        // no string date? It's optional, so that's ok
        if (!$stringDate) {
            return;
        }
        $date = \DateTime::createFromFormat('d/m/Y', $stringDate);

        return $date ? $date : null;
    }
}
