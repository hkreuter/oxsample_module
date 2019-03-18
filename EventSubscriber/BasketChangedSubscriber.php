<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\EventSubscriber;

use OxidEsales\EshopCommunity\Internal\Utility\ContextInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use OxidEsales\EshopCommunity\Internal\ShopEvents\BasketChangedEvent;

/**
 * Class BasketChangedSubscriber
 *
 * @package HkReuter\OxSampleModule\EventSubscriber
 */
class BasketChangedSubscriber implements EventSubscriberInterface
{
    /**
     * @var ContextInterface
     */
    protected $context;

    /**
     * Stop propagation after this handling yes/no.
     *
     * @var bool
     */
    protected $stopPropagation = false;

    /**
     * List of shop model classes and the matching nginx module classes.
     *
     * @var array
     */
    protected $handlers = [];

    /**
     * EventSubscriber constructor.
     *
     * @param bool $stopPropagation Stop event propagation.
     */
    public function __construct($stopPropagation)
    {
        $this->stopPropagation = $stopPropagation;
    }

    /**
     * This is set by the DI container to provide
     * access to the current shop ID to determine
     * if the event should be executed or not.
     *
     * @param ContextInterface $context
     */
    public function setContext(ContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * Handle ApplicationModelChangedEvent.
     *
     * @param \Symfony\Component\EventDispatcher\Event $event Event to be handled
     *
     * @return \Symfony\Component\EventDispatcher\Event
     */
    public function handle(\Symfony\Component\EventDispatcher\Event $event): \Symfony\Component\EventDispatcher\Event
    {
        $basket = $event->getBasket()->render();
        $basketProducts = $basket->getBasketArticles();

        foreach ($basketProducts as $product) {
            $data = [
                'oxsample_counter' => $product->getFieldData('oxsample_counter') + 1
            ];
            $product->assign($data);
            $product->save();
        }

        return $event;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents(): array
    {
        return [
            BasketChangedEvent::NAME => 'handle'
        ];
    }
}