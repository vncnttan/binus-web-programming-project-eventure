<div class="modal" tabindex="-1" id="join-modal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h4 class="modal-title text-white">Join Event</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="fw-bold m-0"
                        style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap">{{$event->name}}</h4>

                <div class="rounded-3 pt-2 mb-2 gap-2 d-flex flex-row gap-1"
                    style="width: fit-content; place-items: center">
                    <img src="{{$event->organizer->image}}" alt="" style="height: 1.8rem; width: 1.8rem"
                            class="rounded-circle">
                    {{$event->organizer->name}}
                </div>
                <div class="bg-yellow-primary d-block px-2 rounded-3 my-3"
                        style="width: fit-content"> {{$event->category->name}} </div>
                        <div>
                <div class="d-flex flex-row gap-2" style="place-items: center;">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
                    </svg>
                    <div class="pt-1">{{ $event->date }}</div>
                </div>
                <div class="d-flex flex-row gap-2" style="place-items: center; ">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                    </svg>
                    <div class="pt-1">{{ $event->is_online ? 'Online' : 'Onsite' }} ({{ $event->location }})</div>
                </div>
                <div class="d-flex flex-row gap-2" style="place-items: center; ">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                    </svg>
                    <div class="pt-1"> {{$event->attendees_count}} / {{ $event->quota }} attendees</div>
                </div>
            </div>
            </div>

            <form action="{{ route('event.join') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <div class="modal-body d-flex flex-column gap-3">
                    <select id="num_of_attendees" class="form-select" aria-label="Default select example">
                        <option selected disabled value="">Select number of attendees</option>
                        @for ($i = 1; $i <= $event->max_per_account; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>

                    <label id="attendees-container-label" class="fw-semibold d-none">Attendees List</label>
                    <div id="attendees-container" class="d-flex flex-column gap-2">

                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center align-items-center gap-2">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-yellow-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('num_of_attendees').addEventListener('change', () => {
        let num_of_attendees = document.getElementById('num_of_attendees');
        const attendees_container = document.getElementById('attendees-container');
        const attendees_container_label = document.getElementById('attendees-container-label');
        attendees_container_label.classList.remove('d-none');
        attendees_container.innerHTML = '';

        const loggedInUser = {
            name: '{{ auth()->user()->name }}',
            email: '{{ auth()->user()->email }}',
            phone: '{{ auth()->user()->phone_number }}'
        };

        const createAttendeeInput = (idx, name, email, phone, disabled = false) => {
            return `
                <div class="d-flex gap-2 align-items-center">
                    <input type="text" name="attendees[${idx}][full_name]" value="${name}" class="form-control" placeholder="Full name" required ${disabled ? 'disabled' : ''}>
                    <input type="email" name="attendees[${idx}][email]" value="${email}" class="form-control" placeholder="Email" required ${disabled ? 'disabled' : ''}>
                    <input type="text" name="attendees[${idx}][phone_number]" value="${phone}" class="form-control" placeholder="Phone number" required ${disabled ? 'disabled' : ''}>
                    <button type="button" class="btn ${disabled ? '' : 'remove-attendee'}"><i class="fas fa-trash ${disabled ? 'text-muted' : 'text-black'}"></i></button>
                    ${disabled ? `<input type="hidden" name="attendees[${idx}][name]" value="${name}">` : ''}
                    ${disabled ? `<input type="hidden" name="attendees[${idx}][email]" value="${email}">` : ''}
                    ${disabled ? `<input type="hidden" name="attendees[${idx}][phone]" value="${phone}">` : ''}
                </div>`;
        };

        attendees_container.innerHTML += createAttendeeInput(0, loggedInUser.name, loggedInUser.email, loggedInUser.phone, true);

        for (let i = 1; i < parseInt(num_of_attendees.value); i++) {
            attendees_container.innerHTML += createAttendeeInput(i, '', '', '');
        }

        document.querySelectorAll('.remove-attendee').forEach(btn => {
            btn.addEventListener('click', (e) => {
                num_of_attendees.value = parseInt(num_of_attendees.value - 1)
                e.target.closest('div').remove();
            });
        });
    });
</script>
