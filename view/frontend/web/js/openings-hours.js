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
           console.log(this.openingstime);
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
        getOpeningStatus: function (time) {
            console.log(time);
            var closingTime = moment(time,"HH:mm:ss");
            var now = moment().hour();

            if(now < closingTime){
                return true;
            }
            console.log(closingTime);
            return false;
            
        },
    });
});
