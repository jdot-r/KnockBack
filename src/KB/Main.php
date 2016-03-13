<?php

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
    
    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
        $player = $event->getPlayer();
        //Level or Level's in which knockback will be activated! Testing if this will work :P
        if($player->getLevel($this->getConfig()->get("Level")); //Did I do this correctly? :P
        if($event instanceof EntityDamageByEntityEvent){
            $fizz = new BlazeShootSound($entity);
            $entity->getLevel()->addSound($fizz);
            $event->setknockBack($this->getConfig()->get("Power"));
            $event->getPlayer()->sendTip(   Color::GREEN ."You have been launched");
        }
           }
           }
           }
           
           public function onDisable(){
               $this->getLogger()->info(TextFormat::RED ."KnockBack has been successfully unloaded!");
               return true;
           }
