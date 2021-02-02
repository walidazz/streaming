<?php

namespace App\EventSubscriber;

use App\Entity\Serie;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $appKernel;

    private $client;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;


        $this->client = HttpClient::create();
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setEmptyDatas'],

        ];
    }

    public function CheckID($entity)
    {
        $response = $this->client->request(
            'GET',
            'https://imdb-api.com/fr/API/Search/k_3ecolzxf/ ' . $entity->getName()
        );
        return  $response->toArray()['results'][0]['id'];
    }

    public function CheckSerieInfo($id)
    {
        $checkSerie =   $this->client->request(
            'GET',
            'https://imdb-api.com/fr/API/Title/k_3ecolzxf/' . $id . '/FullActor,FullCast,Posters,Images,Ratings,'
        );
        return  $checkSerie->toArray();
    }


    public function setEmptyDatas($event)
    {
        /**
         * @var Serie
         */
        $entity = $event->getEntityInstance();



        $id = $this->CheckID($entity);
        $info = $this->CheckSerieInfo($id);

        if (empty($entity->getRating())) {
            $entity->setRating($info['imDbRating']);
        }

        if (empty($entity->getDirector())) {
            $entity->setDirector($info['directors']);
        }

        if (empty($entity->getDuration())) {
            $entity->setDuration($info['runtimeMins']);
        }
    }
}
