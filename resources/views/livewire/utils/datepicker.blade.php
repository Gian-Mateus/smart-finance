<div x-data="{
    open: false,
    @if ($range) startDate: null,
        endDate: null,
        hoverDate: null,
        @else
        date: null, @endif

    maskDate(e, field) {
        let digits = e.target.value.replace(/\D/g, '');
        let masked = digits;
        if (digits.length > 2 && digits.length <= 4) {
            masked = digits.slice(0, 2) + '/' + digits.slice(2);
        } else if (digits.length > 4) {
            masked = digits.slice(0, 2) + '/' + digits.slice(2, 4) + '/' + digits.slice(4, 8);
        }
        e.target.value = masked;
        this[field] = masked;
    },

    @if($range)
    parseDate(str) {
        if (!str) return null;
        const [day, month, year] = str.split('/').map(Number);
        return new Date(year, month - 1, day);
    },

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
    @endif

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

    togglePicker() {
        this.open = !this.open;
    }
}">

    @php
        $range = false;
    @endphp

    @if ($range)
        <div class="flex gap-4" x-ref="trigger">
            <x-input label="Dê:" icon="o-calendar" x-model="startDate" x-on:input="maskDate($event, 'startDate')"
                @click="togglePicker()" />
            <x-input label="Até:" icon="o-calendar" x-model="endDate" x-on:input="maskDate($event, 'endDate')"
                @click="togglePicker()" />
        </div>
    @else
        <div class="flex gap-4" x-ref="trigger">
            <x-input label="Data" icon="o-calendar" x-model="startDate" x-on:input="maskDate($event, 'date')"
                @click="togglePicker()" />
        </div>
    @endif

    <template x-teleport="main">
        <div x-show="open" @click.outside="open = false"
            class="bg-base-100 max-w-lg w-fit flex flex-col rounded-md shadow-lg" x-transition
            x-anchor.bottom-start.offset.10="$refs.trigger">
            <div class="flex items-center justify-between px-4 mt-2">
                <x-button icon="o-arrow-left" class="btn-circle btn-ghost" @click="$wire.setMonth('dec')" />
                <div class="font-semibold">{{ $months[$now->month - 1]['name'] }} de {{ $now->year }}</div>
                <x-button icon="o-arrow-right" class="btn-circle btn-ghost" @click="$wire.setMonth('inc')" />
            </div>

            <div @mouseleave="hoverDate = null">
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
                                    'rounded-l-full': startDate === '{{ $dateString }}' || (hoverDate && parseDate(hoverDate) < parseDate(startDate) && '{{ $dateString }}' === hoverDate),
                                    'rounded-r-full': endDate === '{{ $dateString }}' || (hoverDate && parseDate(hoverDate) > parseDate(startDate) && '{{ $dateString }}' === hoverDate)

                                }"
                            >
                                {{ $day['date']->format('d') }}
                            </button>
                            @else
                            <button 
                                type="button" 
                                @click="setInput('{{ $dateString }}')"
                                @class([
                                    'p-1 btn btn-ghost h-9 w-9',
                                    'opacity-50' => !$day['current'],
                                    'font-bold bg-primary text-primary-content rounded-full' => $day['isToday'],
                                ])
                            >
                                {{ $day['date']->format('d') }}
                            </button>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </template>
</div>
