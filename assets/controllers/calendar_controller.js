import { Controller } from 'stimulus';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';
/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static targets = [ "events", "calendar"]
    connect() {
        const events = []
        this.eventsTargets.forEach(function(eventTarget){
            let event = {
                title: eventTarget.querySelector('.name').textContent + ' App N°'+eventTarget.querySelector('.flatNumber').textContent,
                start: eventTarget.querySelector('.startDate').textContent,
                end: eventTarget.querySelector('.endDate').textContent,
            }
            events.push(event)
        })
        let headerToolbar = {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        }
        if(window.innerWidth <= 570) {
            headerToolbar = {
                left: 'prev,next',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            }
        }
        let calendarEl = this.calendarTarget;
        let calendar = new Calendar(calendarEl, {
            locale: frLocale,
            plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
            initialView: 'listWeek',
            headerToolbar: headerToolbar,
            events:events
        });
        calendar.render();
    }
}
