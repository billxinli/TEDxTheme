<?php
// Misc
require_once 'includes/setup.php';
new TEDxTheme\SetupTheme();

// Custom Post types
require_once 'includes/custom-post-types/speakers.php';
$TEDx['CPT']['Speaker'] = new TEDxTheme\CustomPostTypes\Speaker();

require_once 'includes/custom-post-types/talks.php';
$TEDx['CPT']['Talk'] = new TEDxTheme\CustomPostTypes\Talk();

require_once 'includes/custom-post-types/teams.php';
$TEDx['CPT']['Team'] = new TEDxTheme\CustomPostTypes\Team();

require_once 'includes/custom-post-types/partners.php';
$TEDx['CPT']['Partner'] = new TEDxTheme\CustomPostTypes\Partner();

require_once 'includes/custom-post-types/schedules.php';
$TEDx['CPT']['Schedule'] = new TEDxTheme\CustomPostTypes\Schedule();

// Advanced custom fields
require_once 'includes/advanced-custom-fields/page-template-home.php';