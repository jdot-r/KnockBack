<?php

/*
* Author: Skull3x
* Open project
*/

namespace KB;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\level\sound\BlazeShootSound;

use pocketmine\event\entity\EntityDamageByEntityEvent;

use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\Entity;

use pocketmine\utils\TextFormat as Color;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
    }
    
    public function onLoad(){
        $this->getLogger()->info(Color::GREEN ."KnockBack has been successfully loaded!");
    }
    
    public function onDisable(){
               $this->getLogger()->info(TextFormat::RED ."KnockBack has been successfully unloaded!");
               return true;
    }
    
    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
        if($event instanceof EntityDamageByEntityEvent){
            if($player->getLevelByName($this->yml["Level_World"])){
                $fizz = new BlazeShootSound($entity);
                $entity->getLevel()->addSound($fizz);
                $event->getEntity()->setknockBack($this->getConfig()->get("Knockback_Power"));
            }
        }
    }
}
