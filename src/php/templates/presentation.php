<div class="jumbotron jumbotron-page rounded-0">
    <h1 class="display-3">Custodia</h1>
    <p class="lead">Présentation l'APP RSOC 2020 à Polytech Annecy</p>
</div>

<div class="container margin-top-50">

    <section>
        <h2 class="font-muli font-weight-bold">Custodia, qu'est-ce que c'est ?</h2>
        <hr>

        <p class="text-justify"><span class="font-weight-bold">Custodia</span> est un projet de télésurveillance
            robotisée avec objets
            connectés.
            Il s'inscrit dans le cadre des projets APP de Polytech Annecy-Chambéry. Le but de notre projet est simple :
            mettre en place une interaction entre un robot de surveillance et des objets connectés, comme des capteurs.
            Le robot doit naviguer en autonomie dans une pièce, elle-même équipée de capteurs.</p>

        <p class="text-justify"> Quand un capteur renvoie une donnée jugée anormale, le robot se déplace vers le
            capteur, et il est possible d'observer ce qu'il se passe à l'aide d'une caméra placée sur le robot. Les
            données des capteurs sont disponibles sur un site web. Il est également possible de contrôler le robot via
            l'interface web</p>

        <p>Nos compte-rendus sont disponibles ici :</p>
        <ul>
            <li><a href="public/pdf/CR_Mai_2018.pdf" target="_blank">Mai 2018</a></li>
            <li><a href="public/pdf/CR_Janvier_2019.pdf" target="_blank">Janvier 2019</a></li>
        </ul>
    </section>

    <section class="text-justify">
        <h2 class="font-muli font-weight-bold">Le matériel utilisé</h2>
        <hr>

        <h4 class="text-uppercase font-weight-bold">Robotino</h4>
        <p class="mb-5">Tout au long de notre projet, nous utilisons Robotino comme support matériel</p>
        <div class="text-center">
            <img class="img-fluid mb-5" src="public/img/robotino.png" alt="Robotino">
        </div>
        <p>Robotino est un système robotique mobile dispoosant d'un système de déplacement
            omnidirectionnel permettant
            de se déplacer dans toutes les directions. Il est muni de plusieurs types de capteurs (analogiques, binaires
            et numériques) et dispose de différents ports permettant de raccorder des capteurs et actionneurs
            supplémentaires.</p>
        <p>Robotino dispose d'un ordinateur de bord avec le système d'exploitation Ubuntu. La
            programmation de ce robot est possible dans différents langages (Java, C++). Dans notre cas, nous le
            programmons en Java. Ce robot est très utilisé dans des formations d'informatique et de robotique. Il permet
            principalement d'apprendre à programmer complètement un robot. Lors de ce projet, nous avons choisi Robotino
            pour sa flexibilité et sa simplicité de programmation.</p>

        <h4 class="text-uppercase font-weight-bold mt-5">Le microcontrôleur ESP8266</h4>
        <p>Pour faire communiquer tous nos capteurs ensemble, nous avons choisi d'utilisateur la carte électronique
            programmable ESP8266 NodeMCU fabriquée par le constructeur chinoius Espressif</p>
        <div class="text-center">
            <img class="img-fluid mb-5" src="public/img/esp8266.png" alt="ESP8266" width="300px">
        </div>
        <p>Cette carte est très utile pour notre projet : elle est compacte, possède un module Wifi intégré pour
            communiquer, et peut se programme sous l'IDE Arduino. Il est cependant nécessaire d'ajouter une librairie
            pour pouvoir utiliser cette carte. Pour le reste, elle se programme comme Arduino.</p>

        <h4 class="text-uppercase font-weight-bold mt-5">Le capteur de température et d'humidité DHT11</h4>
        <p>Pour mesurer la température et l'humidité dans une pièce, nous travaillons avec le capteur DHT11.</p>
        <div class="text-center">
            <img class="img-fluid mb-5" src="public/img/dht11.jpg" alt="DHT11" width="200px">
        </div>
        <p>En effet, ce capteur renvoie des valeurs numériques très facilement interprétables et est founi avec une
            librairie complète et fa cile d'utilisation. C'était un choix évident pour notre projet afin de ré cupérer
            les valeurs de température et d'humidité d'un environnement. Toutefois, ce capteur ne peut pas être installé
            en extérieur car il ne fonctionne pas en dessous de 0°C. Etant dans un environnement clos à température
            ambiante, cela n'a pas été une contrainte pour notre projet</p>

        <h4 class="text-uppercase font-weight-bold mt-5">Le capteur de gaz MQ2</h4>
        <p>Pour mesurer le gaz dans une pièce, nous travaillons avec le capteur MG2.</p>
        <div class="text-center">
            <img class="img-fluid mb-5" src="public/img/mq2.png" alt="DHT11" width="200px">
        </div>
        <p>Il s'agit d'un capteur très polyvalent mais complexe à utiliser. Il peut détecter des gaz issus de sept
            sources différentes, sous-réserve de calibration. Ce capteur nous permet de détecter le monoxyde de carbone,
            issue d'une combustion incomplète et présent lors des incendies, ainsi que la fumée. Le résultat est affiché
            en ppm (partie par million)</p>

    </section>

    <section class="text-justify">
        <h2 class="font-muli font-weight-bold">Équipe et organisation actuelle</h2>
        <hr>
        <p>Nous sommes une équipe de 7 élèves ingénieurs à Polytech Annecy-Chambéry en 4e année d'Instrumentation -
            Automatique - Informatique :</p>
        <ul>
            <li>Franck Battu</li>
            <li>Tristan Grut</li>
            <li>Fabien Lalande</li>
            <li>Thibaud Murtin</li>
            <li>Johann Pistorius</li>
            <li>Erwan Prospert</li>
            <li>Adrien Rybarczyk</li>
        </ul>
        <p>Pour la période Janvier 2019 à Mai 2019 :</p>
        <ul>
            <li><span class="font-weight-bold">Responsables du projet</span> : Johann Pistorius & Adrien Rybarczyk</li>
            <li><span class="font-weight-bold">Responsable sécurité et matériel</span> : Tristan Grut</li>
            <li><span class="font-weight-bold">Scribes</span> : Franck Battu & Thibaud Murtin</li>
        </ul>
        <p>Pour la période Septembre 2018 à Janvier 2019</p>
        <ul>
            <li><span class="font-weight-bold">Responsable du projet</span> : Franck Battu</li>
            <li><span class="font-weight-bold">Responsables sécurité et matériel</span> : Johann Pistorius & Adrien
                Rybarczyk
            </li>
            <li><span class="font-weight-bold">Scribe</span> : Tristan Grut</li>
        </ul>
    </section>
</div>
