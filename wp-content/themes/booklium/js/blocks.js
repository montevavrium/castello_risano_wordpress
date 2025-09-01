wp.domReady(function () {

    'use strict';

    wp.blocks.registerBlockStyle('motopress-hotel-booking/rooms', {
        name: 'grid',
        label: 'Grid'
    });

    wp.blocks.registerBlockStyle('motopress-hotel-booking/rooms', {
        name: 'minimalistic',
        label: 'Minimalistic'
    });

    wp.blocks.registerBlockStyle('motopress-hotel-booking/rooms', {
        name: 'minimalistic-high',
        label: 'Minimalistic High Images'
    });

    wp.blocks.registerBlockStyle('motopress-hotel-booking/availability-search', {
        name: 'horizontal',
        label: 'Horizontal'
    });

    wp.blocks.registerBlockStyle('motopress-hotel-booking/availability-search', {
        name: 'horizontal-white',
        label: 'Horizontal, white labels'
    });

    wp.blocks.registerBlockStyle('motopress-hotel-booking/availability-search', {
        name: 'horizontal-equal',
        label: 'Horizontal, 1/4'
    });

    wp.blocks.registerBlockStyle('motopress-hotel-booking/availability', {
        name: 'horizontal',
        label: 'Horizontal'
    });

    wp.blocks.registerBlockStyle('motopress-hotel-booking/availability', {
        name: 'vertical',
        label: 'Vertical 50x50'
    });

    wp.blocks.registerBlockStyle('getwid/field-name', {
        name: 'half-width',
        label: 'Half Width'
    });

    wp.blocks.registerBlockStyle('getwid/field-email', {
        name: 'half-width',
        label: 'Half Width'
    });

    wp.blocks.registerBlockStyle('getwid/price-list', {
        name: 'highlighted',
        label: 'Highlighted'
    });

    wp.blocks.registerBlockStyle('getwid/advanced-heading', {
        name: 'with-shadow',
        label: 'With Shadow'
    });

    wp.blocks.registerBlockStyle('getwid/video-popup', {
        name: 'rounded',
        label: 'Rounded'
    });

    wp.blocks.registerBlockStyle('getwid/instagram', {
        name: '3-4',
        label: 'Proportion 3x4'
    });

    wp.blocks.registerBlockStyle('getwid/instagram', {
        name: '4-5',
        label: 'Proportion 4x5'
    });

    wp.blocks.registerBlockStyle('getwid/instagram', {
        name: '16-9',
        label: 'Proportion 16x9'
    });

    wp.blocks.registerBlockStyle('getwid/banner', {
        name: 'shadow-bottom',
        label: 'Shadow Bottom'
    });

    wp.blocks.registerBlockStyle('getwid/recent-posts', {
        name: 'light',
        label: 'Light'
    });

    wp.blocks.registerBlockStyle('getwid/recent-posts', {
        name: 'dark',
        label: 'Dark'
    });

    wp.blocks.registerBlockStyle('getwid/recent-posts', {
        name: 'with-shadow',
        label: 'With Shadow',
    });

    wp.blocks.registerBlockStyle('getwid/custom-post-type', {
        name: 'light',
        label: 'Light'
    });

    wp.blocks.registerBlockStyle('getwid/custom-post-type', {
        name: 'dark',
        label: 'Dark'
    });

    wp.blocks.registerBlockStyle('getwid/custom-post-type', {
        name: 'with-shadow',
        label: 'With Shadow'
    });

    wp.blocks.registerBlockStyle('getwid/post-carousel', {
        name: 'light',
        label: 'Light',
        isDefault: true
    });

    wp.blocks.registerBlockStyle('getwid/post-carousel', {
        name: 'dark',
        label: 'Dark'
    });

    wp.blocks.registerBlockStyle('getwid/post-carousel', {
        name: 'with-shadow',
        label: 'With Shadow'
    });

    if (booklium_editor_data.canRegisterSectionStyle) {
        wp.blocks.registerBlockStyle('getwid/section', {
            name: 'with-shadow',
            label: 'With Shadow'
        });

        wp.blocks.registerBlockStyle('getwid/section', {
            name: 'with-big-shadow',
            label: 'With Big Shadow'
        });

        wp.blocks.registerBlockStyle('getwid/section', {
            name: 'bordered',
            label: 'With Border'
        });
    }

});