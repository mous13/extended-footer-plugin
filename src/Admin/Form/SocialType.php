<?php

declare(strict_types=1);

namespace Citadel\ExtendedFooterPlugin\Admin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class SocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'extended_footer.config.social_name',
                'required' => false,
                'attr' => ['placeholder' => 'Discord'],
            ])
            ->add('icon', TextType::class, [
                'label' => 'extended_footer.config.social_icon',
                'required' => false,
                'attr' => ['placeholder' => 'discord-logo'],
            ])
            ->add('url', UrlType::class, [
                'label' => 'extended_footer.config.social_url',
                'required' => false,
                'default_protocol' => 'https',
                'attr' => ['placeholder' => 'https://'],
            ]);
    }
}
