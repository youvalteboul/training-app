<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Issue;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IssueToNumberTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function transform($issue)
    {
        if (null === $issue) {
            return '';
        }
        return $issue->getId();
    }

    public function reverseTransform($issueNumber)
    {
        if (!$issueNumber) {
            return;
        }
        $issue = $this->manager
            ->getRepository(Issue::class)
            ->find($issueNumber);

        if (null === $issue) {
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $issueNumber
            ));
        }

        return $issue;
    }
}
