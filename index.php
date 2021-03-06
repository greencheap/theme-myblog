<?php

use GreenCheap\MyBlog\Bootstrap;

return [
    "name" => "myblog",

    "main" => function ($app) {
        $app["theme_blog"] = new Bootstrap();
    },

    "autoload" => [
        "GreenCheap\\MyBlog\\" => "src",
    ],

    "menus" => [
        "main" => "Main",
        "others" => "Others",
    ],

    "positions" => [
        "navbar" => "Navbar Right",
        "navbar-vertical" => "Navbar Left",
        "top" => "Top",
        "sidebar" => "Sidebar",
        "bottom" => "Bottom",
        "footer" => "Footer",
    ],

    "node" => [
        "section" => "uk-section uk-section-default",
        "container" => "uk-container",
        "sectionSize" => "",
        "sectionImage" => "",
        "contentAlign" => "",
        "titleHide" => false,
        "titleDomElement" => "h1",
        "titleColor" => "",
        "titleClass" => "",
    ],

    "widget" => [
        "onHeightViewport" => false,
        "heights" => [
            "offset-bottom" => 20,
            "offset-top" => 0,
        ],
        "section" => "uk-section uk-section-default",
        "sectionSize" => "",
        "sectionImage" => "",
        "contentAlign" => "",
        "titleHide" => false,
        "titleDomElement" => "h1",
        "titleColor" => "",
        "titleClass" => "",
    ],

    "events" => [
        "view.system/site/admin/edit" => function ($event, $view) use ($app) {
            $view->script("node-theme", "theme:app/bundle/node-theme.js", "site-edit");
        },

        "view.system/widget/edit" => function ($event, $view) {
            $view->script("widget-theme", "theme:app/bundle/widget-theme.js", "widget-edit");
        },

        "view.scripts" => function ($event, $scripts) {
            $scripts->register("blog-theme", "theme:app/bundle/blog-theme.js", "~post-edit");
        },

        "view.layout" => function ($event, $view) use ($app) {
            if ($app->isAdmin()) {
                return;
            }
            $params = $view->params;
            $userConfig = $app["config"]->get("system/user");
            $params["registration_permit"] = $userConfig->get("registration") != "admin" && $app["user"]->isAnonymous() ? true : false;
        },
    ],
];
