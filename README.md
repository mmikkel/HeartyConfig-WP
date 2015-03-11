# Hearty Config for Wordpress

This is a multi-environment config boilerplate for Wordpress. It's a toolset, not a plugin.

Latest version is **1.0**.

## What does Hearty Config do?

* Hearty increases *portability* by making your site and home URLs dynamic
* Hearty makes it trivial to define different settings for different environments (i.e. _dev_, _stage_, _prod_ etc)
* Hearty makes it easy for team members to have their own settings/configs for their individual, local install
* Hearty increases security by encouraging and enabling renaming and relocating core folders (i.e. wp-content)
* Hearty includes a set of useful – but optional – utility classes for wrestling Wordpress into submission
* Hearty makes it easier to manage plugins by enabling renaming and relocating of the standard /wp-content/plugins folder (if only this was possible for the themes folder, as well...
* Hearty includes an extremely basic starter theme
* Hearty loves [Timber](http://upstatement.com/timber/)

## Installation & setup

One of these days, I'll write a more thorough guide, but for now these are the important things:

1. Your different environments should be declared in the **$heartyEnvs** array in _hearty.php_.

Hearty works by comparing the current request's hostname to array of environment keys and URLs in hearty.php. If a matching environment is found, Hearty will attempt to load that environment's config file in /config/{$environmentKey}.php.

The exception is local dev – if Hearty finds a file called **/config/local.php**, local environment is _automatically assumed_. 

_It's a very good idea to gitignore the local.php file – making it easy for all team members to have their own, local settings._

2. The /config folder contains both Hearty's _master_ config file (which in most cases you won't have to edit) and your different environment config files such as local.php, dev.php or prod.php.

3. Hearty's **wp-config.php** file should replace your existing one. In most cases it will be enough to put this file in your public root, but if you symlink your core folder you'll often need to require it from the vanilla wp-config.php file.

### Important note about the core Wordpress folder

_Hearty is not distributed with the core files_, so you'll need to download Wordpress and put it in your public root to make stuff happen.

Note that Hearty will assume that your core Wordpress catalog has been renamed to _core_. If you want it to be called something else – i.e. _wordpress_ - you can change it in hearty.php.

### Disclaimer

Hearty Config is offered free of charge, and you can do whatever you want with it. Really, _whatever_. Take it to town.

The author is _not responsible_ for data loss or any other issues or problems resulting from the use of Hearty Config.

**Pull requests and bug reports are very welcome.**