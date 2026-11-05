<?php

declare(strict_types=1);

namespace Citadel\ExtendedFooterPlugin\Admin\Components;

use Citadel\ExtendedFooterPlugin\Admin\Form\ConfigurationType;
use Forumify\Core\Repository\SettingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent('ExtendedFooter\\ConfigurationForm', '@CitadelExtendedFooterPlugin/admin/components/configuration_form.html.twig')]
#[IsGranted('extended-footer.admin.configuration.manage')]
class ConfigurationForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    private const PREFIX = 'extended_footer.';
    private const FIELDS = ['name', 'tagline', 'info_email', 'press_email', 'address', 'socials'];

    public function __construct(private readonly SettingRepository $settingRepository)
    {
    }

    protected function instantiateForm(): FormInterface
    {
        $data = [];
        foreach (self::FIELDS as $field) {
            $data[$field] = $this->settingRepository->get(self::PREFIX . $field);
        }
        $data['socials'] = array_values($data['socials'] ?? []);

        return $this->createForm(ConfigurationType::class, $data);
    }

    #[LiveAction]
    public function save(): Response
    {
        $this->submitForm();
        $data = $this->getForm()->getData();

        $data['socials'] = array_values(array_filter(
            array_map(fn (array $social) => array_map($this->clean(...), $social), $data['socials'] ?? []),
            static fn (array $social) => $social['url'] !== null,
        ));

        foreach (self::FIELDS as $field) {
            $value = $field === 'socials' ? $data['socials'] : $this->clean($data[$field] ?? null);

            if ($value === null || $value === []) {
                $this->settingRepository->unset(self::PREFIX . $field, false);
            } else {
                $this->settingRepository->set(self::PREFIX . $field, $value, false);
            }
        }
        $this->settingRepository->flush();

        $this->addFlash('success', 'extended_footer.config.saved');
        return $this->redirectToRoute('extended_footer_admin_configuration');
    }

    private function clean(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $value = trim(str_replace("\r\n", "\n", $value));
        return $value === '' ? null : $value;
    }
}
