<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    // The name of the factory’s corresponding model.
    protected $model = Doctor::class;

    public function definition()
    {
        return [
            // Will create a User and set its ID here:
            'user_id' => User::factory(),

            'doctor_ref' => strtoupper($this->faker->bothify('DR####')),
            'age' => $this->faker->numberBetween(30, 65),
            'gender' => $this->faker->randomElement(['Homme', 'Femme']),
            'type' => $this->faker->randomElement([
                'laboratoire'
                //,'doctor'
            ]),
            'specialty' => $this->faker->randomElement([
                ' Laboratoire d’analyse',
                ' Centre d’imagerie médicale'
                // 'Médecin généraliste',
                // 'Cardiologue',
                // 'Dermatologue',
                // 'Gynécologue',
                // 'Ophtalmologue',
                // 'Neurologue',
                // 'Radiologue',
                // 'ORL (oto-rhino-laryngologiste)',
                // 'Pédiatre',
                // 'Psychiatre',
                // 'Pneumologue',
                // 'Gastro-entérologue',
                // 'Endocrinologue',
                // 'Chirurgien-dentiste',
                // 'Ostéopathe',
                // 'Masseur-kinésithérapeute',
                // 'Orthophoniste',
                // 'Psychologue',
            ]),
            'pic' => null,
            'location' => $this->faker->randomElement([
                // Alger Wilaya
                'El Biar – Alger',
                'Hydra – Alger',
                'Kouba – Alger',
                'Bab El Oued – Alger',
                'Bachdjerrah – Alger',

                // Oran Wilaya
                'El Kerma – Oran',
                'Bir El Djir – Oran',
                'Es Sénia – Oran',

                // Constantine Wilaya
                'Didouche Mourad – Constantine',
                'El Khroub – Constantine',

                // Annaba Wilaya
                'Seraïdi – Annaba',
                'El Bouni – Annaba',

                // Blida Wilaya
                'Boufarik – Blida',
                'Bouarfa – Blida',

                // Sétif Wilaya
                'El Eulma – Sétif',
                'Aïn Abessa – Sétif',

                // Batna Wilaya
                'Barika – Batna',
                'M’Daourouch – Batna',

                // Djelfa Wilaya
                'Hassi Bahbah – Djelfa',
                'Zulfiqar – Djelfa',

                // Béjaïa Wilaya
                'Tichy – Béjaïa',
                'Amizour – Béjaïa',

                // Tlemcen Wilaya
                'Maghnia – Tlemcen',
                'Souani – Tlemcen',
            ]),

            'price' => $this->faker->numberBetween(1000, 5000),
            'description' => $this->faker->paragraph,
            'work_days' => json_encode($this->faker->randomElements(
                ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                5,
                false
            )),
            'available' => $this->faker->boolean(80),
            'home_visit' => $this->faker->boolean(30),
            'rating' => $this->faker->randomFloat(1, 1, 5),
        ];
    }
}
