<?php

declare(strict_types=1);

namespace Kirtan\AdvancedAutoAnnounce;

use Kirtan\AdvancedAutoAnnounce\Task\AnnounceTask;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase {

    private Config $configData;
    private ?AnnounceTask $announceTask = null;
    private bool $enabled = true;
    private int $index = 0;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        $this->configData = $this->getConfig();
        $this->enabled = (bool)$this->configData->get("enabled", true);
        $this->startAnnouncer();
        $this->getLogger()->info(TF::GREEN . "AdvancedAutoAnnounce enabled successfully!");
    }

    public function onDisable() : void {
        $this->stopAnnouncer();
    }

    private function startAnnouncer() : void {
        $this->stopAnnouncer();
        if(!$this->enabled) return;

        $interval = max(1, (int)$this->configData->get("interval", 60));
        $this->announceTask = new AnnounceTask($this);
        $this->getScheduler()->scheduleRepeatingTask($this->announceTask, $interval * 20);
    }

    private function stopAnnouncer() : void {
        if($this->announceTask !== null) {
            $this->announceTask->getHandler()?->cancel();
            $this->announceTask = null;
        }
    }

    public function getNextMessage() : ?string {
        $messages = (array)$this->configData->get("messages", []);
        if(empty($messages)) return null;

        $mode = strtolower((string)$this->configData->get("broadcast_mode", "random"));
        if($mode === "sequential") {
            $message = $messages[$this->index] ?? $messages[0];
            $this->index = ($this->index + 1) % count($messages);
            return $message;
        }

        // Random mode
        return $messages[array_rand($messages)];
    }

    public function broadcastMessage(string $message) : void {
        $prefix = TF::colorize($this->configData->get("prefix", "&b[Server]&r "));
        $this->getServer()->broadcastMessage(TF::colorize($prefix . $message));
    }

    public function isAnnouncerEnabled() : bool {
        return $this->enabled;
    }
}