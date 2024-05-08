<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $language = $this->faker->randomElement(['dutch', 'english']);
        $review = $this->faker->randomElement($this->reviews[$language]);

        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'rating' => $this->faker->numberBetween(1, 5),
            'grade' => $this->faker->numberBetween(0, 50),
            'content' => $review,
        ];
    }

    private array $reviews = [
        'dutch' => [
            "Geweldige website! Ik slaagde met gemak voor mijn theorie-examen dankzij de duidelijke uitleg en oefenvragen.",
            "Deze website heeft me echt geholpen om mijn rijbewijs theorie te leren. Ik raad het iedereen aan!",
            "Ik ben zo blij dat ik deze website heb gevonden. De leerstof wordt stap voor stap uitgelegd en de oefenvragen zijn zeer nuttig.",
            "Top website! De theorie wordt op een begrijpelijke manier uitgelegd en de examensimulaties zijn heel realistisch.",
            "Heel handig om altijd en overal te kunnen oefenen. Dankzij deze website ben ik in één keer geslaagd!",
            "Ik had moeite met het begrijpen van sommige verkeersregels, maar dankzij de video's en uitleg op deze website is het me nu helemaal duidelijk.",
            "Eindelijk een website gevonden die écht helpt bij het leren van de rijbewijs theorie. Bedankt!",
            "Ik heb al een paar andere websites geprobeerd, maar deze is veruit de beste. Aanrader!",
            "Super handig en overzichtelijk. Ik ben zo blij dat ik deze website heb gebruikt om mijn theorie te leren.",
            "De examenvragen op deze website lijken erg op die van het echte examen. Een goede voorbereiding!",
            "Deze website heeft me enorm geholpen om mijn rijbewijs theorie te begrijpen. Ik ben erg tevreden!",
            "Ik heb mijn theorie-examen in één keer gehaald dankzij deze website. Ik kan het iedereen aanbevelen!",
            "De leerstof wordt op een leuke en interactieve manier gepresenteerd. Ik heb er veel van geleerd!",
            "Ik was erg nerveus voor mijn theorie-examen, maar dankzij deze website voelde ik me goed voorbereid en zelfverzekerd.",
            "Deze website is echt een aanrader voor iedereen die zijn rijbewijs theorie wil leren op een efficiënte manier.",
            "Bedankt voor deze geweldige website! Ik heb mijn theorie-examen in één keer gehaald!",
            "Ik had niet gedacht dat ik de theorie zo snel zou kunnen begrijpen, maar deze website heeft me echt geholpen.",
            "De oefenvragen zijn zeer nuttig en de uitleg is heel duidelijk. Ik ben erg tevreden!",
            "Ik ben erg blij met deze website. De leerstof wordt op een gestructureerde manier gepresenteerd.",
            "Ik had wat twijfels voordat ik deze website probeerde, maar nu ben ik helemaal overtuigd. Een fantastische hulp bij het leren van de theorie!",
            "Ik ben zo dankbaar voor deze website. Dankzij de handige tips en oefenvragen heb ik mijn theorie-examen gehaald!",
            "Geweldige service en zeer behulpzaam personeel. Ik kan deze website niet genoeg aanbevelen!",
            "Deze website heeft me geholpen om mijn theorie-examen te halen op een snelle en efficiënte manier. Bedankt!",
            "Een vriend raadde me deze website aan en ik ben zo blij dat ik ernaar heb geluisterd. Ik ben geslaagd!",
            "Deze website heeft me veel zelfvertrouwen gegeven voor mijn theorie-examen. Ik ben blij dat ik ervoor heb gekozen om hier te leren.",
            "Ik heb veel geleerd van deze website en ik ben blij dat ik hier mijn tijd aan heb besteed. Een geweldige hulp bij het leren van de theorie!",
        ],
        'english' => [
            "This website is a lifesaver! I passed my driving theory test on the first try, all thanks to the comprehensive resources available here.",
            "I highly recommend this website to anyone preparing for their driving theory test. It's user-friendly and packed with useful information.",
            "The practice tests on this website are incredibly helpful. They helped me get familiar with the format of the real exam and boosted my confidence.",
            "I love that this website is free. It makes studying for my driving theory test accessible to everyone, regardless of their financial situation.",
            "The explanations provided for each question are clear and easy to understand. They helped me grasp difficult concepts quickly.",
            "Thanks to this website, I feel well-prepared and confident going into my driving theory test. The practice questions are spot-on.",
            "The layout of the website is intuitive, making it easy to navigate and find the information I need to study.",
            "I appreciate the variety of practice tests available on this website. It ensures that I'm thoroughly prepared for any question that might come up on the exam.",
            "I've tried other driving theory websites before, but this one is by far the best. The quality of the content sets it apart.",
            "I've recommended this website to all of my friends who are studying for their driving theory test. It's that good!",
            "The mobile-friendly design of this website is a game-changer. I can study on the go, whenever and wherever I have a spare moment.",
            "I'm so grateful for this website. It's made the daunting task of studying for my driving theory test much more manageable.",
            "The progress tracking feature is fantastic. It helps me stay motivated and on track with my study goals.",
            "I can't believe this website is free. It's truly a gem for anyone preparing for their driving theory test.",
            "The practice tests simulate the real exam experience perfectly. I felt completely prepared when I sat down to take my test.",
            "I love that this website offers both practice tests and study guides. It caters to different learning styles and preferences.",
            "The customer support team is incredibly helpful and responsive. They answered all of my questions promptly and courteously.",
            "The website is constantly updated with new content and features, which shows a commitment to providing the best possible study experience.",
            "I passed my driving theory test with flying colors, thanks to this website. I couldn't be happier with the results.",
            "The interactive elements on the website make studying fun and engaging. It's not just a chore anymore.",
            "I've never been good at taking tests, but this website helped me build my confidence and improve my test-taking skills.",
            "I appreciate that this website emphasizes not just memorization, but understanding the underlying concepts. It's made me a better driver.",
            "I love that I can access this website from any device with an internet connection. It's convenient and flexible.",
            "The content is presented in a way that's easy to digest and retain. I actually enjoy studying now!",
            "I've tried other study materials, but nothing compares to this website. It's the only resource I need to ace my driving theory test."
        ]
    ];
}
