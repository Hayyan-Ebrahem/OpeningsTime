define([
    'uiComponent',
    'underscore',
    'ko',
    'jquery'

], function (Component, ko, _,$) {
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
        initialize: function () {

           return this._super();

        },
 

        show: function () {
            // event.preventDefault();
            $(".openings-content-wrapper").slideToggle('slow');

        },

        dayNames: function () {
            var dayNames = new Array(5);
            dayNames[1] = "Monday";
            dayNames[2] = "Tuesday";
            dayNames[3] = "Wednesday";
            dayNames[4] = "Thursday";
            dayNames[5] = "Friday";


            return dayNames;

        },
        openStatus: function () {
            return true;
        },

        getOpeningStatus: function () {
            var date = new Date();
            var dayNames = [];
            dayNames[0] = "Sunday";
            dayNames[1] = "Monday";
            dayNames[2] = "Tuesday";
            dayNames[3] = "Wednesday";
            dayNames[4] = "Thursday";
            dayNames[5] = "Friday";
            dayNames[6] = "Saturday";

            var currentDay = dayNames[date.getDay()];

            var currentTimeHours = date.getHours();
            currentTimeHours = currentTimeHours < 10 ? "0" + currentTimeHours : currentTimeHours;
            var currentTimeMinutes = date.getMinutes();
            var timeNow = currentTimeHours + "" + currentTimeMinutes;

            var currentDayID = "#" + currentDay; //gets todays dayNames and turns it into id
            $(currentDayID).toggleClass("today"); //this works at hightlighting today

            var openTimeSplit = $(currentDayID).children('.opens').text().split(":");

            var openTimeHours = openTimeSplit[0];
            openTimeHours = openTimeHours < 10 ? "0" + openTimeHours : openTimeHours;

            var openTimeMinutes = openTimeSplit[1];
            var openTimex = openTimeSplit[0] + openTimeSplit[1];

            var closeTimeSplit = $(currentDayID).children('.closes').text().split(":");

            var closeTimeHours = closeTimeSplit[0];
            closeTimeHours = closeTimeHours < 10 ? "0" + closeTimeHours : closeTimeHours;

            var closeTimeMinutes = closeTimeSplit[1];
            var closeTimex = closeTimeSplit[0] + closeTimeSplit[1];

            if (timeNow >= openTimex && timeNow <= closeTimex) {
                return 'open';
            } else {
                return 'closed';
            }
        }
    });
});
