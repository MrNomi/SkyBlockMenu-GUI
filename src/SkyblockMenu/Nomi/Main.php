<?php

namespace SkyblockMenu\Nomi;

//Basic Class 
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

//Guis Class 
use pocketmine\scheduler\ClosureTask;
use libs\muqsit\invmenu\InvMenu;
use libs\muqsit\invmenu\InvMenuHandler;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;

//Command Class 
use pocketmine\command\Command;
use pocketmine\command\Commandsender;

//Sound Class 
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelEventPacket;

//Others class 
use onebone\economyapi\EconomyAPI;

//Item
use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\item\Armor;

class Main extends PluginBase implements Listener {

	public function onEnable(){

		$this->economyAPI = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
    
    $this->saveResource("config.yml");

		$this->getLogger()->info("Plugin By Mr Nomi enabled");

		$this->mainmenu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);

		

		if(!InvMenuHandler::isRegistered()){

			InvMenuHandler::register($this);

		}

		    $this->getServer()->getPluginManager()->registerEvents($this, $this);
		    $this->getConfig();
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder()."config.yml", Config::YAML);
       }

	public function onDisable(){

		$this->getLogger()->info("Plugin is disabled..");

	}

   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){
        	case "skyblockmenu":
        		if(!$sender instanceof Player){
        			$sender->sendMessage("§c§l> §r§7Please run this command in-game -_-");
        			return false;
        		}
             if(!$sender->hasPermission("skyblockmenu.open.menu")){
             	$sender->sendMessage("§c§l> §r§7You don't have permission to use this command!");
             	$volume = mt_rand();
	          $sender->getLevel()->broadcastLevelEvent($sender, LevelEventPacket::EVENT_SOUND_ANVIL_FALL, (int) $volume);
             }
             $this->menu($sender);
             break;
        }
             return true;
	}
	public function menu($sender)
	{
	    $this->mainmenu->readonly();
	    $this->mainmenu->setListener([$this, "menu1"]);
      $this->mainmenu->setName("Skyblock Menu");
	    $inventory = $this->mainmenu->getInventory();
	    $inventory->setItem(0, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(1, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(2, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(3, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(4, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(5, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(6, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(7, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(8, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(9, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(10, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(11, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(12, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(13, Item::get(397, 3, 1)->setCustomName("§r§eYour Profile\n§c§l❤️ Health §r§f".$sender->getHealth()." HP\n§a§l❈ §r§dDefense §r§f".$sender->getArmorPoints()." \n§d§l⚘ §r§dFood ".$sender->getFood()." \n§a§l⚠ §r§aPing §f".$sender->getPing()." §fMS\n§r§b§l☯ §r§bExperience §f".$sender->getXpLevel()." Lvl\n§r§9§l⛇ §r§9Size §f".$sender->getScale()));
	    $inventory->setItem(14, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(15, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(16, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(17, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(18, Item::get(101, 0, 1)->setCustomName("§r"));	    
	    $inventory->setItem(19, Item::get(276, 0, 1)->setCustomName("§r§l§eSkills\n\n§r§7(Right-Click)"));
	    $inventory->setItem(20, Item::get(321, 0, 1)->setCustomName("§r§l§eCollection\n\n§r§7(Right-Click)"));
	    $inventory->setItem(21, Item::get(340, 0, 1)->setCustomName("§r§l§eCustom Recipes\n\n§r§7(Right-Click)"));
	    $inventory->setItem(22, Item::get(388, 0, 1)->setCustomName("§r§l§eTrade\n\n§r§7(Right-Click)"));
	    $inventory->setItem(23, Item::get(386, 0, 1)->setCustomName("§r§l§eQuest\n\n§r§7(Right-Click)"));
	    $inventory->setItem(24, Item::get(347, 0, 1)->setCustomName("§r§l§eEvents\n\n§r§7(Right-Click)"));
	    $inventory->setItem(25, Item::get(130, 0,1)->setCustomName("§r§l§eEnder Chest\n\n§r§7(Right-Click)"));
	    $inventory->setItem(26, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(27, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(28, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(29, Item::get(373, 0,1)->setCustomName("§r§l§ePotions\n\n§r§7(Right-Click)"));
	    $inventory->setItem(30, Item::get(352, 0, 1)->setCustomName("§r§l§ePets\n\n§r§7(Right-Click)"));
	    $inventory->setItem(31, Item::get(58, 0, 1)->setCustomName("§r§l§eWork Bench\n\n§r§7(Right-Click)"));
	    $inventory->setItem(32, Item::get(299, 0, 1)->setCustomName("§r§l§eWardrobe\n\n§r§7(Right-Click)"));
	    $inventory->setItem(33, Item::get(41, 0, 1)->setCustomName("§r§l§eBank\n\n§r§7(Right-Click)"));
	    $inventory->setItem(34, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(35, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(36, Item::get(397, 1, 1)->setCustomName("§r§l§eProfile\n\n§r§7(Right-Click)"));
	    $inventory->setItem(37, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(38, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(39, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(40, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(41, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(42, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(43, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(44, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(45, item::get(345, 0, 1)->setCustomName("§r§l§eTravel Island\n\n§r§7(Right-Click)"));
	    $inventory->setItem(46, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(47, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(48, Item::get(421, 0, 1)->setCustomName("§r§l§eSkyblock Menu\n\n§r§7By Mr Nomi"));
	    $inventory->setItem(49, Item::get(-161, 0, 1)->setCustomName("§r§l§cClose"));
	    $inventory->setItem(50, Item::get(76, 0, 1)->setCustomName("§r§l§eIsland Settings\n\n§r§7(Right-Click)"));
	    $inventory->setItem(51, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(52, Item::get(101, 0, 1)->setCustomName("§r"));
	    $inventory->setItem(53, Item::get(467, 0, 1)->setCustomName("§r§l§eFast Travel\n\n§r§7(Right-Click)"));
	    
	    $this->mainmenu->send($sender);
	}
	public function menu1(Player $sender, Item $item)
	{
	      $hand = $sender->getInventory()->getItemInHand()->getCustomName();
        $inventory = $this->mainmenu->getInventory();
        $config = new Config($this->getDataFolder()."config.yml", Config::YAML);

     if($item->getCustomName() === "§r§l§cClose"){
		$sender->removeWindow($inventory);
		$sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_CLOSED);
	}
	if($item->getCustomName() === "§r§l§eSkills\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("skill"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eCustom Recipes\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("recipes"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eTrade\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("trade"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eQuest\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("quest"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eEvents\n\n§r§7(Right-Click)"){
		$sender->removeWindow($inventory);
            		    $this->getServer()->dispatchCommand($sender, $config->get("event"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eEnder Chest\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("ender_chest"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§ePotions\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("potions_shop"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§ePets\n\n§r§7(Right-Click)"){
		$sender->removeWindow($inventory);
            		    $this->getServer()->dispatchCommand($sender, $config->get("pets"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eWork Bench\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("craft"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eWardrobe\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("wardrobe"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eBank\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("bank"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eTravel Island\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("island"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eFast Travel\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("fast_travel"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eIsland Settings\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("island_settings"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
	if($item->getCustomName() === "§r§l§eProfile\n\n§r§7(Right-Click)"){
        $sender->removeWindow($inventory);
                    $this->getServer()->dispatchCommand($sender, $config->get("profile"));
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_OPEN);
    }
  }
}