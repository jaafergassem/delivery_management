<?php


namespace App\Services;

use App\Entity\Camion;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CamionService
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
     * @return Camion|null
     */
    public function get(int $id): ?Camion
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
    public function getCamion(Array $params = array(), int $limit = null, $offset = null): ?array
    {
        return $this->getRepository()->findBy($params, null, $limit, $offset);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Camion::class);
    }

    /**
     * @param Camion $camion
     * @return Product
     * @throws \Exception
     */
    public function persist(Camion $camion): Camion
    {
        $this->entityManager->persist($camion);
            $this->entityManager->flush();

        return $camion;
    }

    /**
     * @param Camion $camion
     * @return bool
     * @throws \Exception
     */
    public function remove(Camion $camion): bool
    {
        $this->entityManager->remove($camion);
        $this->entityManager->flush();

        return true;
    }
}
