(function ($) {

    'use strict';

    function initMainNavigation(container) {
        // Add dropdown toggle that displays child menu items.
        var dropdownToggle = $('<button />', {
            'class': 'submenu-toggle',
            'aria-expanded': false,
            // 'append': '<i class="fas fa-plus open"></i><i class="fas fa-minus close"></i>'
            // 'append': '<i class="fas fa-plus open"></i><i class="fas fa-minus close"></i>'
        });

        container.find('.menu-item-has-children > a').after(dropdownToggle);

        // Toggle buttons and submenu items with active children menu items.
        container.find('.current-menu-ancestor > button').addClass('toggled-on');
        container.find('.current-menu-ancestor > .sub-menu').addClass('toggled-on');

        // Add menu items with submenus to aria-haspopup="true".
        container.find('.menu-item-has-children').attr('aria-haspopup', 'true');

        container.find('.submenu-toggle').on('click', function (e) {
            var _this = $(this);

            e.preventDefault();
            _this.toggleClass('toggled-on');
            _this.next('.children, .sub-menu').toggleClass('toggled-on');

            _this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');

        });

    }

    initMainNavigation($('#primary-menu'));

    function initMasonryBlog(container) {

        if (container.length === 0) {
            return;
        }

        if (typeof container.imagesLoaded === 'undefined') {
            return;
        }

        container.imagesLoaded(function () {
            container.masonry({
                itemSelector: '.hentry, .pagination'
            });
        });
    }

    initMasonryBlog($('.blog.blog-masonry #main'));

    function subMenuPosition() {
        $('.site-boxed #primary-menu, .site-wide #primary-menu, .primary-menu-more .menu').find('.sub-menu').each(function () {
            $(this).removeClass('toleft');
            if (($(this).parent().offset().left + $(this).parent().width() - $(window).width() + 300) > 0) {
                $(this).addClass('toleft');
            }
        });
    }

    subMenuPosition();

    $(window).resize(function () {
        subMenuPosition();
    });

    function initSocialMenuDropdown(toggle_btn) {

        if ($('body').hasClass('site-menu-left')) {
            return;
        }

        if (toggle_btn.length === 0) {
            return;
        }

        var container = toggle_btn.parent();

        toggle_btn.on('click', function (e) {
            e.preventDefault();
            container.toggleClass('toggled');
        });

        $(document).on('click', function (event) {
            if (!container.is(event.target) && container.has(event.target).length === 0) {
                container.removeClass('toggled');
            }
        });
    }

    initSocialMenuDropdown($('#social-menu-toggle'));

    $('.main-navigation-image-wrapper').on('click', function () {

        $('#site-navigation').removeClass('toggled');
        $('#primary-menu').attr('aria-expanded', false);
        $('button.menu-toggle').attr('aria-expanded', false);
    });

    /**
     * Prepends an element to a container.
     *
     * @param {Element} container
     * @param {Element} element
     */
    function prependElement(container, element) {
        if (container.firstChild) {
            return container.insertBefore(element, container.firstChild);
        } else {
            return container.appendChild(element);
        }
    }

    /**
     * Shows an element by adding a hidden className.
     *
     * @param {Element} element
     */
    function showButton(element) {
        // classList.remove is not supported in IE11
        element.className = element.className.replace('is-empty', '');
    }

    /**
     * Hides an element by removing the hidden className.
     *
     * @param {Element} element
     */
    function hideButton(element) {
        // classList.add is not supported in IE11
        if (!element.classList.contains('is-empty')) {
            element.className += ' is-empty';
        }
    }

    /**
     * Returns the currently available space in the menu container.
     *
     * @returns {number} Available space
     */
    function getAvailableSpace(button, container) {
        return container.offsetWidth - button.offsetWidth - 65;
    }

    /**
     * Returns whether the current menu is overflowing or not.
     *
     * @returns {boolean} Is overflowing
     */
    function isOverflowingNavivation(list, button, container) {
        return list.offsetWidth > getAvailableSpace(button, container);
    }

    function addItemToVisibleList(toggleButton, container, visibleList, hiddenList) {
        if (getAvailableSpace(toggleButton, container) > breaks[breaks.length - 1]) {
            // Move the item to the visible list
            visibleList.appendChild(hiddenList.firstChild);
            breaks.pop();
            addItemToVisibleList(toggleButton, container, visibleList, hiddenList);
        }
    }

    /**
     * Set menu container variable
     */
    var navContainer = document.querySelector('.site-boxed .main-navigation, .site-wide .main-navigation');
    var breaks = [];

    /**
     * Let’s bail if we our menu doesn't exist
     */
    if (navContainer) {
        /**
         * Refreshes the list item from the menu depending on the menu size
         */
        function updateNavigationMenu(container) {

            /**
             * Let’s bail if our menu is empty
             */
            if (!container.parentNode.querySelector('.primary-menu[id]')) {
                return;
            }

            // Adds the necessary UI to operate the menu.
            var visibleList = container.parentNode.querySelector('.primary-menu[id]');
            var hiddenList = visibleList.parentNode.nextElementSibling.querySelector('.hidden-links');
            var toggleButton = visibleList.parentNode.nextElementSibling.querySelector('.primary-menu-more-toggle');

            if ((window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) <= 992) {
                while (breaks.length > 0) {
                    visibleList.appendChild(hiddenList.firstChild);
                    breaks.pop();
                    addItemToVisibleList(toggleButton, container, visibleList, hiddenList);
                }
                return;
            }

            if (isOverflowingNavivation(visibleList, toggleButton, container)) {
                // Record the width of the list
                breaks.push(visibleList.offsetWidth);
                // Move last item to the hidden list
                prependElement(hiddenList, !visibleList.lastChild || null === visibleList.lastChild ? visibleList.previousElementSibling : visibleList.lastChild);
                // Show the toggle button
                showButton(toggleButton);

            } else {

                // There is space for another item in the nav
                addItemToVisibleList(toggleButton, container, visibleList, hiddenList);

                // Hide the dropdown btn if hidden list is empty
                if (breaks.length < 2) {
                    hideButton(toggleButton);
                }

            }

            // Recur if the visible list is still overflowing the nav
            if (isOverflowingNavivation(visibleList, toggleButton, container)) {
                updateNavigationMenu(container);
            }

        }

        /**
         * Run our priority+ function as soon as the document is `ready`
         */
        document.addEventListener('DOMContentLoaded', function () {

            updateNavigationMenu(navContainer);

            // Also, run our priority+ function on selective refresh in the customizer
            var hasSelectiveRefresh = (
                'undefined' !== typeof wp &&
                wp.customize &&
                wp.customize.selectiveRefresh &&
                wp.customize.navMenusPreview.NavMenuInstancePartial
            );

            if (hasSelectiveRefresh) {
                // Re-run our priority+ function on Nav Menu partial refreshes
                wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {

                    var isNewNavMenu = (
                        placement &&
                        placement.partial.id.includes('nav_menu_instance') &&
                        'null' !== placement.container[0].parentNode &&
                        placement.container[0].parentNode.classList.contains('main-navigation')
                    );

                    if (isNewNavMenu) {
                        updateNavigationMenu(placement.container[0].parentNode);
                    }
                });
            }
        });

        /**
         * Run our priority+ function on load
         */
        window.addEventListener('load', function () {
            updateNavigationMenu(navContainer);
        });

        /**
         * Run our priority+ function every time the window resizes
         */
        var timeout;

        window.addEventListener('resize', function () {
            function checkMenu() {
                if (timeout) {
                    clearTimeout(timeout);
                    timeout = undefined;
                }

                timeout = setTimeout(
                    function () {
                        updateNavigationMenu(navContainer);
                        subMenuPosition();
                    },
                    150
                );
            }

            checkMenu();
        });

        /**
         * Run our priority+ function
         */
        updateNavigationMenu(navContainer);
    }

})(jQuery);