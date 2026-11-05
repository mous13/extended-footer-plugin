<?php

declare(strict_types=1);

namespace Citadel\ExtendedFooterPlugin\Admin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('extended-footer.admin.configuration.manage')]
class ConfigurationController extends AbstractController
{
    #[Route('/configuration', 'configuration')]
    public function __invoke(): Response
    {
        return $this->render('@CitadelExtendedFooterPlugin/admin/configuration.html.twig');
    }
}
