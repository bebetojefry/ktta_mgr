<?php

namespace App\FrontBundle\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class DatetoStringTransformer implements DataTransformerInterface
{    
    public function transform($date)
    {
        if(null === $date){
            return '';
        }

        return $date->format('d/m/Y');
    }

    public function reverseTransform($date)
    {
        if(null === $date){
            return new \DateTime('now');
        }

        return \DateTime::createFromFormat('d/m/Y', $date);
    }
}