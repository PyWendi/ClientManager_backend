<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{

    public function generateNumericString() {
        $numericString = '';
        
        for ($i = 1; $i <= 8; $i++) {
            $numericString .= mt_rand(0, 9); // Generate a random digit (0-9)
            
            if ($i % 3 === 0 && $i !== 10) {
                $numericString .= '-'; // Add a hyphen after every third digit, except for the last one XXX-XXX-X
            }
        }
        
        return $numericString;
    }

    protected $model = Client::class;
    
    public $obs = "";

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $solde = $this->faker->randomNumber(4);
        $obs = "";
        if (1000 > $solde) {
            $obs = "Insuffisant";
        } elseif (($solde >= 1000) && (5000 >= $solde)) {
            $obs = "Moyen";
        } else {
            $obs = "Élevé";
        }

        return [
            "numCompte" => $this->generateNumericString(),
            "nom" => fake()->name(),
            "solde" => $solde,
            "observation" => $obs
        ];
    }
}
