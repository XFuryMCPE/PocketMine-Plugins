<?php

namespace xfury\races;

use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;

class RaceTask extends PluginTask{

	public function __construct(MainClass $plugin){
		parent::__construct($plugin);
		$this->plugin = $plugin;
	}

	public function onRun($currentTick){
		foreach($this->plugin->getServer()->getOnlinePlayers() as $p){
			if($this->plugin->hasRace($p->getName()) == false){
				$p->sendMessage(TextFormat::BLUE."[Race] ".TextFormat::RED."Please choose your race with the command /race");
				return;
			}
			if($this->plugin->getRace($p->getName()) == 0){
				$p->setNameTag(TextFormat::RED.$p->getName());
			}
			if($this->plugin->getRace($p->getName()) == 1){
				$p->setNameTag(TextFormat::BLUE.$p->getName());
			}
			if($this->plugin->getRace($p->getName()) == 2){
				$p->setNameTag(TextFormat::GREEN.$p->getName());
			}
		}
	}
}