<?php

namespace xfury\races;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\entity\Effect;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class Commands{
	
	public $plugin;

	public function __construct(MainClass $pg){
		$this->plugin = $pg;
	}

	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		$fcmd = strtolower($cmd->getName());
		switch($fcmd){
			case "race":
				if(!$sender instanceof Player){
					$sender->sendMessage(TextFormat::BLUE."[Race] ".TextFormat::RED."Please run this command ingame!");
					return;
				}
				if($this->plugin->hasRace($sender->getName()) == true){
					$sender->sendMessage(TextFormat::BLUE."[Race] ".TextFormat::RED."Your race cannot be changed!");
					return;
				}
				if(count($args) != 1){
					$sender->sendMessage(TextFormat::RED."Usage: /race <runner:jumper:miner>");
					return;
				}
				switch(strtolower($args[0])){
					case "runner":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::BLUE."[Races] ".TextFormat::RED."Are you sure you want to be a runner? Once you select your race, you cannot switch it! Type /race runner again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "runner";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "runner"){
							$sender->sendMessage(TextFormat::BLUE."[Races] ".TextFormat::RED."Are you sure you want to be a runner? Once you select your race, you cannot switch it! Type /race runner again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "runner";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 0);
						$sender->sendMessage(TextFormat::BLUE."[Race] ".TextFormat::GREEN."You are now a runner!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					case "jumper":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::BLUE."[Races] ".TextFormat::RED."Are you sure you want to be a jumper? Once you select your race, you cannot switch it! Type /race jumper again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "jumper";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "jumper"){
							$sender->sendMessage(TextFormat::BLUE."[Races] ".TextFormat::RED."Are you sure you want to be a jumper? Once you select your race, you cannot switch it! Type /race jumper again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "jumper";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 1);
						$sender->sendMessage(TextFormat::BLUE."[Race] ".TextFormat::GREEN."You are now a jumper!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					case "miner":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::BLUE."[Races] ".TextFormat::RED."Are you sure you want to be a miner? Once you select your race, you cannot switch it! Type /race miner again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "miner";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "miner"){
							$sender->sendMessage(TextFormat::BLUE."[Races] ".TextFormat::RED."Are you sure you want to be a miner? Once you select your race, you cannot switch it! Type /race miner again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "miner";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 2);
						$sender->sendMessage(TextFormat::BLUE."[Race] ".TextFormat::GREEN."You are now a miner!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					default:
						$sender->sendMessage(TextFormat::BLUE."Availible races:");
						$sender->sendMessage(TextFormat::GREEN."Runner");
						$sender->sendMessage(TextFormat::GREEN."Jumper");
						$sender->sendMessage(TextFormat::GREEN."Miner");
						$sender->sendMessage(TextFormat::RED."WARNING: Once your race is chosen, you cannot choose it again!");
					break;
				}
			break;
		}
	}
}