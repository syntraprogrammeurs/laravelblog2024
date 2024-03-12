@extends('layouts.admin')
@section('title')
    FAQ
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Clonen van een Laravel Project
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>Stap 1</p>
                        <ol>

                            <li>Open phpmyadmin</li>
                            <li>in je wamp op mamp server maak je een nieuwe lege database aan, bijvoorbeeld
                                <strong>dblaravelmyrepo</strong>
                            </li>
                            <li>Open je terminal/cmd</li>
                            <li>cd\</li>
                            <li>cd wamp64\www of voor mamp ga naar htdocs</li>
                            <li>git clone "repo link"</li>
                            <li>cd "repo link"</li>
                            <li>npm install</li>
                            <li>composer install</li>
                            <li>Open je project in je editor (PHPSTORM)</li>
                            <li>Open .env.example en hernoem deze naar .env</li>
                            <li>in je .env bestand pas je database aan naar bijvoorbeeld <strong>dblaravelmyrepo</strong></li>
                            <li>in je terminal typ: php artisan key:generate</li>
                            <li>Vooraleer je migrate en je werkt met windows eerst faker aanpassen in je vendor/fakerphp/src/Faker/Providers/Image.php
                                <ul>
                                    <li>rond lijn 145 zoek je naar: curl_setopt($ch, CURLOPT_FILE, $fp);</li>
                                    <li>en daaronder zet je deze lijnen: curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//new line
                                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//new line</li></li>
                                </ul>
                            </li>
                            <li>Vooraleer je migrate en je werkt met symlink eerst stap 2 uitvoeren</li>
                            <li>php migrate:fresh --seed</li>

                        </ol>
                        <p>Stap 2 (Optioneel)</p>
                        <p>Wanneer je met images werkt via de symlink, dan dien je onderstaande uit te voeren</p>
                        <ol>
                            <li>wanneer de img folder nog in je public/assets folder staat dien je deze eerste hardcoded te wissen</li>
                            <li>php artisan config:clear</li>
                            <li>php artisan storage:unlink</li>
                            <li>php artisan storage:link</li>
                        </ol>


                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Accordion Item #2
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These classes
                        control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                        modify any of this with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                        does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Accordion Item #3
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These classes
                        control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                        modify any of this with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                        does limit overflow.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


