<?php

declare(strict_types=1);

namespace Citadel\ExtendedFooterPlugin\Admin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'extended_footer.config.name',
                'help' => 'extended_footer.config.name_help',
                'required' => false,
            ])
            ->add('tagline', TextareaType::class, [
                'label' => 'extended_footer.config.tagline',
                'required' => false,
                'attr' => ['rows' => 2],
            ])
            ->add('info_email', EmailType::class, [
                'label' => 'extended_footer.config.info_email',
                'required' => false,
            ])
            ->add('press_email', EmailType::class, [
                'label' => 'extended_footer.config.press_email',
                'required' => false,
            ])
            ->add('address', TextareaType::class, [
                'label' => 'extended_footer.config.address',
                'help' => 'extended_footer.config.address_help',
                'required' => false,
                'attr' => ['rows' => 4],
            ])
            ->add('socials', LiveCollectionType::class, [
                'label' => 'extended_footer.config.socials',
                'help' => 'extended_footer.config.socials_help',
                'entry_type' => SocialType::class,
                'required' => false,
                'button_add_options' => [
                    'label' => 'extended_footer.config.add_social',
                    'attr' => ['class' => 'btn-outlined'],
                ],
                'button_delete_options' => [
                    'label' => 'extended_footer.config.remove_social',
                    'attr' => ['class' => 'btn-link btn-small'],
                ],
            ]);
    }
}
