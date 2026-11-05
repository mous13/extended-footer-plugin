<?php

declare(strict_types=1);

namespace Citadel\ExtendedFooterPlugin;

use Forumify\Plugin\AbstractForumifyPlugin;
use Forumify\Plugin\PluginMetadata;

class CitadelExtendedFooterPlugin extends AbstractForumifyPlugin
{
    public function getPluginMetadata(): PluginMetadata
    {
        return new PluginMetadata(
            'Extended Footer',
            'Citadel Software Solutions',
            'A configurable site footer with your company details, contact emails and social links.',
            null,
            'extended_footer_admin_configuration',
        );
    }

    public function getPermissions(): array
    {
        return [
            'admin' => [
                'configuration' => [
                    'manage',
                ],
            ],
        ];
    }
}
