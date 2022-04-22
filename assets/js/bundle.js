document.addEventListener('DOMContentLoaded', function () {


    const calendarEl = document.getElementById('calendar');


    const calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        timeZone: 'UTC',
        locale: 'es-us',
        selectable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        businessHours: true,
        dayMaxEvents: true,
        eventDidMount: function (info) {
            var tooltip = new Tooltip(info.el, {
                title: info.event.extendedProps.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        },
        events: 'https://2962-187-188-10-150.ngrok.io/includes/calendario/eventos.php',
        eventClick: function(info) {
            var eventObj = info.event;
      
            if (eventObj.url) {
                alert('click en el evento')
              window.open(eventObj.url);
      
              info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
            } 
          }

    });

    calendar.render();

    
});