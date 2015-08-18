<?php

namespace AppBundle\Form\CityBike;

use Cocoders\UseCase\AddDockingStationCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddDockingStationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('name')
            ->add('lat')
            ->add('long')
            ->add('Save', 'submit')
        ;
    }

    public function getName()
    {
        return 'name';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AddDockingStationCommand::class,
            'empty_data' => function (FormInterface $form)
            {
                return new AddDockingStationCommand(
                    $form->get('id')->getData(),
                    $form->get('name')->getData(),
                    $form->get('lat')->getData(),
                    $form->get('long')->getData()
                );
            }
        ));
    }
}

