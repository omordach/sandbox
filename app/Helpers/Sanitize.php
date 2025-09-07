<?php

namespace App\Helpers;

use DOMDocument;
use DOMElement;

class Sanitize
{
    /**
     * Sanitize HTML allowing only <iframe> elements with a restricted set of attributes.
     * Allowed attributes: src, width, height, allow, referrerpolicy, frameborder.
     */
    public static function iframe(?string $html): string
    {
        $html = (string) ($html ?? '');
        $html = trim($html);
        if ($html === '') {
            return '';
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        // Load as HTML fragment
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $allowedAttributes = [
            'src', 'width', 'height', 'allow', 'referrerpolicy', 'frameborder', 'title',
        ];

        // Find the first iframe
        $iframes = $dom->getElementsByTagName('iframe');
        if ($iframes->length === 0) {
            return '';
        }

        // Work with a dedicated output document containing only the iframe
        $out = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        /** @var DOMElement $iframe */
        $iframe = $iframes->item(0);
        $iframe = $out->importNode($iframe, true);
        $out->appendChild($iframe);
        libxml_clear_errors();

        if ($iframe instanceof DOMElement) {
            // Remove disallowed attributes
            $attrsToRemove = [];
            if ($iframe->hasAttributes()) {
                foreach ($iframe->attributes as $attr) {
                    if (!in_array(strtolower($attr->name), $allowedAttributes, true)) {
                        $attrsToRemove[] = $attr->name;
                    }
                }
            }
            foreach ($attrsToRemove as $name) {
                $iframe->removeAttribute($name);
            }

            // Ensure src is present and uses http(s)
            $src = trim((string) $iframe->getAttribute('src'));
            if ($src === '' || !preg_match('/^https?:\/\//i', $src)) {
                return '';
            }

            // Normalize numeric width/height if provided
            foreach (['width', 'height', 'frameborder'] as $dim) {
                if ($iframe->hasAttribute($dim)) {
                    $val = preg_replace('/[^0-9]/', '', (string) $iframe->getAttribute($dim));
                    if ($val === '') {
                        $iframe->removeAttribute($dim);
                    } else {
                        $iframe->setAttribute($dim, $val);
                    }
                }
            }

            // Normalize referrerpolicy to known safe value if given
            if ($iframe->hasAttribute('referrerpolicy')) {
                $policy = strtolower(trim((string) $iframe->getAttribute('referrerpolicy')));
                $allowedPolicies = ['no-referrer', 'strict-origin-when-cross-origin', 'origin', 'origin-when-cross-origin'];
                if (!in_array($policy, $allowedPolicies, true)) {
                    $iframe->setAttribute('referrerpolicy', 'no-referrer');
                }
            }

            // Ensure title for accessibility
            if (!$iframe->hasAttribute('title')) {
                $iframe->setAttribute('title', 'Credly badge');
            }
        }

        return trim((string) $out->saveHTML());
    }
}
