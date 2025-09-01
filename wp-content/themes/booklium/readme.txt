=== Booklium ===
Contributors: MotoPress
Tags: custom-logo, custom-menu, featured-images, threaded-comments, translation-ready, block-styles
Requires at least: 5.0
Tested up to: 6.8
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Booklium is a perfectly tailored Gutenberg WordPress theme built with the help of multifunctional Getwid Blocks. Owners of multiple villas or other accommodations can presentably showcase their properties and activities. Booklium WordPress theme comes with the Hotel Booking plugin by MotoPress which is known for rich functionality and handy features.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now. Click Activate.
3. Install required plugins.
4. If you create a new website, you may import sample data in Appearance > Import Demo Data.

== Copyright ==

Booklium WordPress Theme, Copyright (C) 2019, MotoPress
Booklium is distributed under the terms of the GNU GPL.

== Changelog ==

= 1.6.0, Jun 12 2025 =
* Hotel Booking plugin updated to version 5.2.3.
    * Added support for the Hotel Booking Accommodation-Based Payments add-on.
    * Added the ability to limit search results based on the requested number of guests.
    * Added the ability to create discount coupons specifically for services and fees. Note new and updated columns in CSV reports.
    * Extended the list of countries that can accept payments via Klarna (Stripe).
    * Added the "DTSTAMP" property to calendar export of blocking rules.
    * Added the ability to sync bookings with buffer times included.
    * Added the ability to remember the chosen guest count until checkout page.
    * Added more options for the price format.
    * Added the ability to create annually repeated seasons.
    * Added the ability to export bookings imported from external platforms to CSV reports.
    * Added a user-friendly option to select accommodation types in the WordPress block editor.
    * Added the ability to sort seasons by the start and end date. Now they are sorted by date by default.
    * Added the ability to easily change the order of the rates to set their priority.
    * Improved the Booking Details page to show all associated payments, not just the last one.
    * Improved compatibility with WordPress 6.8, addressing the _load_textdomain_just_in_time notice.
    * Improved calendar synchronization to accurately reflect the entire blocking duration.
    * Improved tooltips in the calendar date picker.
    * Improved the import of ongoing bookings from external channels.
    * Improved the way to customize rates based on the number of extra guests.
    * Improved the display of the season dates in the table of rates.
    * Improved the display of booking rules in different calendar themes.
    * Optimized an admin booking calendar URL for easier sharing.
    * Fixed an issue with annual season rules overriding the minimum stay setting.
    * Resolved several issues related to site timezone settings.
    * Fixed an issue where coupons were not applied correctly in languages other than English on the checkout page.
    * Fixed an issue with the extra guest fee calculation in search results for entries exceeding accommodation capacity.
* Minor bugfixes and improvements.

= 1.5.0, Jun 18 2024 =
* Hotel Booking plugin updated to version 4.11.2.
    * Added the ability to link selected accommodations, enabling automatic blocking of linked accommodations when one is booked.
    * Added hooks for overwriting prices in the core API.
    * Improved calendar loading speed.
    * Upgraded Stripe to the new API, added Klarna, and removed the retiring SOFORT payment method.
    * Fixed time zone issues.
    * Fixed an issue with serializeJSON() at checkout.
    * Fixed an issue where blocked dates for linked accommodations weren't displaying in the admin calendar.
    * Fixed a cost calculation issue for properties with variable pricing during search and booking.
    * Fixed an issue with adding a rate through REST API.
    * Fixed an issue with setting priority for booking rules.
    * Fixed an issue with retrieving booked services data in the REST API.
    * Fixed an issue where higher-priority booking rules in the list were not overriding lower-priority ones.
    * Fixed an issue where the Klarna payment method was still displayed as an option within Stripe even if it was disabled in the plugin settings.
    * Fixed an issue with applying 'not stay-in' booking rules and loading availability calendar data.
    * Removed whitespace characters from AJAX requests.

= 1.4.5, Feb 15 2024 =
* Hotel Booking plugin updated to version 4.8.8.
    * Significant revamp of the Direct Bank Transfer method has been made. Bookings made using this method now have a default status of "Pending Payment". You can set a time frame for customers to pay their bookings, and if payment is not received within that timeframe, the booking will automatically become "Abandoned". You can create an email template with instructions for this payment method; please do so in the payment method settings.
    * Restricted the possibility to cancel booking after the check-in date has passed.
    * Changed 'adults' to 'guests' for services in email notifications when the children field is disabled in the plugin settings.
    * Added the accommodation title tag to the reserved accommodation details email template in the email settings.
    * Added "Pending Admin" and "Pending Payment" statuses to the iCal export.
    * Added the possibility to set the booking status to 'Confirmed' or 'Pending admin' when creating a new booking in the admin area.
    * Added the ability to change a default display range on the admin bookings calendar.
    * Added year information to the check-in and check-out dates in the Bookings table.
    * Added customer name information to the booking details in the admin bookings calendar.
    * Fixed an issue with viewing booking information in the admin calendar.
    * Fixed an issue where the check-out calendar would clear when the check-in calendar was opened in the booking form.
    * Fixed an issue that prevented notes from being saved when creating a booking via REST API.
    * Fixed an issue with displaying the availability calendar for 12 months.
    * Fixed an issue where booking rules were being applied to reservations added via the backend.
    * Fixed an issue with the incorrect display of the 12 months' availability in calendar of individual accommodation.
    * Fixed an issue with sending emails in languages that use RTL writing systems.
    * Fixed an issue with PayPal in a sandbox mode.
    * Fixed an issue with caching search availability calendar's data.
    * Fixed an issue with custom checkout fields that were not exported to the CSV report.
    * Fixed an error of incorrect calculation of accommodation subtotal price in the CSV report.
    * Fixed an issue with changing capacity on the checkout page when the Stripe gateway encountered errors.
    * Fixed an issue with deleting imported bookings with a past check-in date.
    * Fixed an issue of applying the current rates to the old booking to ensure the accurate pricing in exported reports.
    * Fixed an issue that could cause error messages to appear in the direct booking form on certain websites.
    * Fixed an issue that could cause warning messages to appear in .ics files on certain websites.
    * Fixed an error with displaying a user account when switched to a non-default website language.
    * Bug fix: The plugin now takes the property capacity into account when guests choose the number of adults and children while making bookings directly from the accommodation page. This fix applies only if the property capacity is set in the settings.
    * Improved calendar styles of the search and booking forms, and added booking note tooltips to the datepicker.
    * Improved calendar compatibility with page caching plugins.
    * Improved calendar loading speed.
    * Improved date selection in the search form to display the checkout-out date month corresponding to the selected check-in date.
    * Improved the process of handling downloads of the exported bookings.
    * Improvement: The plugin now retains past bookings imported from external sources instead of deleting them.
    * Booking calendar improvements: search and booking forms display blocked and booked dates for a better user experience.
    * Enhanced code and WPML compatibility.

= 1.4.4, Sep 4 2023 =
* Fixed an issue when the mobile menu may disappear on iOS devices.
* Minor style improvements.

= 1.4.3, Feb 10 2023 =
* Hotel Booking plugin updated to version 4.6.0.
    * Added the possibility for clients to select the check-in and check-out date directly in the availability calendar.
    * Added an error message to the booking form to notify clients when an accommodation ID is not found.
    * Added coupon settings for early bird and last minute discounts.
    * Added the possibility to view the information about imported bookings in the admin calendar after clicking on a particular booking.
    * Added the price display in the availability calendar for non check-in dates.
    * Limited the number of adults and children selectable in the form to match an accommodation’s capacity for bookings directly from the accommodation page.
    * Removed the maximum limit for the adults and children capacity in the variable pricing rate settings.
    * Fixed a database bug related to customer and user data selection.
    * Fixed an issue with assigning an accommodation type upon the accommodation creation.
    * Fixed an issue with calculating prices in the availability calendars for overlapping seasons.
    * Improved the plugin compatibility with PHP 8.2.
* Minor style improvements.

= 1.4.2, Jan 31 2023 =
* Minor bugfixes and improvements.

= 1.4.1, Jan 17 2023 =
* Improved compatibility with PHP 8.

= 1.4.0, Dec 5 2022 =
* Hotel Booking plugin updated to version 4.5.0.
    * Added support for displaying prices in the availability calendars of individual accommodations.
    * Added the ability to create a percentage fee, which applies to the accommodation cost.
    * Improved the color-coding for dates in the availability calendar to better show days unavailable for check-in or check-out. Note for developers: This update might affect styles of the availability calendar in your themes or projects. Please update your code.
    * Improved the color-coding for dates in the admin calendar to better show booked and blocked days.
    * Fixed an issue with selecting a check-out day on a day that is not allowed to stay.
    * Fixed an issue with the session data security.
    * Optimized the asset loading in the admin panel for REST API.
    * Fixed an error of creating coupon codes in REST API.
    * Fixed an error with the availability search when one of the accommodations was blocked. Applies for REST API and the mobile app.
* Minor style improvements.

= 1.3.0, Sep 12 2022 =
* Hotel Booking plugin updated to version 4.4.1.
    * Implemented REST API. This will give developers more extensive control over the plugin data, help integrate third-party services, and build new frontend experiences for Hotel Booking in WordPress.
    * Added the new Hotel Manager and Hotel Worker user roles that define access to the Hotel Booking plugin settings and menus. Note: you might need to change user roles you used before this update.
    * Added the user area for customers that allows them to log in, view bookings and speed up reservations with pre-populated info at checkout. Website admins can set the plugin to create user accounts automatically or let customers create ones manually.
    * Improved booking export report.
    * Improved backend booking calendar.
    * Improved support for several Hotel Booking addons.
    * Fixed several translation related issues.
    * Fixed an issue with dates being available for selection while direct booking despite not check-in or not check-out booking rules are applied to certain accommodation types.
    * Fixed an issue with defining the number of blocked accommodation types within certain booking rules.
    * Fixed an issue with the maximum stay rule of specific accommodation type that was also applied to other accommodation types.
    * Minor bugfixes and improvements.
* Minor style improvements.

= 1.2.1, Sep 24 2021 =
* Added the Getwid plugin to the theme package.
* Added the Another MailChimp Widget plugin to the theme package.

= 1.2.0, Aug 9 2021 =
* Hotel Booking plugin updated to version 3.9.10.
    * New feature: added the option to display information about tax and fee charges additionally to the base property rate on the frontend.
    * New feature: the revenue chart (beta version).
    * Added a new payment status Canceled.
    * Added the ability to enable a two-step booking cancelation process that requires users to confirm their booking cancelation request on the external page.
    * Added the ability to disable booking rules when adding bookings on the backend manually.
    * Added a new color for the external bookings in the Bookings calendar.
    * Improved the user experience with the calendar datepicker on mobile devices.
    * Fixed an issue with displaying the number of bookings for secondary language versions in the WPML plugin.
    * Added the ability to sort accommodations by price in the accommodations listing.
* Minor style improvements.

= 1.1.1, Mar 12 2021 =
* Hotel Booking plugin updated to version 3.9.5.
    * Added the ability to set the Booking Buffer option.
    * Added the ability to set Advance Reservation: the minimum number of days allowed before booking and the maximum number of days available for future bookings.
    * Added the ability to resend the confirmation email for a booking.
    * Added the ability to create internal notes for a booking visible for site admins only.
    * Added the ability to edit existing bookings: you can now update check-in and check-out dates, rates, services, etc., as well as add, replace, or remove accommodations in the original bookings.
    * Added the ability to set the number of days prior to the check-in date applicable for applying deposits.
    * Stripe API updated to version 7.72.0.
    * Improved compatibility with the image lazy-loading feature.
    * Bug fix: fixed an issue that may cause errors in Sucuri and WP Mail SMTP plugins.
    * Bug fix: fixed an issue with payments via Stripe when amount of transaction was not calculated properly.
* Minor bugfixes and improvements.

= 1.1.0, Jan 13 2019 =
* Added the ability to change primary colors.
* Added a template to the Accommodation which allows to use a featured image instead of a slider on the single accommodation page.
* Added support for WooCommerce.
* Added simple installation guide.
* Minor bugfixes and improvements.

= 1.0.4, Dec 3 2019 =
* Performance improvements.

= 1.0.3, Dec 2 2019 =
* Improved styles for better user experience.
* Minor bugfixes and improvements.

= 1.0.2, Nov 19 2019 =
* Hotel Booking plugin updated to version 3.7.1.
  * Improved blocks compatibility with the new versions of the Gutenberg editor.
  * Added customer email address to the Stripe payment details.
  * Fixed an issue where the price breakdown was not displayed in the new booking emails.
  * Fixed an issue at checkout when coupon discount was not applied to the total price at the bottom of the page.
  * Fixed a bug concerning impossibility to complete Stripe payment after applying the coupon code.
  * Fixed an issue where the type of the coupon code was changed after its use.

= 1.0.0, October 28 2019 =
* Initial release

== Credits ==

* Based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
