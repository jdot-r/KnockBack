<?php

/*
* Author: Skull3x
* Open project to edits in seperate repositories and bug fixes in the current one
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
               $this->getLogger()->info(Color::RED ."KnockBack has been successfully unloaded!");
               return true;
    }
    
    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
        if($event instanceof EntityDamageByEntityEvent){
            if($entity->getLevelByName($this->yml["Level_World"])){
                $fizz = new BlazeShootSound($entity);
                $entity->getLevel()->addSound($fizz);
                $event->setknockBack($this->yml["Knockback_Power"]);
                $event->setDamage($this->yml["Damage_Level"]);//$event->getDamage()+10); I would use that but I want it to be up to you xP
            }
        }
    }
}
