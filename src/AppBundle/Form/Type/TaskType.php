<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Task;
use AppBundle\Form\DataTransformer\IssueToNumberTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    protected $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextareaType::class)
            ->add('issue', TextType::class)
            ->add('media', FileType::class, [
                'image_path' => 'mediaPath'
            ])
        ;

        $builder
            ->get('issue')
            ->addModelTransformer(new IssueToNumberTransformer($this->manager));

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
        });

        $builder->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event) {
        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
            $task = $event->getData();
            $task['title'] = ucfirst($task['title']);
            $event->setData($task);
            dump($task);
        });

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
            $task = $event->getData();
            dump($task);
        });

        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {
            $task = $event->getData();
            dump($task);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Task::class
        ));
    }
}
