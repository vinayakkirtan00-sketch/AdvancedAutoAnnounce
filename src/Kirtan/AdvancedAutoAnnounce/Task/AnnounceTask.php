<?php

declare(strict_types=1);

namespace Kirtan\AdvancedAutoAnnounce\Task;

use Kirtan\AdvancedAutoAnnounce\Main;
use pocketmine\scheduler\Task;

class AnnounceTask extends Task {

    private Main $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun() : void {
        if(!$this->plugin->isAnnouncerEnabled()) return;

        $message = $this->plugin->getNextMessage();
        if($message !== null) {
            $this->plugin->broadcastMessage($message);
        }
    }
}