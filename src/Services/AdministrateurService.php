<?php


namespace App\Services;

use App\Entity\Administrateur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AdministrateurService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var ValidatorInterface */
    private $validator;


    /**
     * UserService constructor.
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     */
    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @param int $id
     *
     * @return Administrateur|null
     */
    public function get(int $id): ?Administrateur
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param array $params
     * @param int|null $limit
     * @param null $offset
     *
     * @return array|null
     */
    public function getAdministrateur(Array $params = array(), int $limit = null, $offset = null): ?array
    {
        return $this->getRepository()->findBy($params, null, $limit, $offset);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Administrateur::class);
    }

    /**
     * @param Administrateur $administrateur
     * @return Product
     * @throws \Exception
     */
    public function persist(Administrateur $administrateur): Administrateur
    {
        $this->entityManager->persist($administrateur);
            $this->entityManager->flush();

        return $administrateur;
    }

    /**
     * @param Administrateur $administrateur
     * @return bool
     * @throws \Exception
     */
    public function remove(Administrateur $administrateur): bool
    {
        $this->entityManager->remove($administrateur);
        $this->entityManager->flush();

        return true;
    }
}
