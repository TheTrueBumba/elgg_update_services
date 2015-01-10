Elgg Update Services for Elgg 1.9
Latest Version: 1.9.0
Released: 2015-01-10
Contact: iionly@gmx.de
License: GNU General Public License version 2
Copyright: (C) iionly - 2014, (C) Ray J - 2011


The Elgg Update Services plugin will check the plugin repository on the Elgg Community site for updates of plugins installed on your site and notifies you by email about new plugin releases. This plugin has been developed originally by Ray J. I've taken over maintaining it from Ray J because he lacks the time to develop it any further.

The automatic check for updates is partly randomized to avoid too much load for the Elgg Community site's server. The minimum time between 2 automatic checks is 7 days. To these 7 days an additional randomly created interval between 1 minute and 1 day is added, so the automatic check is done every 7-8 days. Alternatively, you can check manually for updates (the check is always done on viewing the "Manage Updates" page).

If a new version for a plugin is found, you will have the options to visit the corresponding plugin's page on the Elgg Community site and/or to directly download the latest available version.


Requirements:

* Elgg "hourly" cron enabled,
* HTTP requests using port 80 between your site and Elgg comunity. Check with your host provider if in doubt.


Install instructions:

1. Copy/extract the elgg_update_services archive into the mod folder,

2. Enable the elgg_update_services plugin,

3. Optionally, enter an email address on the Elgg Update Services plugin settings page to receive notifications about plugin updates available.


Changelog:

Version 1.9.0 (iionly)

* Updated to work on Elgg 1.9,
* Fix of deprecation issues,
* Some code cleanup,
* Excluding 'bundled' categorized plugins instead of 'core developers' authored plugins in the update check,
* Addition of a German language file.



Thanks (by Ray J):

* A big "thank you" to Cash for develop the community webservices and for the relentless support.
* A great "hello" to the Brazilian community. You rules, my friends.
* As always, thanks to Dhrup. He knows the reasons.
