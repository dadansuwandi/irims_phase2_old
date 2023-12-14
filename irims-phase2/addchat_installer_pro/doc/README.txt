# AddChat Codeigniter Pro

Welcome to AddChat CodeIgniter Pro documentation.

- Read the docs live **[AddChat Pro Docs](https://addchat-codeigniter-pro-docs.classiebit.com)**


### All-in-one multi-purpose Chat Widget For Codeigniter websites

AddChat is a new chatting friend of Codeigniter. It's a standalone Chat widget that uses the website's existing `users` base, and let website users chat with each other. 

You get full source-code, hence AddChat lives and runs on your server/hosting including database. And therefore, you get complete privacy over your data. Either you're a big corporate sector or a small business. AddChat is for everyone.


## Overview

**Addchat Pro** is a chat widget that you can integrate into an existing or a fresh Codeigniter website. AddChat works like a standalone widget and fulfills all your business-related needs like -

1. User-to-user chatting
2. Live real-time chatting (without page refresh)
3. **Internal** notification system (saves **Pusher** monthly subscription fees)
4. Customer support
5. Multi-user groups
6. Guest chatting

and a lot more features, keep reading ⚡️


## Why AddChat ?

Some of the key highlights, why you would like to go with AddChat!

- Save monthly subscription bills (pay once use forever)
- No Confidential Data leak
- Complete Privacy
- Easy to install & update
- Use existing users database
- Multi-purpose, use it as Helpdesk, Customer support, User-to-user chatting and much more...

---

AddChat never modifies your existing database tables or records. And it never breaks down any of your website functionality.

---

AddChat is fully tested and ready to be used in production websites. 

---


## Technical Specification

AddChat is very light, high performance, scalable and secure.

1. AddChat front-end built with **VueJs**, which is purely API based web-app.

2. AddChat back-end (API) built with **CodeIgniter**

    - **AddChat Codeigniter** version comes with an installer, which auto-install AddChat in an existing or a fresh Codeigniter website



## User Interface & Design

AddChat is designed in **CSS Flexbox** and **Sass**. Let's see what's so special about **CSS Flexbox** and why we used it.

1. AddChat is a CSS Framework Independent. Means, no matter in which CSS Framework your website is in, it neither affects the website CSS nor gets affected by it.

    - [Bootstrap](https://getbootstrap.com/) 
    - [Bulma](https://bulma.io/) 
    - [Materializecss](https://materializecss.com/) 
    - [Semantic UI](https://semantic-ui.com/) 
    - [UIKit](https://getuikit.com/) 
    - [Zurb Foundation](https://foundation.zurb.com/) 

    or any other...

2. AddChat CSS is completely encapsulated (wrapped in AddChat wrapper with `#addchat-bot .c-` prefix).
    - Hence, it never override your website CSS nor inherits from it.

    - AddChat UI is extra-responsive. Optimized for **extra-small** devices to large **4K desktops** -

        * Small phones
        * Android Phones
        * iPhones
        * iPad & iPad Pro
        * Small-Medium Size Laptops
        * Large Desktops

3. We've used the popular **NPM** package `auto-prefixer` to make the AddChat UI design same across all types of browsers e.g `Chrome, Firefox, Safari, Edge` etc



## Multi-regional

AddChat is compatible with all languages and timezones. AddChat auto adapts and adjust regional settings according to your website's default timezone and language. Please refer to the Language section for more info about **adding a new language** in 
[AddChat CodeIgniter](https://addchat-codeigniter-pro-docs.classiebit.com/docs/1.0/admin/multi-language-codeigniter)

--- 

AddChat never breaks any of your website functionality, even if something went wrong with AddChat, there are `fallback modes` for every worst-case scenario.

---


## Pro Version

---

This is AddChat Codeigniter Pro version documentation

---

**AddChat Pro Version** comes with **Commercial** license. Pro version is fully loaded with a lot of useful and exciting features.

- **AddChat CodeIgniter Pro**

    + [Live (addchat-codeigniter-pro.classiebit.com)](https://addchat-codeigniter-pro.classiebit.com) - Visit pro version live.
    + [Purchase (addchat-codeigniter-pro)](https://classiebit.com/addchat-codeigniter-pro) - Purchase pro version here.



# Codeigniter Installation

AddChat CodeIgniter Pro comes with an installer that makes the installation process fully automated and smooth 🍻


## Server Requirements

* PHP version **5.6** or newer is recommended.
* Make sure **.htaccess** is enabled.
* CodeIgniter website with an **Authentication** (user-login) system. 


## Remember

* The website directory must have proper **write** permissions e.g `sudo chown -R :www-data yourwebsite`
* Change CSRF regenerate to `FALSE` in `application/config/config.php` `$config['csrf_regenerate'] = false`


## Install

1. Download & Unzip the package.
2. Copy the **addchat_installer_pro** folder and paste it into your website root directory.
3. After doing so, your website directory will look like this.

    ```bash

    yoursite.com
    │
    ├── addchat_installer_pro
    ├── application
    ├── system
    │
    ├── ..
    ├── ..
    ├── ..
    │
    ├── .htaccess
    └── index.php

    ```

4. Visit `yoursite.com/addchat_installer_pro` to run the installer. 


---

Make sure **.htaccess** files exist and not hidden.

---

Do not forget to delete the **addchat_installer_pro** folder after successful installation.

---

## Installer Instructions

#### Database

- Enter your website's existing database credentials.

#### Assets

- Enter your website assets folder path.

#### Config

- Enter your website config folder path. e.g `application/config`
- Enter **LOGGED-IN USER-ID SESSION KEY NAME** e.g user_id

---

The $_SESSION variable key name in which your application stores the logged-in user id e.g $_SESSION['user_id'] then the key is **user_id**

---


#### Application

- Enter **Controllers** Folder Path e.g `application/controllers`
- Enter **Libraries** Folder Path e.g `application/libraries`
- Enter **English Language** Folder Path e.g `application/language/english`


#### License Code

- You'll need to enter the license code to complete the installation process.

---

Remember, one license code is valid for one domain only. Contact support for more details.

---

And finally click install to start the installation process.

---


### After successful installation, you need to do one simple step manually.

1. Open the common layout file, mostly the common layout file is the file which contains the HTML & BODY tags.

    - Copy AddChat CSS code and paste it right before closing **&lt;/head&gt;** tag

        ```php
        <!-- 1. Addchat css -->
        <link href="<?php echo base_url('assets/addchat/css/addchat.min.css') ?>" rel="stylesheet">
        ```
    
    - Copy AddChat Widget code and paste it right after opening **&lt;body&gt;** tag

        ```php
        <!-- 2. AddChat widget -->
        <div id="addchat_app" 
            data-baseurl="<?php echo base_url() ?>"
            data-csrfname="<?php echo $this->security->get_csrf_token_name() ?>"
            data-csrftoken="<?php echo $this->security->get_csrf_hash() ?>"
        ></div>
        ```

    - Copy AddChat JS code and paste it right before closing **&lt;/body&gt;** tag

        ```php
        <!-- 3. AddChat JS -->
        <!-- Modern browsers -->
        <script type="module" src="<?php echo base_url('assets/addchat/js/addchat.min.js') ?>"></script>
        <!-- Fallback support for Older browsers -->
        <script nomodule src="<?php echo base_url('assets/addchat/js/addchat-legacy.min.js') ?>"></script>
        ```

    #### The final layout will look something like this

    ```php
    <head>

        <!-- **** your site other content **** -->

        <!-- 1. Addchat css -->
        <link href="<?php echo base_url('assets/addchat/css/addchat.min.css') ?>" rel="stylesheet">

    </head>
    <body>

        <!-- 2. AddChat widget -->
        <div id="addchat_app" 
            data-baseurl="<?php echo base_url() ?>"
            data-csrfname="<?php echo $this->security->get_csrf_token_name() ?>"
            data-csrftoken="<?php echo $this->security->get_csrf_hash() ?>"
        ></div>


        
        <!-- **** your site other content **** -->



        <!-- 3. AddChat JS -->
        <!-- Modern browsers -->
        <script type="module" src="<?php echo base_url('assets/addchat/js/addchat.min.js') ?>"></script>
        <!-- Fallback support for Older browsers -->
        <script nomodule src="<?php echo base_url('assets/addchat/js/addchat-legacy.min.js') ?>"></script>

    </body>
    ```

---

Replace the `assets` by your website's assets path.

---

`addchat.min.js` for modern browsers & `addchat-legacy.min.js` for older browsers. These will be used switched by the browsers automatically on the basis on `type="module"` & `nomodule`, you need to nothing.

---

Setup finishes here, now heads-up straight to **[Settings](https://addchat-codeigniter-pro-docs.classiebit.com/docs/1.0/admin/settings)** docs