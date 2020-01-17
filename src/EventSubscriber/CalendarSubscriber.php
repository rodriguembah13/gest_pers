<?php

namespace App\EventSubscriber;

use App\Repository\CaCongeRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class CalendarSubscriber
{
    private $bookingRepository;
    private $route;

    public function __construct(CaCongeRepository $bookingRepository, RouterInterface $route, UrlGeneratorInterface $router
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->route = $router;
    }

    public function load(CalendarEvent $calendar): void
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change booking.beginAt by your start date property
        $bookings = $this->bookingRepository
            ->createQueryBuilder('booking')
            ->where('booking.dateDebut BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($bookings as $booking) {
            // this create the events with your data (here booking data) to fill calendar
            $bookingEvent = new Event(
                $booking->getLibelle(),
                $booking->getDateDebut(),
                $booking->getDateFin() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */
            $color = 'green';
            if ('approuve' === $booking->getStatus()) {
                $color = 'green';
            } elseif ('confirme' === $booking->getStatus()) {
                $color = 'indigo';
            } elseif ('valide' === $booking->getStatus()) {
                $color = 'red';
            }
            $bookingEvent->setOptions([
                'editable' => true,
                'droppable' => true,
                'backgroundColor' => $color,
                'borderColor' => 'green',
            ]);
            $bookingEvent->addOption('url', $this->route->generate('ca_conge_edit', ['id' => $booking->getId()]));

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($bookingEvent);
        }
    }
}
