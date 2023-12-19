<?php

\routes\Router::add('^admin/?$', ['controller' => 'Admin', 'action'=>'index', 'admin_prefix'=> 'admin']);
\routes\Router::add('^admin/(P<controller>[a-z-]+)/?(?P<action>[a-z_]+)?$', ['admin_prefix'=>'admin']);
\routes\Router::add('^$', ['controller' => 'Index', 'action'=>'index']);
\routes\Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z_]+)?$');