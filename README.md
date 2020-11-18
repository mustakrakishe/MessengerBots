# MessengerBots
(PHP 7)

## Introduction
This library provides a pure PHP interface for a few messenger bot APIs.  
(2020-11-16 Telegram and Viber bots are available).

## Class synopsis
### Telegram bot
```php
TelegramBot{
    /* Methods */
    public __construct($token, $apiUrl = 'https://api.telegram.org') : object
    public sendText($receiver, $text) : object
    public sendImage($receiver, $image, $caption = null) : object
}
```
#### Methods
`__construct($token, $apiUrl)` - creates a class instance with a bot token `$token` and api url `$apiUrl`;  
`sendText($receiver, $text)` - sends a text `$text` to a Telegram client by his Id `$receiver` (read [sendMessage method](https://core.telegram.org/bots/api#sendmessage)). Returns an object of the request response;  
`sendImage($receiver, $image, $caption)` - sends an image `$image` and its caption `$caption` to a Telegram client by his Id '$receiver' (read [sendPhoto method](https://core.telegram.org/bots/api#sendphoto)). An image can be represented as a global or local file URL. Returns an object of the request response.

### Viber bot
```php
ViberBot{
    /* Methods */
    public __construct($token, $apiUrl = 'https://chatapi.viber.com/pa') : void
    public sendText($receiver, $text) : object
    public sendImage($receiver, $image, $caption = null) : object
    public setName($name) : string
    public getName() : string
    public getAccountInfo() : object
}
```
#### Methods
`__construct($token, $apiUrl)` - creates a class instance with a bot token `$token` and api url `$apiUrl`;  
`sendText($receiver, $text)` - sends a text `$text` to a Telegram client by his Id `$receiver` (read [text message](https://developers.viber.com/docs/api/rest-bot-api/#text-message)). Returns an object of the request response;  
`sendImage($receiver, $image, $caption)` - sends an image `$image` and its caption `$caption` to a Telegram client by his Id '$receiver' (read [picture message](https://developers.viber.com/docs/api/rest-bot-api/#picture-message)).  An image can be represented as a global file URL only. Returns an object of the request response;  
`setName($name)` - sets to a bot a sender name `$name` and returns this one;  
`getName()` - returns a bot sender name;  
`getAccountInfo()` - returns a bot public account info.
    
## Usage
1. Put a folder with a file MessengerBot.php and a file of messenger bot you need to your project.
```
Project
├── MessengerBots
│   ├── MessengerBot.php
│   ├── TelegramBot.php
│   └── ViberBot.php
└── index.php
```

2. Include a messenger bot you need (forexample, Telegram) file to your code and use.  
*index.php:*
```php
include(MessengerBots/TelegramBot.php);
```

3. Create a bot class instance and use it.  
*index.php:*
```php
include(MessengerBots/TelegramBot.php);

$TBot_token = '0000000000:AAAAAAAAAAAA_aaaaaaaaaaaaaaaaaaaaaa';     // initialize your Telegram bot token
$TBot_receiver = '000000000';                                       // initialize your receiver id

$TBot = new TelegramBot($token);                                    // create a new bot class instance
$TBot->sendText($receiver, 'Hi!');                                  // use it
```

## Examples
A project tree looks like:
```
Project
├── MessengerBots
│   ├── MessengerBot.php
│   ├── TelegramBot.php
│   └── ViberBot.php
├── img
│   └── winter.jpg
└── index.php
```

### Example №1 A demonstration of simillary possibilities
```php
// A using messenger bot files are included
include('MessengerBots/TelegramBot.php');
include('MessengerBots/ViberBot.php');

// A send data variables are seted
$text = 'Hello, world! =)';
$image_g = 'https://www.google.com/url?sa=i&url=https%3A%2F%2F112.ua%2Fobshchestvo%2Fukraincev-v-etom-godu-zhdet-teplaya-zima-512015.html&psig=AOvVaw2FPqG6HUdzrQCpZWpQ80ul&ust=1605621949319000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCNj8m4Oeh-0CFQAAAAAdAAAAABAD';
$image_l = 'img/winter.jpg';
$caption = 'It's a winter!';

// Bot service data are seted
$TBot_token = '0000000000:AAAAAAAAAAAA_aaaaaaaaaaaaaaaaaaaaaa';
$TBpt_receiver = '000000000';

$VBot_token = '0a0a0a0a0a0a0a0a-0a0a0a0a0a0a0a0a-0a0a0a0a0a0a0a0a';
$VBot_receiver = 'XXXXXXXXXXXXXXXXXXXXX==';

// A bot instances creating
$TBot = new TelegramBot($TBot_token);
$VBot = new ViberBot($VBot_token);

// Send a text
$TBot->sendText($TB_receiver, $text);
$VBot->sendText($VB_receiver, $text);

// Send an image
$TBot->sendText($TB_receiver, $image_g, $caption);
$TBot->sendText($TB_receiver, $image_l, 'a local image');
$VBot->sendText($VB_receiver, $image_g, $caption);
```

### Example №2 A Viber bot features
```php
// A Viber bot file is included
include('MessengerBots/ViberBot.php');

// Bot service data are seted
$VBot_token = '0a0a0a0a0a0a0a0a-0a0a0a0a0a0a0a0a-0a0a0a0a0a0a0a0a';
$VBot_receiver = 'XXXXXXXXXXXXXXXXXXXXX==';

// Set a sender name
echo $VBot->setName('John');        //John

// Get a sender name
echo $VBot->getName();              //John

//Get a public account info
var_dump($VBot->getAccountInfo());
```
