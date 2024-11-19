<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário Interativo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom,#a00303, #290c0c, #111111, #3e2424);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            background-color: white ;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .calendar {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .calendar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        button {
            background-color: #a00303;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: crimson;
        }

        #monthYear {
            font-size: 1.5em;
            font-weight: bold;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            width: 100%;
            gap: 5px;
            margin-top: 10px;
        }

        .day-name {
            text-align: center;
            font-weight: bold;
        }

        .days-container {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            width: 100%;
            margin-top: 10px;
        }

        .day {
            padding: 15px;
            text-align: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .day:hover {
            background-color: #e7e7e7;
        }

        .day.has-event {
            background-color: #ff5722;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        input[type="text"], input[type="time"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .event-list {
            text-align: left;
            margin-top: 20px;
        }

        .event-item {
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button#saveEvent, button#closeEventModal, button#deleteEvent {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #6200ea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button#deleteEvent {
            background-color: #e74c3c;
        }

        button#closeEventModal {
            background-color: #aaa;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5em;
            cursor: pointer;
        }

        .account-type-buttons {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-bottom: 20px;
        }

        .account-type-buttons button {
            background-color: #03a9f4;
        }

        .account-type-buttons button:hover {
            background-color: #0288d1;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Calendário Interativo</h1>

    <div class="account-type-buttons">
        <button id="setInstructor">Tornar-se Instrutor</button>
        <button id="setStudent">Tornar-se Aluno</button>
    </div>

    <div class="calendar">
        <div class="calendar-header">
            <button id="prevMonth">◀</button>
            <span id="monthYear"></span>
            <button id="nextMonth">▶</button>
        </div>
        <div class="calendar-grid">
            <div class="day-name">Dom</div>
            <div class="day-name">Seg</div>
            <div class="day-name">Ter</div>
            <div class="day-name">Qua</div>
            <div class="day-name">Qui</div>
            <div class="day-name">Sex</div>
            <div class="day-name">Sáb</div>
        </div>
        <div id="daysContainer" class="days-container">
            <!-- Os dias serão inseridos dinamicamente aqui -->
        </div>
    </div>
</div>

<div id="eventModal" class="modal">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <h2>Gerenciar Eventos</h2>
        
        <div id="eventForm">
            <label for="eventTitle">Título do Evento:</label>
            <input type="text" id="eventTitle">
            
            <label for="eventTime">Horário:</label>
            <input type="time" id="eventTime">
            
            <button id="saveEvent">Salvar Evento</button>
        </div>

        <div class="event-list" id="eventList"></div>
        
        <!-- Botão adicional para fechar o modal -->
        <button id="closeEventModal">Fechar</button>
    </div>
</div>

<script>
    let selectedDate = null;
    let userRole = 'student';  
    let events = loadEvents();

    const monthNames = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    const daysContainer = document.getElementById("daysContainer");
    const monthYear = document.getElementById("monthYear");
    const prevMonthButton = document.getElementById("prevMonth");
    const nextMonthButton = document.getElementById("nextMonth");
    const eventModal = document.getElementById("eventModal");
    const closeModal = document.getElementById("closeModal");
    const closeEventModalButton = document.getElementById("closeEventModal");
    const saveEventButton = document.getElementById("saveEvent");
    const eventTitleInput = document.getElementById("eventTitle");
    const eventTimeInput = document.getElementById("eventTime");
    const eventList = document.getElementById("eventList");
    const currentDate = new Date();

    function loadEvents() {
        const storedEvents = localStorage.getItem('events');
        return storedEvents ? JSON.parse(storedEvents) : {};
    }

    function saveEvents(events) {
        localStorage.setItem('events', JSON.stringify(events));
    }

    function setUserRole(role) {
        userRole = role;
        renderCalendar();
    }

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        monthYear.textContent = `${monthNames[month]} ${year}`;
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();

        let day = 1;
        let gridHtml = "";

        for (let i = 0; i < firstDayOfMonth; i++) {
            gridHtml += `<div class="day"></div>`;
        }

        for (let i = firstDayOfMonth; i < firstDayOfMonth + lastDateOfMonth; i++) {
            const date = `${year}-${month + 1}-${day}`;
            const eventsForDay = events[date] || [];
            const hasEvent = eventsForDay.length > 0 ? 'has-event' : '';
            gridHtml += `<div class="day ${hasEvent}" data-date="${date}" onclick="openEventModal(event)">${day}</div>`;
            day++;
        }

        daysContainer.innerHTML = gridHtml;
    }

    function openEventModal(event) {
        const dayElement = event.target;
        selectedDate = dayElement.dataset.date;

        if (userRole === 'student') {
            alert(`Eventos para o dia ${selectedDate}:\n${getEventsForDay(selectedDate)}`);
            return;
        }

        eventModal.style.display = 'flex';
        loadEventsForDay(selectedDate);
    }

    function loadEventsForDay(date) {
        eventList.innerHTML = "";
        const eventsForDay = events[date] || [];
        eventsForDay.forEach((event, index) => {
            const eventItem = document.createElement("div");
            eventItem.classList.add("event-item");
            eventItem.innerHTML = `
                ${event.title} - ${event.time}
                <button onclick="editEvent(${index})">Editar</button>
                <button onclick="deleteEvent(${index})">Excluir</button>
            `;
            eventList.appendChild(eventItem);
        });
    }

    function editEvent(index) {
        const event = events[selectedDate][index];
        eventTitleInput.value = event.title;
        eventTimeInput.value = event.time;
        saveEventButton.onclick = () => saveEvent(index);
    }

    function saveEvent(index = null) {
        const eventTitle = eventTitleInput.value.trim();
        const eventTime = eventTimeInput.value;

        if (eventTitle && eventTime) {
            const event = { title: eventTitle, time: eventTime };

            if (!events[selectedDate]) {
                events[selectedDate] = [];
            }

            if (index !== null) {
                events[selectedDate][index] = event;
            } else {
                events[selectedDate].push(event);
            }

            saveEvents(events);
            renderCalendar();
            loadEventsForDay(selectedDate);
            eventTitleInput.value = "";
            eventTimeInput.value = "";
            saveEventButton.onclick = () => saveEvent(); // Reset save button to default action
        } else {
            alert('Por favor, preencha todos os campos.');
        }
    }

    function deleteEvent(index) {
        events[selectedDate].splice(index, 1);
        if (events[selectedDate].length === 0) delete events[selectedDate];
        saveEvents(events);
        renderCalendar();
        loadEventsForDay(selectedDate);
    }

    function closeEventModal() {
        eventModal.style.display = 'none';
        eventTitleInput.value = "";
        eventTimeInput.value = "";
        saveEventButton.onclick = () => saveEvent(); // Reset save button action
    }

    function getEventsForDay(date) {
        const eventsForDay = events[date];
        return eventsForDay ? eventsForDay.map(e => `${e.title} - ${e.time}`).join('\n') : 'Nenhum evento';
    }

    prevMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    closeModal.addEventListener('click', closeEventModal);
    closeEventModalButton.addEventListener('click', closeEventModal);
    saveEventButton.addEventListener('click', () => saveEvent());

    document.getElementById('setInstructor').addEventListener('click', () => setUserRole('instructor'));
    document.getElementById('setStudent').addEventListener('click', () => setUserRole('student'));

    renderCalendar();
</script>

</body>
</html>
