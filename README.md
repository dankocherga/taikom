# TaiKom
TaiKom Telegram Bot

## Available commands
Currently bot supports the following commands:
* `/meme` — send "me-me-me" audio
* `/bebe` — send "be-be-be" audio

## Launching bot
1. Download source
2. Run `composer install`
3. Copy `etc/taikon.json.template` to `etc/taikom.json` and put your bot token inside
4. Create writeable `var` directory
5. Execute `php bin/run.php`

## Extending bot

Add new command classes to `Taikom/Command/Custom` directory. Commands are matched by names (see [meme](https://github.com/dankocherga/taikom/blob/master/src/Taikom/Command/Custom/Meme.php) as example)
