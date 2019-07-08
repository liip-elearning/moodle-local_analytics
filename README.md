# `moodle-local_analytics` - A local Moodle Module adding Site Analytics

The plugin features the following options:
- exclude tracking of admin users
- build full navigation tree for Piwik course category and activity tracking
- image based tracking in case javascript is disabled (for Piwik)
- advanced analytics for Google analytics (based on [Bas Brands and Gavin Henricks work in 2013](http://www.somerandomthoughts.com/blog/2012/04/18/ireland-uk-moodlemoot-analytics-to-the-front/))

## Install instructions
1. Copy the `analytics` directory in the `local` directory of your Moodle instance
2. Visit the notifications page
3. Configure the plugin

## Configuration
The plugin currently supports 2 Analytics modes:
* Piwik
* Google Universal Analytics.

### Piwik
- Set the Site ID
- Choose whether you want image fallback tracking
- Enter the URL to your Piwik install excluding http/https and trailing slashes
- Choose whether you want to track admins (not recommended)
- Choose whether you want to send Clean URLs (recommended):
	Piwik will aggregrate Page Titles and show a nice waterfall cascade of all sites, including categories and action types

### Google Universal Analytics
- Plugin modifies the page speed sample to have 50% of your visitors samples for page speed instead of 1% making it much more useful
- Set your Google tracking ID
- Choose whether you want to track admins (not recommended)
- Choose whether you want to send Clean URLs (not recommended):
	Google analytics will no longer be able to use overlays and linking back to your Moodle site

## How does it work?

The plugin will inject tracking code for Analytics' purposes in every page through a callback.
If debugging is enabled, the URL that is tracked will be displayed on the bottom of the page.

## Changelog - Release notes

### version: 2019070801

- Remove legacy Google Analytics mode

### version: 2019070800

- Replace all injections by Moodle 3.3+'s `before_footer` callback

It now depends on at least Moodle 3.3.

### version: 2018092400

- Fixing unit test "provider_testcase" privacy/tests/provider_test.php

Add privacy provider with legacy_polyfill to say compatible with old version

### version: 2017031300

- Updated to work with Moodle versions 3.0, 3.1 and 3.2

The configuration option to push the JS into the header or footer has been removed.
Tracking codes moved to mustache templates
Implemented the trick to push the JS code into each page by Daniel Thee Roperto from Catalyst.

### version: 2015012200

- Removed the debugging URL display on the page, If debugging is required use your browsers view source feature.
