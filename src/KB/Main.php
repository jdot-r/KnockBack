<?php

namespace KB;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Entity;
use pocketmine\utils\TextFormat;

class KnockBack extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onLoad(){
        $this->getLogger()->info(TextFormat::BOLD."KnockBack by Skullex enabled :D");
    }

            public function onDamage(EntityDamageEvent $event){
            $entity = $event->getEntity();
            $player = $event->getPlayer();
            if($event instanceof EntityDamageByEntityEvent){
          $fizz = new BlazeShootSound($entity);
          $entity->getLevel()->addSound($fizz);
      if($entity->getDirection() == 0){
        $entity->knockBack($entity, 0, 1, 0, 1);
      }
      elseif($entity->getDirection() == 1){
        $entity->knockBack($entity, 0, 0, 1, 1);
      }
      elseif($entity->getDirection() == 2){
        $entity->knockBack($entity, 0, -1, 0, 1);
      }
      elseif($entity->getDirection() == 3){
        $entity->knockBack($entity, 0, 0, -1, 1);
      }    
$player->sendTIP("You have been launched");
    }
}

    public function onDisable(){
        $this->getLogger()->info(TextFormat::RED."KnockBack by Skullex disabled D:");
        return true;
    }
}
