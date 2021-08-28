<?php

# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\GestionAssociation;
use DateTimeImmutable;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setGestionAssociationSlugAndDateAndUser'],
        ];
    }

    public function setGestionAssociationSlugAndDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof GestionAssociation)) {
            return;
        }

        // on doit pouvoir recuperer le nom du fichier ici
        


       /*  $slug = $this->slugger->slugify($entity->getDenomination());
        $entity->setSlug($slug); */

        $now = new DateTimeImmutable('now');
        $entity->setCreatedAt($now);

    }
}
?>