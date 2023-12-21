<?php

namespace App\Controller;

use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test/twig', name: 'app_test_twig')]
    public function index(): Response
    {
        $faker = Factory::create('fr_Fr');
        $users = [];
        for ($i = 0; $i < 9; $i++) {
            $user = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'age' => $faker->randomNumber(2, false),
                'address' => [
                    'street' => $faker->streetName(),
                    'code_postal' => $faker->postcode(),
                    'city' => $faker->city(),
                    'country' => $faker->country(),
                ]
            ];
            $users[$i] = $user;
        }
        return $this->render('test/index.html.twig', [
            'title' => 'page d accueil',
            'users' => $users,
        ]);
    }
}
