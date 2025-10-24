<div 
    x-data="{
        open: false,
        view: $wire.entangle('view'),
        hoverDate: null,

        // Entangle directly with the 'value' property, which is modelable.
        @if ($range)
        startDate: $wire.entangle('value.start'),
        endDate: $wire.entangle('value.end'),
        @else
        date: $wire.entangle('value'),
        @endif

        maskDate(e, field) {
            let digits = e.target.value.replace(/\D/g, '');
            let masked = digits;
            if (digits.length > 2 && digits.length <= 4) {
                masked = digits.slice(0, 2) + '/' + digits.slice(2);
            } else if (digits.length > 4) {
                masked = digits.slice(0, 2) + '/' + digits.slice(2, 4) + '/' + digits.slice(4, 8);
            }

            const fieldset = e.target.closest('fieldset');
            const inputLabel = e.target.closest('label');

            const existingError = fieldset.querySelector('.js-error-message');
            if (existingError) existingError.remove();
            inputLabel.classList.remove('!input-error');

            if (masked.length === 10) {
                const regex = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)(?:0?2)\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))$)|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
                if (!regex.test(masked)) {
                    inputLabel.classList.add('!input-error');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'text-error js-error-message';
                    errorDiv.textContent = 'Data inválida';
                    fieldset.appendChild(errorDiv);
                }
            }
            e.target.value = masked;
            this[field] = masked;
        },

        parseDate(str) {
            if (!str) return null;
            const [day, month, year] = str.split('/').map(Number);
            return new Date(year, month - 1, day);
        },

        @if($range)
        isBetween(date, start, end) {
            const d = this.parseDate(date);
            const s = this.parseDate(start);
            const e = this.parseDate(end);
            if (!d || !s || !e) return false;
            return d > s && d < e;
        },

        isInRange(date) {
            if (this.startDate && this.endDate) {
                return this.isBetween(date, this.startDate, this.endDate);
            }
            if (this.startDate && this.hoverDate && !this.endDate) {
                const start = this.parseDate(this.startDate);
                const hover = this.parseDate(this.hoverDate);
                if (hover >= start) {
                    return this.isBetween(date, this.startDate, this.hoverDate);
                } else {
                    return this.isBetween(date, this.hoverDate, this.startDate);
                }
            }
            return false;
        },

        setInput(date) {
            const clickedDate = this.parseDate(date);
            if (!this.startDate || this.endDate) {
                this.startDate = date;
                this.endDate = null;
            } else {
                const startDateObj = this.parseDate(this.startDate);
                if (clickedDate < startDateObj) {
                    this.startDate = date;
                } else {
                    this.endDate = date;
                    this.open = false;
                    this.hoverDate = null;
                }
            }
        },
        @else
        setInput(date) {
            this.date = date;
            this.open = false;
        },
        @endif

        togglePicker() {
            this.open = !this.open;
        }
    }"
>

    @if ($range)
        <div class="flex gap-4" x-ref="trigger">
            <x-input label="Dê:" icon="o-calendar" x-model.lazy="startDate" x-on:input="maskDate($event, 'startDate')"
                @click="togglePicker()" />
            <x-input label="Até:" icon="o-calendar" x-model.lazy="endDate" x-on:input="maskDate($event, 'endDate')"
                @click="togglePicker()" />
        </div>
    @else
        <div class="flex gap-4" x-ref="trigger">
            <x-input label="{{ $label }}" icon="o-calendar" x-model.lazy="date" x-on:input="maskDate($event, 'date')"
                @click="togglePicker()" />
        </div>
    @endif

    <template x-teleport="main">
        <div x-show="open" @click.outside="open = false" @click.stop
            class="bg-base-100 w-fit flex flex-col rounded-md shadow-lg max-w-lg min-w-[300px] z-1000" x-transition
            x-anchor.bottom-start.offset.10="$refs.trigger">
            <div class="flex items-center justify-between px-4 mt-2">
                <x-button icon="o-arrow-left" class="btn-circle btn-ghost" @click="$wire.navigate('dec')" />

                <div x-show="view === 'days'" class="font-semibold text-center">
                    <span class="cursor-pointer hover:text-primary" @click="$wire.setView('months')">
                        {{ $months[$now->month - 1]['name'] }}
                    </span>
                    de
                    <span class="cursor-pointer hover:text-primary" @click="$wire.setView('years')">
                        {{ $now->year }}
                    </span>
                </div>

                <div x-show="view === 'months'" class="font-semibold text-center">
                    <span class="cursor-pointer hover:text-primary" @click="$wire.setView('years')">
                        {{ $now->year }}
                    </span>
                </div>

                <div x-show="view === 'years'" class="font-semibold text-center">
                    {{ $this->yearRangeStart }} - {{ $this->yearRangeStart + 8 }}
                </div>

                <x-button icon="o-arrow-right" class="btn-circle btn-ghost" @click="$wire.navigate('inc')" />
            </div>

            <div x-show="view === 'days'" @mouseleave="hoverDate = null">
                <ul class="grid grid-cols-7 gap-0.5 p-4 text-center text-sm">
                    @foreach (['D', 'S', 'T', 'Q', 'Q', 'S', 'S'] as $weekday)
                        <li class="font-medium text-xs text-base-content/50">{{ $weekday }}</li>
                    @endforeach

                    @foreach ($this->calendarDays($now->month, $now->year) as $day)
                        @php
                            $dateString = $day['date']->format('d/m/Y');
                        @endphp
                        <li>
                            @if ($range)
                            <button
                                type="button"
                                @click="setInput('{{ $dateString }}')"
                                @mouseenter="hoverDate = '{{ $dateString }}'"
                                :class="{
                                    'opacity-50': !{{ $day['current'] ? 'true' : 'false' }},
                                    'font-bold': {{ $day['isToday'] ? 'true' : 'false' }},
                                    'bg-primary text-primary-content rounded-full': startDate === '{{ $dateString }}' || endDate === '{{ $dateString }}' || (startDate && !endDate && hoverDate === '{{ $dateString }}'),
                                    'bg-primary/30': isInRange('{{ $dateString }}'),
                                    'rounded-r-full': startDate === '{{ $dateString }}' || (hoverDate && parseDate(hoverDate) < parseDate(startDate) && '{{ $dateString }}' === hoverDate),
                                    'rounded-l-full': endDate === '{{ $dateString }}' || (hoverDate && parseDate(hoverDate) > parseDate(startDate) && '{{ $dateString }}' === hoverDate)
                                }"
                                class="p-1 btn btn-ghost h-9 w-9"
                            >
                                {{ $day['date']->format('d') }}
                            </button>
                            @else
                            <button
                                type="button"
                                @click="setInput('{{ $dateString }}')"
                                :class="{
                                    'opacity-50': !{{ $day['current'] ? 'true' : 'false' }},
                                    'font-bold bg-primary text-primary-content rounded-full': {{ $day['isToday'] ? 'true' : 'false' }},
                                    'bg-primary text-primary-content rounded-full': date === '{{ $dateString }}'
                                }"
                                class="p-1 btn btn-ghost h-9 w-9"
                            >
                                {{ $day['date']->format('d') }}
                            </button>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div x-show="view === 'months'" class="p-4">
                <ul class="grid grid-cols-3 gap-2 text-center text-sm">
                    @foreach ($months as $month)
                        <li>
                            <button
                                type="button"
                                @click="$wire.selectMonth({{ $month['id'] }})"
                                :class="{
                                    'bg-primary text-primary-content': {{ $now->month }} === {{ $month['id'] }},
                                    'font-bold': {{ $now->month }} === {{ $month['id'] }}
                                }"
                                class="p-2 btn btn-ghost w-full rounded-md hover:bg-base-200 transition-colors"
                            >
                                {{ $month['name'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div x-show="view === 'years'" class="p-4">
                <ul class="grid grid-cols-3 gap-2 text-center text-sm">
                    @for ($year = $this->yearRangeStart; $year < $this->yearRangeStart + 9; $year++)
                        <li>
                            <button
                                type="button"
                                @click="$wire.selectYear({{ $year }})"
                                :class="{
                                    'bg-primary text-primary-content': {{ $now->year }} === {{ $year }},
                                    'font-bold': {{ $now->year }} === {{ $year }}
                                }"
                                class="p-2 btn btn-ghost w-full rounded-md hover:bg-base-200 transition-colors"
                            >
                                {{ $year }}
                            </button>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </template>
</div>