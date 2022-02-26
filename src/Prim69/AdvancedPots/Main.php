<?php

namespace Prim69\AdvancedPots;

use pocketmine\plugin\PluginBase;

use pocketmine\player\Player;
use pocketmine\entity\projectile\SplashPotion;
use pocketmine\event\Listener;
use pocketmine\item\PotionType;
use pocketmine\event\entity\ProjectileHitBlockEvent;

class Main extends PluginBase implements Listener{

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onHit(ProjectileHitBlockEvent $event){
		$projectile = $event->getEntity();
		if($projectile instanceof SplashPotion && $projectile->getPotionType() === PotionType::STRONG_HEALING()){
			$player = $projectile->getOwningEntity();
			if($player instanceof Player && $player->isAlive() && $projectile->getPosition()->distance($player->getPosition()) <= 3){
				$player->setHealth($player->getHealth() + 5);
			}
		}
	}

}
