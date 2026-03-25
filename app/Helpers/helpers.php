<?php
use Illuminate\Support\Facades\Request;

if (!function_exists('generateBreadcrumb')) {
    function generateBreadcrumb() {
        $path = Request::path();
        $segments = explode('/', $path);

        $customNames = [
            'profile' => 'User Profile',
            '' => 'Main Dashboard',
            'quick-contact-info' => 'Quick Contact Info',
            'topmenu-navigation' => 'Top Menu Navigation',
            'site-settings' => 'Site Settings',
            'aboutus' => 'About Us',
            'coming_soon' => 'Coming Soon',
            'web-pages' => 'Web Pages',
            'statics' => 'Static Pages',
            'dynamics' => 'Dynamic Pages',
            'account-settings' => 'Account Settings',
            'admin-profile' => 'Admin Profile'
        ];

        // Start building the breadcrumb
        $breadcrumb = '<ol class="breadcrumb">';
        $breadcrumb .= '<li class="breadcrumb-item"><a href="' . url('/') . '">Admin Area</a></li>';

        // Check if it's the homepage or an empty path
        if (empty($path) || $path === '/') {
            // Add only "Main Dashboard" for the homepage
            $breadcrumb .= '<li class="breadcrumb-item active">' . $customNames[''] . '</li>';
        } else {
            // Build breadcrumbs for the rest of the segments
            $url = '';
            foreach ($segments as $key => $segment) {
                $url .= '/' . $segment;
                $name = isset($customNames[$segment]) ? $customNames[$segment] : ucfirst($segment);

                if ($key == count($segments) - 1) {
                    $breadcrumb .= '<li class="breadcrumb-item active">' . $name . '</li>';
                } else {
                    $breadcrumb .= '<li class="breadcrumb-item"><a href="' . url($url) . '">' . $name . '</a></li>';
                }
            }
        }

        $breadcrumb .= '</ol>';

        return $breadcrumb;
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('country_flag')) {
    function country_flag(string $countryCode): string {
        $countryCode = strtoupper($countryCode);
        if (strlen($countryCode) !== 2) {
            return '🏳️'; // Default flag if invalid
        }
        $flagOffset = 0x1F1E6; // Unicode for regional indicator A (🇦)
        $asciiOffset = 0x41;   // 'A' in ASCII
        $firstChar = mb_chr($flagOffset + (ord($countryCode[0]) - $asciiOffset));
        $secondChar = mb_chr($flagOffset + (ord($countryCode[1]) - $asciiOffset));
        return $firstChar . $secondChar;
    }
}
