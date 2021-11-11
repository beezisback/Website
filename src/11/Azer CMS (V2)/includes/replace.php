<?php
#- Azer CMS V1.5 Replace System -#
  //Set CopyRight Year
  $cdate = date('Y');
  //Set Anti-Bot
  $code = rand(10000, 90000);
  //Declare News Class
  $news = new news;
  //Declare Shouts Class
  $shouts = new shouts;
  //Declare Realms Class
  $realms = new realms;
  //Declare Vote Class
  $vote = new vote;
  //Declare Char Option Class
  $char_opt = new char_opt;
  //Declare Online Player Class
  $show_online = new online;
  //Declare User Info Class
  $uinfo = new account;
  $uinfo->info();
  //Declare Store Realms Class
  $store_realm = new store_realm;
  //Declare Store Characters Class
  $store_char = new store_char;
  //Declare Store Vote Items Class
  $store_vitems = new store_vitems;
  //Declare Store V.I.P Items Class
  $store_ditems = new store_ditems;
  //Top 10 Class
  $top = new top;
  //Declare Template Class
  $profile = new template_system;
  //Set Replaces
     //Global News System
     $profile->set("news_pages", news_pages());
     //Copyright Date
     $profile->set("copydate", "$cdate");
     //Copyright
     $profile->set("copyright", "$copyr");
     //News Data
     $profile->set("news_posts", $news->news_posts);
     //Site Title
     $profile->set("title", "$site_title");
     //Server Realmlist
     $profile->set("realmlist", "$realmlist");
     //Site Login Function
     $profile->set("log_in", login());
     //Session Display
     $profile->set("session", "$login");
     //Register Function
     $profile->set("register", register());
     //Anti-Bot
     $profile->set("antibot", "$code");
     //Shout Function
     $profile->set("post_shout", shout());
     //Shout View
     $profile->set("view_shouts", $shouts->view_shouts);
     //Shout Url
     $profile->set("shout_url", $shouts->shout_url);
     //Realms View
     $profile->set("view_realms", $realms->view_realms);
     //Realms Online Or Offline?
     $profile->set("realm_world", $realms->realm_world);
     //Realms Total Online
     $profile->set("total_number", $realms->total_number);
     //User Info
     $profile->set("user_get", $uinfo->user_get);
     //User's Site Rank
     $profile->set("user_admin", $uinfo->admin);
     //User's Current IP
     $profile->set("user_curip", $uinfo->curip);
     //User Banned?
     $profile->set("banned", $uinfo->banned);
     //Forgot Password
     $profile->set("forgot_password", forgot());
     //Change Password
     $profile->set("change_password", change_password());
     //Logout
     $profile->set("user_logout", logout());
     //Character Unstuck Realms
     $profile->set("view_realm", $char_opt->view_realm);
     //Character Unstuck Chars
     $profile->set("view_chars", $char_opt->view_char);
     //Unstuck & Revive Character
     $profile->set("unstuck_revive", unstuck_revive());
     //Paypal Email
     $profile->set("paypal_email", "$paypal");
     //Paypal Return Url
     $profile->set("paypal_return", "$p_r_url");
     //Online Players & Realm Name
     $profile->set("online_players", $show_online->show_online);
     $profile->set("realm_name", $show_online->realm_name);
     //View Vote Sites
     $profile->set("view_sites", $vote->view_sites);
     //Vote
     $profile->set("vote", vote_go());
     //Store Realms
     $profile->set("view_realm", $store_realm->view_realm);
     //Store Characters
     $profile->set("view_char", $store_char->view_char);
     //Store Character Db
     $profile->set("char_view_db", $store_char->char_view_db);
     //Store Realm Id
     $profile->set("char_view_id", $store_char->char_view_id);
     //Store Vote Items
     $profile->set("view_vitem", $store_vitems->view_vitem);
     //Store V.I.P Items
     $profile->set("view_ditem", $store_ditems->view_ditem);
     //Store Purchase
     $profile->set("store_purchase", store_purchase());
     //Top 10 PVP
     $profile->set("top", $top->top);
  //Echo Template
  echo $profile->style();
?>