# TaiKom
TaiKom Telegram Bot

## Available commands
Currently bot supports the following commands:
* `/meme` — send "me-me-me" audio
* `/bebe` — send "be-be-be" audio

## Launching bot
1. Download source
2. Run `composer install`
3. Copy `taikon.json.template` to `taikom.json` and put your bot token inside
4. Create writeable `var` directory
5. Execute `php taikom.php`

## Extending bot

Add new command classes to `Taikom/Command/Custom` directory. Commands are matched by names (see [meme](https://github.com/dankocherga/taikom/blob/master/Taikom/Command/Custom/Meme.php) as example)
