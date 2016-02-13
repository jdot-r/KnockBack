<?php

namespace KB;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\event\player\EntityDamageEvent;
use pocketmine\event\player\EntityDamageByEntityEvent;

class KnockBack extends PluginBase implements Listener {

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

	public function onLoad(){
		$this->getLogger()->info("KnockBack §aenabled");
	}

    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
    if($event instanceof EntityDamageByEntityEvent){
        $event->setKnockBack(1,0,1);
        $fizz = new BlazeShootSound($entity);
        $entity->getLevel()->addSound($fizz);
}

    public function onDisable(){
        $this->getLogger()->info("KnockBack §cdisabled.");
        return true;
   	}
}
