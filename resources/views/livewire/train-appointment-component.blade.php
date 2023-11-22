<div>
    <label for="user">Selecciona un usuario:</label>
    <select wire:model="selectedUserId" id="user">
        <option value="">Selecciona...</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="class">Clases de la semana:</label>
    <select id="class">
        <option value="">Selecciona...</option>
        @foreach($currentWeekTrainAppointments as $trainAppointment)
            <option value="{{ $trainAppointment->id }}">{{ $trainAppointment->name }} - {{ $trainAppointment->date }}</option>
        @endforeach
    </select>
</div>