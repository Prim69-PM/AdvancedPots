<?php

namespace Prim69\AdvancedPots;

use pocketmine\plugin\PluginBase;

use pocketmine\Player;
use pocketmine\entity\projectile\SplashPotion;
use pocketmine\event\Listener;
use pocketmine\event\entity\ProjectileHitBlockEvent;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onHit(ProjectileHitBlockEvent $event){
		$projectile = $event->getEntity();
		if(!$projectile instanceof SplashPotion) return;
		if($projectile->getPotionId() !== 22) return;
		$player = $projectile->getOwningEntity();
		if(!$player) return;
		$distance = $projectile->distance($player);
		if($player instanceof Player && $distance <= 3 && $player->isAlive())
		    $player->setHealth($player->getHealth() + 5);
	}

}
