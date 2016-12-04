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
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        if(!(file_exists($this->getDataFolder(). "/config.json"))){
            $config = new Config($this->getDataFolder()."/config.json", Config::JSON, array(
                "knockback.power" => "4",
                "level" => "world",
                "damage" => "5"));
        }
        $this->saveDefaultConfig();
        $config = $this->getConfig();
        return $config;
    }
    
    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
        $damager = $event->getDamager();
        $config = $this->getConfig();
        $level = $config->get("level");
        $damage = $config->get("damage");
        $knockback = $config->get("knockback.power");
        if($event instanceof EntityDamageByEntityEvent){
            if($this->getServer()->getLevelByName === ($level) && $damager->getLevel()->getName() === ($level)){
                $blaze = new \pocketmine\level\sound\BlazeShootSound($entity);
                $entity->getLevel()->addSound($blaze);
                $event->getEntity()->setknockBack($knockback);
                $event->setDamage($damage);
            }
        }
    }
}
?>
