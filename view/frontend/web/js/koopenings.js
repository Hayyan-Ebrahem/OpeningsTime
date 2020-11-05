define([
    'uiComponent',
    'Hayyan_OpeningsTime/js/openingshours',
    'ko',
], function (Component, ko, openingshours) {
    'use strict';

    return Component.extend({
        defaults: {
            // default options
            // options passed into the component override these
        },

        initialize: function () {
            // add custom functionality
            // executed only once
            
            this._super();
        }
    });
});