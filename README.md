# 🧩 AdvancedAutoAnnounce

[![](https://poggit.pmmp.io/shield.state/AdvancedAutoAnnounce)](https://poggit.pmmp.io/p/AdvancedAutoAnnounce)

**AdvancedAutoAnnounce** is a lightweight yet powerful PocketMine-MP plugin that automatically sends customizable broadcast messages to all online players at regular intervals.

Designed for **Minecraft: Bedrock Edition (v1.21.111)** and fully compatible with both **PocketMine API 5 & 6**, it offers smooth automation with zero lag and no manual commands required.

---

## ✨ Features
✅ Automatically broadcast messages every custom interval (default: 60 seconds)  
✅ Fully customizable message list in `config.yml`  
✅ Supports color codes (&a, &b, etc.) and UTF-8 text  
✅ Random or sequential message order  
✅ Works safely with `/reload` or plugin restarts  
✅ No dependencies — pure, optimized PHP  
✅ Zero errors, zero crashes, and lightweight on performance  

---

## ⚙️ Configuration (`config.yml`)
```yaml
interval: 60
prefix: "&b[Server]&r "
broadcast_mode: "random"  # Options: random | sequential
enabled: true

messages:
  - "&aWelcome to our server!"
  - "&eJoin our Discord for updates!"
  - "&6Type &c/help &6for commands and info."
  - "&bEnjoy your stay and have fun!"
