<?php


namespace App\Services;

use App\Entity\Livreur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LivreurService
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
     * @return Livreur|null
     */
    public function get(int $id): ?Livreur
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
    public function getlivreur(Array $params = array(), int $limit = null, $offset = null): ?array
    {
        return $this->getRepository()->findBy($params, null, $limit, $offset);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Livreur::class);
    }

    /**
     * @param Livreur $livreur
     * @return Product
     * @throws \Exception
     */
    public function persist(Livreur $livreur): Livreur
    {
        $this->entityManager->persist($livreur);
            $this->entityManager->flush();

        return $livreur;
    }

    /**
     * @param Livreur $livreur
     * @return bool
     * @throws \Exception
     */
    public function remove(Livreur $livreur): bool
    {
        $this->entityManager->remove($livreur);
        $this->entityManager->flush();

        return true;
    }
}
