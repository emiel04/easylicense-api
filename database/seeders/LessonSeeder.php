<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonTranslation;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {

        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create();

        LessonTranslation::factory()->create([
            'lesson_id' => $lesson1->id,
            'language_code' => 'en',
            "title" => "What must be present in the car",
            "content" =>
                "<p>Some things are important to have in the car, in this chapter we'll look at what.</p><h2 class=\"text-xl\">Compulsory</h2><p><img src=\"http://easylicense.test/images/verplicht-aanwezig.jpg\"></p><ul class=\"list-disc ml-4 leading-normal\"><li class=\"list-item leading-4\"><p>a warning triangle</p></li><li class=\"list-item leading-4\"><p>a first aid kit</p></li><li class=\"list-item leading-4\"><p>a fire extinguisher</p></li><li class=\"list-item leading-4\"><p>a high-visibility vest.</p></li></ul><h2 class=\"text-xl\">Not compulsory<br><img src=\"http://easylicense.test/images/niet-verplicht-aanwezig.jpg\"></h2><p>The following things are handy to have but are not compulsory</p><ul class=\"list-disc ml-4 leading-normal\"><li class=\"list-item leading-4\"><p>a towing cable</p></li><li class=\"list-item leading-4\"><p>a jack</p></li><li class=\"list-item leading-4\"><p>a GPS</p></li><li class=\"list-item leading-4\"><p>a spare wheel</p></li><li class=\"list-item leading-4\"><p>a parking disc</p></li><li class=\"list-item leading-4\"><p>a hands-free kit<br></p></li></ul>"
        ]);
        LessonTranslation::factory()->create(['lesson_id' => $lesson1->id, 'language_code' => 'nl',
            "title" => "Wat moet aanwezig zijn in de auto", "content" =>
                "<p>Sommige dingen zijn belangrijk om in de auto te hebben, in dit hoofstuk bekijken we wat.</p><h2 class=\"text-xl\">Wel verplicht aanwezig</h2><p><img src=\"http://easylicense.test/images/verplicht-aanwezig.jpg\"></p><ul class=\"list-disc ml-4 leading-normal\"><li class=\"list-item leading-4\"><p>een gevarendriehoek</p></li><li class=\"list-item leading-4\"><p>een verbanddoosje</p></li><li class=\"list-item leading-4\"><p>een brandblustoestel</p></li><li class=\"list-item leading-4\"><p>fluovestje.</p></li></ul><h2 class=\"text-xl\">Niet verplicht aanwezig<br><img src=\"http://easylicense.test/images/niet-verplicht-aanwezig.jpg\"></h2><p>De volgende dingen zijn handig om te hebben maar zijn niet verplicht</p><ul class=\"list-disc ml-4 leading-normal\"><li class=\"list-item leading-4\"><p>een trekkabel</p></li><li class=\"list-item leading-4\"><p>een krik</p></li><li class=\"list-item leading-4\"><p>een gps</p></li><li class=\"list-item leading-4\"><p>een reservewiel</p></li><li class=\"list-item leading-4\"><p>een parkeerschijf</p></li><li class=\"list-item leading-4\"><p>een handsfree kit<br></p></li></ul>"
        ]);
        LessonTranslation::factory()->create(['lesson_id' => $lesson2->id, 'language_code' => 'en',
            "title" => "The bicycle lane", "content" => "<h2 class=\"text-xl\">What is a bike lane?</h2><p>A bike lane is a <strong>part of the public road</strong> where <strong>bicyclists</strong> and <strong>class A mopeds</strong> must ride. <strong>Cargo bikes</strong> and <strong>three- and four-wheelers</strong> are considered equivalent to bicycles if they are <strong>less than 1 meter wide.</strong></p><p>Sometimes, drivers of class B mopeds also have to ride on a bike lane.</p><p><img src=\"http://easylicense.test/images/fietspad.jpg\"></p><p>A bike lane is indicated by:</p><ul class=\"list-disc ml-4 leading-normal\"><li class=\"list-item leading-4\"><p>one of the following two command signs</p></li><li class=\"list-item leading-4\"><p>two parallel broken lines, between which no car traffic is possible.</p></li></ul><p></p><p>It can be located <strong>on either the left or right</strong> side of the road. In some places, it is colored red, but that's not mandatory.</p>"]);
        LessonTranslation::factory()->create(['lesson_id' => $lesson2->id, 'language_code' => 'nl',
            "title" => "Het fietspad", "content" => "<h2 class=\"text-xl\">Wat is een fietspad?</h2><p>Een fietspad is een <strong>onderdeel van de openbare weg</strong>, waarop <strong>fietsers</strong> en <strong>bromfietsers klasse A</strong> moeten rijden. <strong>Bakfietsen</strong> en <strong>drie- en vierwielers</strong> worden gelijkgesteld met fietsen als ze <strong>minder breed zijn dan 1 meter.</strong></p><p>Soms moeten ook bestuurders van een bromfiets klasse B op een fietspad rijden.</p><p><img src=\"http://easylicense.test/images/fietspad.jpg\"></p><p>Een fietspad wordt aangeduid:</p><ul class=\"list-disc ml-4 leading-normal\"><li class=\"list-item leading-4\"><p>door een van de twee volgende gebodsborden</p></li><li class=\"list-item leading-4\"><p>door middel van twee evenwijdige onderbroken strepen, waartussen geen autoverkeer mogelijk is. </p></li></ul><p></p><p>Het kan <strong>zowel links als rechts</strong> van de rijbaan liggen. Op sommige plaatsen is het rood gekleurd, maar dat hoeft helemaal niet.</p>"]);

    }
}
