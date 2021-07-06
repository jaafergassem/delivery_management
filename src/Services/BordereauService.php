<?php


namespace App\Services;

use App\Entity\Bordereau;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BordereauService
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
     * @return Bordereau|null
     */
    public function get(int $id): ?Bordereau
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
    public function getBordereau(Array $params = array(), int $limit = null, $offset = null): ?array
    {
        return $this->getRepository()->findBy($params, null, $limit, $offset);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Bordereau::class);
    }

    /**
     * @param Bordereau $bordereau
     * @return Product
     * @throws \Exception
     */
    public function persist(Bordereau $bordereau): Bordereau
    {
        $this->entityManager->persist($bordereau);
            $this->entityManager->flush();

        return $bordereau;
    }

    /**
     * @param Bordereau $bordereau
     * @return bool
     * @throws \Exception
     */
    public function remove(Bordereau $bordereau): bool
    {
        $this->entityManager->remove($bordereau);
        $this->entityManager->flush();

        return true;
    }
}
