<?php

namespace App\Validator;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ConfirmedSlotIsFreeValidator extends ConstraintValidator
{
    private ReservationRepository $reservationRepository;

    public function __construct(ReservationRepository $repository)
    {
        $this->reservationRepository = $repository;
    }
    /**
     * @param Reservation $reservation
     */
    public function validate($reservation, Constraint $constraint): void
    {
        if (!$reservation instanceof Reservation) {
            throw new UnexpectedValueException($reservation, Reservation::class);
        }
        if (!$constraint instanceof ConfirmedSlotIsFree) {
            throw new UnexpectedValueException($constraint, ConfirmedSlotIsFree::class);
        }
        $startDate = $reservation->getStartDate();
        $endDate = $reservation->getEndDate();
        $reservations = $this->reservationRepository->checkIfIsAlreadyTaken($startDate, $endDate);
        if($reservations){
            $this->context
                ->buildViolation($constraint->spotAlreadyTaken)
                ->addViolation();
        }
    }
}