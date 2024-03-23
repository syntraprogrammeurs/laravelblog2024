<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Zorg ervoor dat de directory bestaat.
        $path = storage_path('app/public/posts');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // Gebruik de faker-bibliotheek om een afbeelding te genereren
        $faker = \Faker\Factory::create();

        // In Faker 1.x kun je gebruik maken van 'image' methode direct
        // In Faker 2.x moet je de ImageProvider op de volgende manier gebruiken
        $imageFile = $faker->image($path, 640, 480, 'cats', true, true, 'Faker');

        // Het pad naar de afbeelding
        $relativePath = 'posts/'. basename($imageFile);

        // Sla de afbeelding op in de directory
        Storage::disk('public')->put($relativePath, file_get_contents($imageFile));

        // Verwijder de tijdelijke afbeelding
       // unlink($imageFile);

        // Geef de attributen terug die aan de Photo model moeten worden toegewezen
        return [
            'file' => basename($imageFile),
            // Voeg extra attributen toe die je nodig hebt
        ];
    }
}
