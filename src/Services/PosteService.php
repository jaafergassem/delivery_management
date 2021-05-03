<?php


namespace App\Services;

use App\Entity\Poste;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PosteService
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
     * @return Poste|null
     */
    public function get(int $id): ?Poste
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
    public function getPoste(Array $params = array(), int $limit = null, $offset = null): ?array
    {
        return $this->getRepository()->findBy($params, null, $limit, $offset);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Poste::class);
    }

    /**
     * @param Poste $poste
     * @return Product
     * @throws \Exceptionh
     */
    public function persist(Poste $poste): Poste
    {
        $this->entityManager->persist($poste);
            $this->entityManager->flush();

        return $poste;
    }

    /**
     * @param Poste $poste
     * @return bool
     * @throws \Exception
     */
    public function remove(Poste $poste): bool
    {
        $this->entityManager->remove($poste);
        $this->entityManager->flush();

        return true;
    }
}
