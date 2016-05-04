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
        @mkdir($this->getDataFolder());
        $this->configFile = (new Config($this->getDataFolder()."Config.yml", Config::YAML, array(
                "Knockback_Power" => "4",
                "Level_World" => "world",
                "Damage_Amount" => "5",
        )))->getAll();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $config = $this->getConfig();
        $levelname = $config->get("Level_World");
        $damage = $config->get("Damage_Amount");
        $knockbackpower= $config->get("Knockback_Power");
        $this->getLogger()->info(TextFormat::BLUE."[" . TextFormat::RED . "KnockBack" . TextFormat::BLUE . "]" . TextFormat::GREEN . " Created By >> " . TextFormat::RED . "Skullex");
    }
    
    public function onDisable(){
               $this->getLogger()->info(Color::RED ."has been successfully unloaded!");
    }
    
    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
        if($event instanceof EntityDamageByEntityEvent){
            if($entity->getLevel()->getLevelByName($levelname){
                $fizz = new BlazeShootSound($entity);
                $entity->getLevel()->addSound($fizz);
                $event->getEntity()->setknockBack($knockbackpower);
                $event->getEntity()->setDamage($damage);
            }
        }
    }
}
