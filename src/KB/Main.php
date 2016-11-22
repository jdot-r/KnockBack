<?php

namespace KB;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Entity;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Level;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        @mkdir($this->getDataFolder());
        if(!file_exists($this->getDataFolder(). "/config.yml")){
        $config = new Config($this->getDataFolder()."config.yml", Config::JSON, array(
                "knockback.power" => "4",
                "level" => "world",
                "damage" => "5",
        ))->getAll();
        }
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $config = $this->getConfig();
        $level = $config->get("level");
        $damage = $config->get("damage");
        $knockback = $config->get("knockback.power");
        $this->getLogger()->info(Color::BLUE."[" . Color::RED . "KnockBack" . Color::BLUE . "]" . Color::GREEN . " Created By >> " . Color::YELLOW . "Skullex");
    }
    
    public function onDisable(){
        $this->getLogger()->info(Color::RED ."has been successfully unloaded!");
    }
    
    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
        $damager = $event->getDamager();
        if($event instanceof EntityDamageByEntityEvent){
            if($this->getServer()->getLevelByName === ($this->level) && $damager->getLevel()->getName() === ($this->level)){
                $blaze = new \pocketmine\level\sound\BlazeShootSound($entity);
                $entity->getLevel()->addSound($blaze);
                $event->getEntity()->setknockBack($this->knockback);
                $event->setDamage($this->damage);
            }
        }
    }
}
?>
