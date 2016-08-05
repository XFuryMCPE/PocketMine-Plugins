<?php

namespace xfury\tl;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\level\sound\PopSound;
use pocketmine\level\particle\LavaParticle;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->saveDefaultConfig();
		$this->getServer()->getLogger()->info(TextFormat::GREEN."[TierLoot] Activated!");
	}

	public function onBreak(BlockBreakEvent $e){
		$p = $e->getPlayer();
		$b = $e->getBlock();
		if($e->getBlock()->getId() == 1 && mt_rand(0,$this->getConfig()->get("t1-chance")) == "1"){
			for($i = 0; $i <= 5; $i++){
				$p->getLevel()->addParticle(new LavaParticle($b, 2));
			}
			$p->getLevel()->addSound(new PopSound($p));
			$this->getServer()->broadcastMessage(TextFormat::LIGHT_PURPLE.TextFormat::BOLD."<TL> ".TextFormat::RESET.TextFormat::GREEN.$p->getName().TextFormat::AQUA." found ".TextFormat::BOLD.TextFormat::RED."Tier 1".TextFormat::RESET.TextFormat::AQUA." loot underground!");
			foreach($this->getConfig()->get("t1-loot") as $loot){
				$p->getInventory()->addItem(Item::get($loot,0,mt_rand(0,$this->getConfig()->get("t1-item-max"))));
			}
		}
		if($e->getBlock()->getId() == 1 && mt_rand(0,$this->getConfig()->get("t2-chance")) == "1"){
			for($i = 0; $i <= 8; $i++){
				$p->getLevel()->addParticle(new LavaParticle($b, 2));
			}
			$p->getLevel()->addSound(new PopSound($p));
			$this->getServer()->broadcastMessage(TextFormat::LIGHT_PURPLE.TextFormat::BOLD."<TL> ".TextFormat::RESET.TextFormat::GREEN.$p->getName().TextFormat::AQUA." found ".TextFormat::BOLD.TextFormat::GOLD."Tier 2".TextFormat::RESET.TextFormat::AQUA." loot underground!");
			foreach($this->getConfig()->get("t2-loot") as $loot){
				$p->getInventory()->addItem(Item::get($loot,0,mt_rand(0,$this->getConfig()->get("t2-item-max"))));
			}
		}
		if($e->getBlock()->getId() == 1 && mt_rand(0,$this->getConfig()->get("t3-chance")) == "1"){
			for($i = 0; $i <= 11; $i++){
				$p->getLevel()->addParticle(new LavaParticle($b, 2));
			}
			$p->getLevel()->addSound(new PopSound($p));
			$this->getServer()->broadcastMessage(TextFormat::LIGHT_PURPLE.TextFormat::BOLD."<TL> ".TextFormat::RESET.TextFormat::GREEN.$p->getName().TextFormat::AQUA." found ".TextFormat::BOLD.TextFormat::YELLOW."Tier 3".TextFormat::RESET.TextFormat::AQUA." loot underground!");
			foreach($this->getConfig()->get("t3-loot") as $loot){
				$p->getInventory()->addItem(Item::get($loot,0,mt_rand(0,$this->getConfig()->get("t3-item-max"))));
			}
		}
	}
}
