<?php


namespace App\Services;

use App\Entity\Paquet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PaquetService
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
     * @return Paquet|null
     */
    public function get(int $id): ?Paquet
    {
        return $this->getRepository()->find($id);
    }

    
    /**
     * @param string $code
     *
     * @return Paquet|null
     */
    public function findByCode(string $code): ?Paquet
    {
        return $this->getRepository()->findOneByCodeBarre($code);
    }


    /**
     * @param array $params
     * @param int|null $limit
     * @param null $offset
     *
     * @return array|null
     */
    public function getPaquet(Array $params = array(), int $limit = null, $offset = null): ?array
    {
        return $this->getRepository()->findBy($params, null, $limit, $offset);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Paquet::class);
    }

    /**
     * @param Paquet $paquet
     * @return Product
     * @throws \Exception
     */
    public function persist(Paquet $paquet): Paquet
    {
        $this->entityManager->persist($paquet);
            $this->entityManager->flush();

        return $paquet;
    }

    /**
     * @param Paquet $paquet
     * @return bool
     * @throws \Exception
     */
    public function remove(Paquet $paquet): bool
    {
        $this->entityManager->remove($paquet);
        $this->entityManager->flush();

        return true;
    }
}
