<?php


namespace App\Services;

use App\Entity\AgentPoste;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AgentPosteService
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
     * @return AgentPoste|null
     */
    public function get(int $id): ?AgentPoste
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
    public function getAgentPoste(Array $params = array(), int $limit = null, $offset = null): ?array
    {
        return $this->getRepository()->findBy($params, null, $limit, $offset);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(AgentPoste::class);
    }

    /**
     * @param AgentPoste $agentPoste
     * @return Product
     * @throws \Exception
     */
    public function persist(AgentPoste $agentPoste): AgentPoste
    {
        $this->entityManager->persist($agentPoste);
            $this->entityManager->flush();

        return $agentPoste;
    }

    /**
     * @param AgentPoste $agentPoste
     * @return bool
     * @throws \Exception
     */
    public function remove(AgentPoste $agentPoste): bool
    {
        $this->entityManager->remove($agentPoste);
        $this->entityManager->flush();

        return true;
    }
}
