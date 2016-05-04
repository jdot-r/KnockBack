<?php

namespace KB;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Entity;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Level;

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
    }
    
    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
        if($event instanceof EntityDamageByEntityEvent){
            if($entity->getLevel()->getLevelByName($this->yml["Level_World"])){
                $fizz = new BlazeShootSound($entity);
                $entity->getLevel()->addSound($fizz);
                $event->getEntity()->setknockBack($this->yml["Knockback_Power"]);
                $event->getEntity()->setDamage($this->yml["Damage_Level"]);
            }
        }
    }
}
