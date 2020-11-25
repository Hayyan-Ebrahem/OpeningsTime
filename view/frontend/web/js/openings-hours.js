define([
    'uiComponent',
    'underscore',
    'ko',
    'moment',
    'jquery'

], function (Component, ko, _,moment,$) {
    'use strict';

    return Component.extend({
        defaults: {
            // default options
            // options passed into the component override these
        },
        // jscs:disable requireCamelCaseOrUpperCaseIdentifiers
        /**
         * @override
         */
        initialize: function (config) {

           this.openingstime=config.openingstimedata;
           return this._super();


        },
 

        show: function () {
            // event.preventDefault();
            $(".openings-content-wrapper").slideToggle('slow');

        },


        // getWeekDays: function () {
        //     var dayNames = $.parseJSON(window.getStoreOpeningsTime);

        //     return dayNames;
        // },
        getOpeningStatus: function (openingstime, closingTime) {
;
            var now = moment((new Date()),'hh:mm');
            var opentime = moment(openingstime, 'hh:mm');
            var clostime = moment(closingTime, 'hh:mm');

            if (moment(now).isBetween(opentime, clostime)
            ){
                return true;
            }
            return false;
            
        },
    });
});
