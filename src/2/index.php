<?php
include('app/db.php');
include('app/functions.php');
?>
<!DOCTYPE html>
<html lang="ru">
   <head>
      <meta charset="utf-8">
      <title>ServerName</title>
      <meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1">
      <link href="css/jquery.fancybox.css" rel="stylesheet">
      <link href="css/animate.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
   </head>
   <body>
      <!-- PRELOADER=============================================--> 
      <div id="preloader">
         <div id="preloader-image"></div>
      </div>
      <div class="wrapper">
         <!-- HEADER=============================================--> 
         <header id="header">
            <section class="section home" id="home">
               <div class="container">
                  <div class="navbar-toggle"> <span class="burger"></span> </div>
                  <div class="slogan"> Игроков онлайн: 200 </div>
                  <nav class="navbar clearfix" role="navigation">
                     <ul class="nav navbar-nav clearfix">
                        <li class="active"> <a href="#home"><span class="text">Главная</span><span class="ico"><img src="images/nav-side.png" alt=""></span></a> </li>
                        <li> <a href="#about"><span class="text">О нас</span><span class="ico"><img src="images/nav-side-03.png" alt=""></span></a> </li>
                        <li> <a href="#classes"><span class="text">Почему прогрессивный?</span><span class="ico"><img src="images/nav-side-04.png" alt=""></span></a> </li>
                        <li> <a href="#why"><span class="text">Почему TBC?</span><span class="ico"><img src="images/nav-side-05.png" alt=""></span></a> </li>
                        <li> <a href="#raids"><span class="text">Рейды</span><span class="ico"><img src="images/nav-side-06.png" alt=""></span></a> </li>
                        <li> <a href="#register"><span class="text">Регистрация</span><span class="ico"><img src="images/nav-side-07.png" alt=""></span></a> </li>
                     </ul>
                     <div class="socials"> <a href="" class="wow bounceInLeft"><img src="images/ico-fb.png" alt=""></a> <a href="" class="wow bounceInRight"><img src="images/ico-tw.png" alt=""></a> <a href="" class="wow bounceInLeft"><img src="images/ico-vk.png" alt=""></a> <a href="" class="wow bounceInRight"><img src="images/ico-yt.png" alt=""></a> </div>
                     <div class="languages wow lightSpeedIn"> <a href="" class="en active"></a> <a href="" class="ru"></a> </div>
                  </nav>
                  <div class="brand"> <a class="logo" href=""><img src="images/logo.png" class="wow swing" alt="logo" role="banner"></a> </div>
                  <div class="video"> <a href="https://www.youtube.com/watch?v=DKYTgHzD9uE" class="various fancybox-media play wow flip"><img src="images/play.png" alt=""></a> </div>
                  <div class="buttons clearfix">
                     <div class="lcol text-left wow bounceInLeft"><a href="#" class="btn scrollTo" data-target="#about">О нас</a></div>
                     <div class="rcol text-right wow bounceInRight"><a href="#" class="btn scrollToForm" data-target="betakey-content">Регистрация</a></div>
                  </div>
               </div>
            </section>
         </header>
         <!-- CONTENT WRAPPER=============================================--> 
         <main id="content-wrapper">
            <section class="section about" id="about">
               <div class="container">
                  <h3 class="section-title wow pulse">О нашем проекте</h3>
                  <article class="section-text wow flipInX">
                     <p>Наша команда в прошлом, как и вы, покоряла и исследовала обширность World of Warcraft. Несколько лет спустя мы снова решили вновь пережить те эмоции и моменты, которые мы испытали во времена дополнения <strong>The Burning Crusade</strong>.</p>
                     <p>Но, к сожалению, мы не смогли найти подходящее место, где мы могли бы вновь пережить все незабываемые моменты и игровой опыт. Поэтому мы решили создать собственный сервер. И теперь, после 5 лет активного развития, мы готовы познакомить вас с нашим проектом.</p>
                     <p>Мы более года работали над ядром и продолжаем активно исправлять ошибки, найденные в игре нашими игроками!</p>
                  </article>
                  <div class="row items">
                     <div class="col wow wobble">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-02.png" alt=""> <img src="images/pref/pref-hov-02.png" class="hov" alt=""> </div>
                           <h4 class="title">Поиск путей</h4>
                           <div class="text">Каждый юнит (существо, NPC, питомец) рассчитывает путь для достижения своей цели, не попадая под текстуры и не проходя через стены.</div>
                        </div>
                     </div>
                     <div class="col wow tada">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-03.png" alt=""> <img src="images/pref/pref-hov-03.png" class="hov" alt=""> </div>
                           <h4 class="title">Поле зрения</h4>
                           <div class="text">Заклинания могут быть использованы, только если цель находится в зоне прямой видимости, это предотвращает случаи, когда вы можете ударить другого игрока через объекты, стены и т. д.</div>
                        </div>
                     </div>
                     <div class="col wow wobble">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-04.png" alt=""> <img src="images/pref/pref-hov-04.png" class="hov" alt=""> </div>
                           <h4 class="title">Античит</h4>
                           <div class="text">С нашим античитом вы можете забыть о читерах, всех тех, кто будет использовать сторонние программы для получения преимущества над другими, их аккаунты будут заблокированы.</div>
                        </div>
                     </div>
                     <div class="col wow tada">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-05.png" alt=""> <img src="images/pref/pref-hov-05.png" class="hov" alt=""> </div>
                           <h4 class="title">Blizzlike транспортная система</h4>
                           <div class="text">Мы первые, кто исправили транспортную систему, похожую на Blizzlike.</div>
                        </div>
                     </div>
                     <div class="col wow wobble">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-06.png" alt=""> <img src="images/pref/pref-hov-06.png" class="hov" alt=""> </div>
                           <h4 class="title">Система поиска групп</h4>
                           <div class="text">Полностью работает, вы сможете присоединиться в группу автоматически.</div>
                        </div>
                     </div>
                     <div class="col wow tada">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-07.png" alt=""> <img src="images/pref/pref-hov-07.png" class="hov" alt=""> </div>
                           <h4 class="title">Автоматическая система резервного копирования</h4>
                           <div class="text">У нас каждый день автоматически создаются резервные копии для того, чтобы не потерять данных об игровом мире. </div>
                        </div>
                     </div>
                     <div class="col wow wobble">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-08.png" alt=""> <img src="images/pref/pref-hov-08.png" class="hov" alt=""> </div>
                           <h4 class="title">DDoS защита</h4>
                           <div class="text">У нас большой опыт защиты серверов, поэтому вы можете быть уверены, что время безотказной работы сервера составит 99,9%.</div>
                        </div>
                     </div>
                     <div class="col wow tada">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-09.png" alt=""> <img src="images/pref/pref-hov-09.png" class="hov" alt=""> </div>
                           <h4 class="title">Хороший пинг</h4>
                           <div class="text">Наши серверы имеют подключение к интернету 1 Gbit/s с ним у вас никогда не возникнет проблем с подключением или задержками.</div>
                        </div>
                     </div>
                     <div class="col wow wobble">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-10.png" alt=""> <img src="images/pref/pref-hov-10.png" class="hov" alt=""> </div>
                           <h4 class="title">Мультиязычная поддержка</h4>
                           <div class="text">Наша команда очень большая, и на данный момент мы предоставляем поддержку на английском и русском языках, не стесняйтесь обращаться к нам, если у вас возникнут проблемы.</div>
                        </div>
                     </div>
                     <div class="col wow tada">
                        <div class="block">
                           <div class="img"> <img src="images/pref/pref-11.png" alt=""> <img src="images/pref/pref-hov-11.png" class="hov" alt=""> </div>
                           <h4 class="title">Реферальная система</h4>
                           <div class="text">Вы можете пригласить своего друга поиграть вместе, что даст вам бонусный маунт и повышенныер рейты.</div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section class="section classes" id="classes">
               <div class="container">
                  <div class="text-block">
                     <h3 class="section-title wow pulse">Почему прогрессивный?</h3>
                     <article class="section-text wow flipInX">
                        <p>Для начала ответим на вопрос: «Что значит Прогрессивный мир?». Это мир, в котором весь PvE-контент становится доступным постепенно, а это означает, что вы не сможете посетить «Черный храм» или «Плато Солнечного Колодца» сразу после открытия сервера. Во-первых, вам придется победить всех боссов предыдущих рейдов, о прогрессе которых вы можете прочитать ниже. Мы верим, что благодаря этому наши игроки смогут почувствовать лучший опыт дополнения «The Burning Crusade».</p>
                     </article>
                  </div>
                  <div class="row">
                     <div class="class-tabs">
                        <ul class="nav-tabs clearfix" role="tablist">
                           <li role="presentation" class="active wow bounceInLeft">
                              <a href="#class-warrior" aria-controls="class-warrior" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-01.png" alt=""> <img src="images/class/class-hov-01.png" class="hov" alt=""> </div>
                                 Воин
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInDown">
                              <a href="#class-hunter" aria-controls="class-hunter" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-02.png" alt=""> <img src="images/class/class-hov-02.png" class="hov" alt=""> </div>
                                 Охотник 
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInLeft">
                              <a href="#class-priest" aria-controls="class-priest" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-03.png" alt=""> <img src="images/class/class-hov-03.png" class="hov" alt=""> </div>
                                 Жрец 
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInUp">
                              <a href="#class-shaman" aria-controls="class-shaman" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-04.png" alt=""> <img src="images/class/class-hov-04.png" class="hov" alt=""> </div>
                                 Шаман
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceIn">
                              <a href="#class-warlock" aria-controls="class-warlock" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-05.png" alt=""> <img src="images/class/class-hov-05.png" class="hov" alt=""> </div>
                                 Чернокнижник
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInUp">
                              <a href="#class-druid" aria-controls="class-druid" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-06.png" alt=""> <img src="images/class/class-hov-06.png" class="hov" alt=""> </div>
                                 Друид
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInLeft">
                              <a href="#class-paladin" aria-controls="class-paladin" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-07.png" alt=""> <img src="images/class/class-hov-07.png" class="hov" alt=""> </div>
                                 Паладин
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInDown">
                              <a href="#class-rogue" aria-controls="class-rogue" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-08.png" alt=""> <img src="images/class/class-hov-08.png" class="hov" alt=""> </div>
                                 Разбойник 
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInRight">
                              <a href="#class-mage" aria-controls="class-mage" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/class/class-09.png" alt=""> <img src="images/class/class-hov-09.png" class="hov" alt=""> </div>
                                 Маг
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="row tabs-row">
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="class-warrior">
                           <div class="class-item"> <img src="images/class/warrior-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/warrior-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/warrior-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="class-hunter">
                           <div class="class-item"> <img src="images/class/hunter-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/hunter-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/hunter-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="class-priest">
                           <div class="class-item"> <img src="images/class/priest-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/priest-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/priest-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="class-shaman">
                           <div class="class-item"> <img src="images/class/shaman-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/shaman-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/shaman-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="class-warlock">
                           <div class="class-item"> <img src="images/class/warlock-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/warlock-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/warlock-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="class-druid">
                           <div class="class-item"> <img src="images/class/druid-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/druid-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/druid-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="class-paladin">
                           <div class="class-item"> <img src="images/class/paladin-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/paladin-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/paladin-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="class-rogue">
                           <div class="class-item"> <img src="images/class/rogue-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/rogue-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/rogue-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="class-mage">
                           <div class="class-item"> <img src="images/class/mage-01.png" alt=""> Tier <span class="numbers">4</span> </div>
                           <div class="class-item"> <img src="images/class/mage-02.png" alt=""> Tier <span class="numbers">5</span> </div>
                           <div class="class-item"> <img src="images/class/mage-03.png" alt=""> Tier <span class="numbers">6</span> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section class="section why" id="why">
               <div class="container">
                  <h3 class="section-title wow pulse">Почему The Burning Crusade?</h3>
                  <article class="section-text wow flipInX">
                     <p>Легендарный патч, завоевавший множество сердец. По мнению многих игроков, он стал лучшим в истории World of Warcraft.</p>
                     <p>The Burning Crusade славится своим балансом между классами, интересными и захватывающими подземельями и рейдами, а также многими другими уникальными и красивыми локациями.</p>
                  </article>
                  <div class="why-items">
                     <div class="col wow bounceInRight">
                        <div class="img"> <img src="images/why/why-01.png" alt=""> <img src="images/why/why-hov-01.png" class="hov" alt=""> </div>
                        <div class="text">Примите участие в 9 рейдах</div>
                     </div>
                     <div class="col wow bounceInRight">
                        <div class="img"> <img src="images/why/why-02.png" alt=""> <img src="images/why/why-hov-02.png" class="hov" alt=""> </div>
                        <div class="text">Максимальный уровень 70</div>
                     </div>
                     <div class="col wow bounceInLeft">
                        <div class="img"> <img src="images/why/why-03.png" alt=""> <img src="images/why/why-hov-03.png" class="hov" alt=""> </div>
                        <div class="text">Реализована система PvP команд</div>
                     </div>
                     <div class="col wow bounceInLeft">
                        <div class="img"> <img src="images/why/why-04.png" alt=""> <img src="images/why/why-hov-04.png" class="hov" alt=""> </div>
                        <div class="text">Летающие маунты</div>
                     </div>
                     <div class="col wow bounceInUp">
                        <div class="img"> <img src="images/why/why-05.png" alt=""> <img src="images/why/why-hov-05.png" class="hov" alt=""> </div>
                        <div class="text">Новые расы Эльф Крови и Дренеи</div>
                     </div>
                     <div class="col wow bounceInDown">
                        <div class="img"> <img src="images/why/why-06.png" alt=""> <img src="images/why/why-hov-06.png" class="hov" alt=""> </div>
                        <div class="text">Новое поле битвы Око Бури</div>
                     </div>
                     <div class="col wow bounceInUp">
                        <div class="img"> <img src="images/why/why-07.png" alt=""> <img src="images/why/why-hov-07.png" class="hov" alt=""> </div>
                        <div class="text">Новый континент Запределье</div>
                     </div>
                  </div>
               </div>
            </section>
            <section class="section raids" id="raids">
               <div class="container">
                  <h3 class="section-title">Примите участие в Рейдах</h3>
                  <div class="row">
                     <div class="raid-tabs">
                        <ul class="nav-tabs clearfix" role="tablist">
                           <li role="presentation" class="active wow bounceInRight">
                              <a href="#raid-karazhan" aria-controls="raid-karazhan" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-01.png" alt=""> <img src="images/raid/raids-hov-01.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInDown">
                              <a href="#raid-zulaman" aria-controls="raid-zulaman" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-02.png" alt=""> <img src="images/raid/raids-hov-02.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInLeft">
                              <a href="#raid-gruul" aria-controls="raid-gruul" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-03.png" alt=""> <img src="images/raid/raids-hov-03.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInUp">
                              <a href="#raid-magtheridon" aria-controls="raid-magtheridon" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-04.png" alt=""> <img src="images/raid/raids-hov-04.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceIn">
                              <a href="#raid-serpentshrine" aria-controls="raid-serpentshrine" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-05.png" alt=""> <img src="images/raid/raids-hov-05.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInUp">
                              <a href="#raid-tempest-keep" aria-controls="raid-tempest-keep" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-06.png" alt=""> <img src="images/raid/raids-hov-06.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInLeft">
                              <a href="#raid-mount-hyjal" aria-controls="raid-mount-hyjal" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-07.png" alt=""> <img src="images/raid/raids-hov-07.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInDown">
                              <a href="#raid-black-temple" aria-controls="raid-black-temple" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-08.png" alt=""> <img src="images/raid/raids-hov-08.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                           <li role="presentation" class="wow bounceInRight">
                              <a href="#raid-sunwell" aria-controls="raid-sunwell" role="tab" data-toggle="tab">
                                 <div class="img"> <img src="images/raid/raids-09.png" alt=""> <img src="images/raid/raids-hov-09.png" class="hov" alt=""> </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="row tabs-row">
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane clearfix active" id="raid-karazhan">
                           <div class="place wow flip">
                              <h3 class="title">Каражан</h3>
                              <img src="images/raid/img-raid-karazhan.png" alt=""> 
                              <div class="text">Медив, Последний Страж, поселился на перевале Мертвого Ветра в светлой башне Каражана. Хотя он был величайшим волшебником своего времени (и предполагаемым хранителем человечества), Медив был тайно одержим темным духом Саргераса, Разрушителя Миров. Через Медив Саргерас открыл Темный Портал и позволил оркам вести войну с королевствами Азерота.</div>
                           </div>
                           <div class="place-raids wow rotateIn">
                              <div class="col">
                                 <img src="images/raid/raid-attumen-the-hunsman.png" alt=""> 
                                 <p>Ловчий Аттумен</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-moroes.png" alt=""> 
                                 <p>Мороуз</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-maiden-of-virtue.png" alt=""> 
                                 <p>Благочестивая дева</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-opera-hall.png" alt=""> 
                                 <p>Мелодия "Оперный театр Каражана"</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-the-curator.png" alt=""> 
                                 <p>Смотритель</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-chess-event.png" alt=""> 
                                 <p>Шахматное событие</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-terestian-illhoof.png" alt=""> 
                                 <p>Терестиан Больное Копыто</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-shade-of-aran.png" alt=""> 
                                 <p>Тень Арана</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-netherspite.png" alt=""> 
                                 <p>Гнев пустоты</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-prince-malchezaar.png" alt=""> 
                                 <p>Принц Малчезар</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-nightbane.png" alt="">
                                 <p>Ночная погибель</p>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix" id="raid-zulaman">
                           <div class="place">
                              <h3 class="title">Зул'Аман</h3>
                              <img src="images/raid/img-raid-zulaman.png" alt=""> 
                              <div class="text">После нескольких лет сражений вместе со старой Ордой, полевой командир троллей Зул'джин удалился в город Зул'Аман, столицу троллей Амани, где он призвал таинственные темные силы восстановить свою армию. В то время как глаза Азерота были сосредоточены на борьбе с Пылающим Легионом и экспедиции на Запределье, искатели сокровищ вторглись в Зул'Аман, разжигая ненависть Зул'джина к внешнему миру - особенно к высшим эльфам Кель'Таласа. </div>
                           </div>
                           <div class="place-raids">
                              <div class="col">
                                 <img src="images/raid/raid-nalorakk.png" alt=""> 
                                 <p>Налоракк</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-akilzon.png" alt=""> 
                                 <p>Акил'зон</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-janalai.png" alt=""> 
                                 <p>Джан'алай</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-halazzi.png" alt=""> 
                                 <p>Халаззи</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-hex-lord-malacrass.png" alt=""> 
                                 <p>Повелитель проклятий Малакрасс</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-zuljin.png" alt=""> 
                                 <p>Зул'Джин</p>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix" id="raid-gruul">
                           <div class="place">
                              <h3 class="title">Логово Груула</h3>
                              <img src="images/raid/img-raid-gruul.png" alt=""> 
                              <div class="text">Когда коварный драконий Аспект Смертокрыл проведал о Темном Портале и Дреноре, он ни минуты не сомневался, что дренорцы едва ли посмеют когда-нибудь перечить черным драконам. А потому он запрятал кладки яиц по всему миру.</div>
                           </div>
                           <div class="place-raids">
                              <div class="col">
                                 <img src="images/raid/raid-high-king-mauglar.png" alt=""> 
                                 <p>Король Молгар</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-grull-the-dragonkiller.png" alt=""> 
                                 <p>Груул Драконобой</p>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix" id="raid-magtheridon">
                           <div class="place">
                              <h3 class="title">Логово Магтеридона</h3>
                              <img src="images/raid/img-raid-magtheridon.png" alt=""> 
                              <div class="text">Поверженного властителя преисподней оставили в живых и заключили в цитадели Адского Пламени. Скованный железными цепями и узами магии, он находится на грани жизни и смерти, а подданные Иллидана каждый день выкачивают проклятую кровь из его вен. На этой крови было выращено целое новое войско – варварские орки Скверны.</div>
                           </div>
                           <div class="place-raids">
                              <div class="col">
                                 <img src="images/raid/raid-magtheridon.png" alt=""> 
                                 <p>Магтеридон</p>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix" id="raid-serpentshrine">
                           <div class="place">
                              <h3 class="title">Змеиновое святилище</h3>
                              <img src="images/raid/img-raid-serpentshrine-cavern.png" alt=""> 
                              <div class="text">Тот, кто контролирует воду, контролирует Запределье. <br> это слова Лорда Иллидана Ярость Бури своему наиболее доверенному лейтенанту, Леди Вайш. Вскоре после Третьей войны, когда Иллидан обратился к ней с просьбой о помощи, группа ответила на его призыв. С тех пор Вайш проявлял яростную преданность Иллидану.</div>
                           </div>
                           <div class="place-raids">
                              <div class="col">
                                 <img src="images/raid/raid-hydros-the-unstable.png" alt=""> 
                                 <p>Гидросс Нестабильный</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-fathom-lord-karathress.png" alt=""> 
                                 <p>Повелитель глубин Каратресс</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-the-lurker-below.png" alt=""> 
                                 <p>Скрытень из глубин</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-morogrim-tidewalker.png" alt=""> 
                                 <p>Морогрим Волноступ</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-leotheras-the-blind.png" alt=""> 
                                 <p>Леотерас Слепец</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-lady-vashj.png" alt=""> 
                                 <p>Леди Вайш</p>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix" id="raid-tempest-keep">
                           <div class="place">
                              <h3 class="title">Крепость Бурь</h3>
                              <img src="images/raid/img-raid-tempest-keep.png" alt=""> 
                              <div class="text">Могущественная Крепость Бурь была создана загадочным наару: живыми существами чистой энергии и заклятыми врагами Пылающего Легиона. Помимо того, что она служит базой операций для наару, сама структура обладает технологией телепортации через альтернативные измерения, перемещаясь из одного места в другое в мгновение ока..</div>
                           </div>
                           <div class="place-raids">
                              <div class="col">
                                 <img src="images/raid/raid-alar.png" alt=""> 
                                 <p>Ал'ар</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-high-astromancer-solarian.png" alt=""> 
                                 <p>Верховный звездочет Солариан</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-void-reaver.png" alt=""> 
                                 <p>Страж Бездны</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-kaelthas-sunstrider.png" alt=""> 
                                 <p>Кель'тас Солнечный Скиталец</p>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix" id="raid-mount-hyjal">
                           <div class="place">
                              <h3 class="title">Битва за гору Хиджал</h3>
                              <img src="images/raid/img-raid-the-battle-for-mount-hyjal.png" alt=""> 
                              <div class="text">В глубине Пещер Времени пробудился задумчивый дракон Ноздорму. С тех пор, как мир был молодым, бронзовый дракон защищал извилистый лабиринт, следя за изменением времени, чтобы обеспечить соблюдение тонкого баланса времени.</div>
                           </div>
                           <div class="place-raids">
                              <div class="col">
                                 <img src="images/raid/raid-rage-winterchill.png" alt=""> 
                                 <p>Лютый Хлад</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-azgalor.png" alt=""> 
                                 <p>Азгалор</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-anetheron.png" alt=""> 
                                 <p>Анетерон</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-archimonde.png" alt=""> 
                                 <p>Aрхимонд</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-kazrogal.png" alt=""> 
                                 <p>Каз'рогал</p>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix" id="raid-black-temple">
                           <div class="place">
                              <h3 class="title">Чёрный Храм</h3>
                              <img src="images/raid/img-raid-black-temple.png" alt=""> 
                              <div class="text">Давным-давно на Дреноре храм Карабор был центром поклонения дренеев. Но набожные священники, которые молились там, давно умерли, убиты мародерствующими, демонически испорченными орками. После резни колдуны Совета Теней захватили здание и присвоили ему новое имя: Черный Храм.</div>
                           </div>
                           <div class="place-raids">
                              <div class="col">
                                 <img src="images/raid/raid-high-warlord-najentus.png" alt=""> 
                                 <p>Верховный полководец Надж'ентус</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-reliquary-of-souls.png" alt=""> 
                                 <p>Реликварий Потерянных</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-supremus.png" alt=""> 
                                 <p>Супремус</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-mother-shahraz.png" alt=""> 
                                 <p>Матушка Шахраз</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-shade-of-akama.png" alt=""> 
                                 <p>Тень Акамы</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-the-illidari-council.png" alt=""> 
                                 <p>Совет иллидари</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-teron-gorefiend.png" alt=""> 
                                 <p>Терон Кровожад</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-illidan-stormrage.png" alt=""> 
                                 <p>Иллидан Ярость Бури</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-gurtogg-bloodboil.png" alt=""> 
                                 <p>Гуртогг Кипящая Кровь</p>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane clearfix" id="raid-sunwell">
                           <div class="place">
                              <h3 class="title">Плато Солнечного Колодца</h3>
                              <img src="images/raid/img-raid-the-sunwell.png" alt=""> 
                              <div class="text">В течение тысячелетий мистический источник энергии, известный как Солнечный Колодец, питал мощную магию изгнанных высших эльфов. Теперь остатки этого древнего фонтана стали последней целью Пылающего Легиона, поскольку демоны готовятся призвать своего командира, Кил'джедена, с помощью энергии Солнечного Колодца.</div>
                           </div>
                           <div class="place-raids">
                              <div class="col">
                                 <img src="images/raid/raid-kalecgos.png" alt=""> 
                                 <p>Калесгос</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-eredar-twins.png" alt=""> 
                                 <p>Эредарские близнецы</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-brutallus.png" alt=""> 
                                 <p>Бруталл</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-muru.png" alt=""> 
                                 <p>М'ууру</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-felmyst.png" alt=""> 
                                 <p>Пророк Скверны</p>
                              </div>
                              <div class="col">
                                 <img src="images/raid/raid-kiljaeden.png" alt=""> 
                                 <p>Кил'джеден</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </main>
         <!-- FOOTER=============================================--> 
         <footer id="footer">
            <section class="section register" id="register">
               <div class="section-panel">
                  <div class="container">
                     <h3 class="section-title wow pulse">Регистрация</h3>
                     <article class="section-text wow flipInY">
                        <p>Стань частью нового мира вместе с нами!</p>
                     </article>
                     <div class="form-content registration-content">
                        <h4 class="section-title"><?php echo REALMLIST; ?></h4>
                        <div class="section-content wow lightSpeedIn">
                           <form method="POST">
                              <div class="row">
                                 <div class="form-group">
                                    <label>Логин:</label> 
                                    <div class="form-control"> <input type="text" required=""> </div>
                                 </div>
                                 <div class="form-group">
                                    <label>Пароль:</label> 
                                    <div class="form-control"> <input type="password" required=""> </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group text-right captcha"> <div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_CLIENT_ID; ?>"></div> </div>
                                 <div class="form-group text-left"> <button type="submit" class="btn btn-green">Войти</button> </div>
                              </div>
                              <div class="row text-center">
                                 <div class="form-link"><a href="" data-target="betakey-content" class="showFormContent">Создать аккаунт</a></div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="form-content betakey-content active">
                        <h4 class="section-title"><?php echo REALMLIST; ?></h4>
                        <div class="section-content wow lightSpeedIn">
                           <form method="POST">
                              <div class="row">
                                 <div class="form-group">
                                    <label>E-mail:</label> 
                                    <div class="form-control"> <input type="text" name="email" required=""> </div>
                                 </div>
                                 <div class="form-group">
                                    <label>Логин:</label> 
                                    <div class="form-control"> <input type="text" name="username" required=""> </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group">
                                    <label>Пароль:</label> 
                                    <div class="form-control"> <input type="password" name="password" required=""> </div>
                                 </div>
                                  <div class="form-group">
                                    <label>Повтор пароля:</label> 
                                    <div class="form-control"> <input type="password" name="re-password" required=""> </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group text-right captcha"> <div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_CLIENT_ID; ?>"></div> </div>
                                 <div class="form-group text-left"> <button type="submit" class="btn btn-green" name="register">Создать аккаунт</button> </div>
                              </div>
                              <div class="row text-center">
                                 <div class="form-link"><a href="" data-target="registration-content" class="showFormContent">У меня уже есть аккаунт</a></div>
                                <div class="response">
                                     <?php Register(); ?>
                                </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="copyrights">
                  <div class="container">
                     <div class="go-forum text-center"><a href="" class="btn">Форум</a></div>
                     <div class="row">
                        <div class="copy" class="wow fadeInUp"> &copy; 2020 Все права защищены. <a href="">ServerName</a> </div>
                     </div>
                  </div>
               </div>
            </section>
         </footer>
      </div>
      <!-- JavaScript скрипты=============================================--> 
	  <script src="js/jquery-2.1.0.min.js"></script> 
	  <script src="js/modernizr.custom.js"></script> 
	  <script src="js/jquery.easing.js"></script> 
	  <script src="js/jquery.fancybox.js"></script>
	  <script src="js/jquery.fancybox-media.js"></script>
	  <script src="js/wow.min.js"></script>
	  <script src="js/tab.js"></script>
	  <script src="js/custom.js"></script>
      <script src="js/vendor/what-input.js"></script>
      <script src="js/vendor/foundation.js"></script>
      <script src="js/app.js"></script>
      <script src='https://www.google.com/recaptcha/api.js'></script>
	  <!--[if lt IE 9]> 
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> 
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	  <![endif]-->
   </body>
</html>