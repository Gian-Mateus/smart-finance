<?php

namespace App\View\Components\Utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DatePicker extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label = "Data",
        public bool $range = false,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
        <div
            x-data="{
                open: false,
                view: 'days',
                hoverDate: null,
                now: new Date(),
                month: new Date().getMonth(),
                year: new Date().getFullYear(),


                calendarDays(month = null, year = null) {
                    if(month === null || year === null){
                        month = this.month;
                        year = this.year;
                    }
                    const daysInMonth = new Date(year, month + 1, 0).getDate();
                    const firstDayOfMonth = new Date(year, month, 1).getDay();
                    const days = [];
                    for (let i = 0; i < firstDayOfMonth; i++) {
                        days.push({
                            date: new Date(year, month, i),
                            current: false,
                            isToday: false
                        });
                    }
                    for (let i = 1; i <= daysInMonth; i++) {
                        const dayDate = new Date(year, month, i);
                        days.push({
                            date: dayDate,
                            current: true,
                            isToday: this.now.toDateString() === dayDate.toDateString()
                        });
                    }
                    return days;
                },

                @if ($range)
                startDate: null,
                endDate: null,
                @else
                date: null,
                @endif

                months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                daysOfWeek: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],

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

                formatDate(date) {
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}/${month}/${year}`;
                },

                setView(view){
                    this.view = view;
                },

                selectMonth(monthName){
                    this.month = this.months.indexOf(monthName);
                    this.setView('days');
                },

                selectYear(year){
                    this.year = year;
                    this.setView('months');
                },

                prevMonth(){
                    if(this.month === 0){
                        this.month = 11;
                        this.year--;
                    } else {
                        this.month--;
                    }
                },

                nextMonth(){
                    if(this.month === 11){
                        this.month = 0;
                        this.year++;
                    } else {
                        this.month++;
                    }
                },

                @if($range)
                isBetween(date, start, end) {
                    const d = date;
                    const s = start;
                    const e = end;
                    if (!d || !s || !e) return false;
                    return d > s && d < e;
                },

                isInRange(date) {
                    if (this.startDate && this.endDate) {
                        return this.isBetween(date, this.startDate, this.endDate);
                    }
                    if (this.startDate && this.hoverDate && !this.endDate) {
                        const start = this.startDate;
                        const hover = this.hoverDate;
                        if (hover >= start) {
                            return this.isBetween(date, this.startDate, this.hoverDate);
                        } else {
                            return this.isBetween(date, this.hoverDate, this.startDate);
                        }
                    }
                    return false;
                },

                setInput(date) {
                    const formatted = this.formatDate(date);
                    if (!this.startDate || this.endDate) {
                        this.startDate = formatted;
                        this.endDate = null;
                    } else {
                        if (date < this.startDate) {
                            this.startDate = formatted;
                        } else {
                            this.endDate = formatted;
                            this.open = false;
                            this.hoverDate = null;
                        }
                    }
                },
                @else
                setInput(date) {
                    this.date = this.formatDate(date);
                    this.open = false;
                },
                @endif

                togglePicker() {
                    this.open = !this.open;
                },
            }"
        >

            @if ($range)
                <div class="flex gap-4" x-ref="trigger">
                    <x-input
                        label="Dê:"
                        icon="o-calendar"
                        x-model.lazy="startDate"
                        @input="maskDate($event, 'startDate')"
                        @click="togglePicker()"
                    />
                    <x-input
                        label="Até:"
                        icon="o-calendar"
                        x-model.lazy="endDate"
                        @input="maskDate($event, 'endDate')"
                        @click="togglePicker()"
                    />
                </div>
            @else
                <div class="flex gap-4" x-ref="trigger">
                    <x-input
                        label="{{ $label }}"
                        icon="o-calendar"
                        x-model.lazy="date"
                        @input="maskDate($event, 'date')"
                        @click="togglePicker()"
                    />
                </div>
            @endif

            <template x-teleport="main">
                <div
                    x-show="open"
                    @click.outside="open = false"
                    @click.stop
                    class="bg-base-100 w-fit flex flex-col rounded-md shadow-lg max-w-lg min-w-75 z-1000"
                    x-transition
                    x-anchor.bottom-start.offset.10="$refs.trigger"
                >
                    <div class="flex items-center justify-between px-4 mt-2">
                        <x-button
                            icon="o-arrow-left"
                            class="btn-circle btn-ghost"
                            @click="prevMonth()"
                        />

                        <div
                            x-show="view === 'days'"
                            class="font-semibold text-center"
                        >
                            <span
                                class="cursor-pointer hover:text-primary"
                                @click="setView('months')"
                                x-text="months[month]"
                            >

                            </span>
                            de
                            <span class="cursor-pointer hover:text-primary" @click="setView('years')" x-text="year">

                            </span>
                        </div>

                        <div x-show="view === 'months'" class="font-semibold text-center">
                            <span class="cursor-pointer hover:text-primary" @click="setView('years')" x-text="year">

                            </span>
                        </div>

                        <div x-show="view === 'years'" class="font-semibold text-center">

                        </div>

                        <x-button icon="o-arrow-right" class="btn-circle btn-ghost"
                            @click="nextMonth()" />
                    </div>

                    <div x-show="view === 'days'" @mouseleave="hoverDate = null">
                        <ul class="grid grid-cols-7 gap-0.5 p-4 text-center text-sm">
                            <template x-for="weekday in daysOfWeek">
                                <li class="font-medium text-xs text-base-content/50" x-text="weekday"></li>
                            </template>

                            <template x-data="{ days: calendarDays(month, year) }" x-for="(day, index) in days">
                                <li>
                                    @if ($range)
                                    <button
                                        type="button"
                                        @click="setInput(day.date)"
                                        @mouseenter="hoverDate = day.date"
                                        :class="{
                                            'opacity-50': !day.current,
                                            'font-bold bg-secondary': day.isToday,
                                            'bg-primary text-primary-content rounded-full': startDate === day.date || endDate === day.date || (startDate && !endDate && hoverDate === day.date),
                                            'bg-primary/30': isInRange(day.date),
                                            'rounded-r-full': startDate === day.date || (hoverDate && hoverDate) < startDate && day.date === hoverDate,
                                            'rounded-l-full': endDate === day.date || (hoverDate && hoverDate) > startDate && day.date === hoverDate
                                        }"
                                        class="p-1 btn btn-ghost h-9 w-9"
                                        x-text="day.date.getDate()"
                                    >

                                    </button>
                                    @else
                                    <button
                                        type="button"
                                        @click="setInput(day.date)"
                                        :class="{
                                            'opacity-50': !day.current,
                                            'font-bold bg-primary text-primary-content rounded-full': day.isToday,
                                            'bg-primary text-primary-content rounded-full': now.getDate() === day.date
                                        }"
                                        class="p-1 btn btn-ghost h-9 w-9"
                                        x-text="day.date.getDate()"
                                    >

                                    </button>
                                    @endif
                                </li>
                            </template>
                        </ul>
                    </div>

                    <div x-show="view === 'months'" class="p-4">
                        <ul class="grid grid-cols-3 gap-2 text-center text-sm">
                            <template x-for="month in months">
                                <li>
                                    <button
                                        type="button"
                                        @click="selectMonth(month)"
                                        :class="{
                                            'bg-primary text-primary-content font-bold': months[this.month] === month
                                        }"
                                        class="p-2 btn btn-ghost w-full rounded-md hover:bg-base-200 transition-colors"
                                        x-text="month"
                                    >

                                    </button>
                                </li>
                            </template>
                        </ul>
                    </div>

                    <div x-data="{ years: Array.from({length: 9}, (_, i) => year - 4 + i) }" x-show="view === 'years'" class="p-4">
                        <ul class="grid grid-cols-3 gap-2 text-center text-sm">
                            <template x-for="year in years">
                                <li>
                                    <button
                                        type="button"
                                        @click="selectYear(year)"
                                        :class="{
                                            'bg-primary text-primary-content': now.getFullYear() === year,
                                            'font-bold': now.getFullYear() === year
                                        }"
                                        class="p-2 btn btn-ghost w-full rounded-md hover:bg-base-200 transition-colors"
                                        x-text="year"
                                    >

                                    </button>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </template>
        </div>
        blade;
    }
}
