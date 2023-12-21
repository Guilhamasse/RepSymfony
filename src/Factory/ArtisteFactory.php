<?php

namespace App\Factory;

use App\Entity\Artiste;
use App\Repository\ArtisteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Artiste>
 *
 * @method        Artiste|Proxy create(array|callable $attributes = [])
 * @method static Artiste|Proxy createOne(array $attributes = [])
 * @method static Artiste|Proxy find(object|array|mixed $criteria)
 * @method static Artiste|Proxy findOrCreate(array $attributes)
 * @method static Artiste|Proxy first(string $sortedField = 'id')
 * @method static Artiste|Proxy last(string $sortedField = 'id')
 * @method static Artiste|Proxy random(array $attributes = [])
 * @method static Artiste|Proxy randomOrCreate(array $attributes = [])
 * @method static ArtisteRepository|RepositoryProxy repository()
 * @method static Artiste[]|Proxy[] all()
 * @method static Artiste[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Artiste[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Artiste[]|Proxy[] findBy(array $attributes)
 * @method static Artiste[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Artiste[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ArtisteFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'dateNaissance' => self::faker()->dateTime(),
            'description' => self::faker()->text(255),
            'lieuNaissance' => self::faker()->text(255),
            'nom' => self::faker()->lastName(),
            'photo' => self::faker()->text(255),
            'prenom' => self::faker()->name(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Artiste $artiste): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Artiste::class;
    }
}
