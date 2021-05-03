<?php


namespace App\Services;

use App\Entity\Transporteur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TransporteurService
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
     * @return Transporteur|null
     */
    public function get(int $id): ?Transporteur
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
    public function getTransporteur(Array $params = array(), int $limit = null, $offset = null): ?array
    {
        return $this->getRepository()->findBy($params, null, $limit, $offset);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Transporteur::class);
    }

    /**
     * @param Transporteur $transporteur
     * @return Product
     * @throws \Exception
     */
    public function persist(Transporteur $transporteur): Transporteur
    {
        $this->entityManager->persist($transporteur);
            $this->entityManager->flush();

        return $transporteur;
    }

    /**
     * @param Transporteur $transporteur
     * @return bool
     * @throws \Exception
     */
    public function remove(Transporteur $transporteur): bool
    {
        $this->entityManager->remove($transporteur);
        $this->entityManager->flush();

        return true;
    }
}
