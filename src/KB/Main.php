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
        $this->config = new Config($this->getDataFolder."Config.yml", Config::YAML);
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
        //Level or Level's in which knockback will be activated! Testing if this will work :P
        if($event instanceof EntityDamageByEntityEvent){
            //if($player->getLevel()->getName() == $this->getConfig()->get('world')){
                if($player->getLevel()->getLevelByName($this->yml["Level_World"])){
                $fizz = new BlazeShootSound($entity);
                $entity->getLevel()->addSound($fizz);
                $event->getEntity()->setknockBack($this->getConfig()->get("Knockback_Power"));
        }
    }
}
