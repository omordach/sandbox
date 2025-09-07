<?php

namespace App\Helpers;

class Credly
{
    /**
     * Extract the UUID from a Credly badge URL.
     * Supports:
     * - https://www.credly.com/badges/<uuid>/public_url
     * - https://www.credly.com/earner/earned/badge/<uuid>
     */
    public static function parseUuid(?string $url): ?string
    {
        $url = trim((string) $url);
        if ($url === '') {
            return null;
        }

        // Normalize
        $url = rtrim($url);

        $patterns = [
            '#^https?://(?:www\.)?credly\.com/badges/([0-9a-fA-F-]{36})/public_url/?$#',
            '#^https?://(?:www\.)?credly\.com/earner/earned/badge/([0-9a-fA-F-]{36})(?:/)?$#',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $m)) {
                return strtolower($m[1]);
            }
        }

        return null;
    }

    /**
     * Build a standard Credly iframe from a badge URL. Returns null if invalid.
     */
    public static function iframeFromUrl(?string $url, int $width = 150, int $height = 150): ?string
    {
        $uuid = static::parseUuid($url);
        if (!$uuid) {
            return null;
        }

        $src = sprintf('https://www.credly.com/embedded_badge/%s', $uuid);
        $iframe = sprintf(
            '<iframe src="%s" width="%d" height="%d" frameborder="0" scrolling="no" referrerpolicy="no-referrer" title="Credly badge"></iframe>',
            $src,
            max(0, $width),
            max(0, $height)
        );

        // Sanitize before returning to ensure consistent storage
        return Sanitize::iframe($iframe);
    }
}
