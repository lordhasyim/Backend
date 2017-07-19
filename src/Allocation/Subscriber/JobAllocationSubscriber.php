<?php

namespace Persona\Hris\Allocation\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Persona\Hris\Allocation\Model\JobAllocationInterface;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@personahris.com>
 */
final class JobAllocationSubscriber implements EventSubscriber
{
    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(LifecycleEventArgs $eventArgs): void
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof JobAllocationInterface) {
            $employee = $entity->getEmployee();
            $employee->setJobTitle($entity->getNewJobTitle());
            $employee->setCompany($entity->getNewCompany());
            $employee->setDepartment($entity->getNewDepartment());
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function preUpdate(LifecycleEventArgs $eventArgs): void
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof JobAllocationInterface) {
            $employee = $entity->getEmployee();
            $employee->setJobTitle($entity->getNewJobTitle());
            $employee->setCompany($entity->getNewCompany());
            $employee->setDepartment($entity->getNewDepartment());
        }
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [Events::prePersist, Events::preUpdate];
    }
}
