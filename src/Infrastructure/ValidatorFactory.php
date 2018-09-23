<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Symfony\Component\Validator\Validation;

class ValidatorFactory
{
    public function __invoke()
    {
        return Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
    }
}
