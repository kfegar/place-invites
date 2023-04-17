<?php 

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConfirmedSlotIsFree extends Constraint
{
    public string $spotAlreadyTaken = 'La place est déjà prise sur ces dates';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}