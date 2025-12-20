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
                today: new Date(),
                currentMonth: new Date().getMonth(),
                currentYear: new Date().getFullYear(),
                selectedYear: new Date().getFullYear(),

                @if ($range)
                startDate: null,
                endDate: null,
                startDateInput: '',
                endDateInput: '',
                @else
                date: null,
                dateInput: '',
                @endif

                months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                daysOfWeek: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],

                get yearRange() {
                    const center = this.selectedYear;
                    return Array.from({length: 9}, (_, i) => center - 4 + i);
                },

                get calendarDays() {
                    const year = this.currentYear;
                    const month = this.currentMonth;
                    const daysInMonth = new Date(year, month + 1, 0).getDate();
                    const firstDay = new Date(year, month, 1).getDay();
                    const prevMonthDays = new Date(year, month, 0).getDate();
                    const days = [];

                    // Dias do mês anterior
                    for (let i = firstDay - 1; i >= 0; i--) {
                        const day = prevMonthDays - i;
                        days.push({
                            date: new Date(year, month - 1, day),
                            current: false,
                            isToday: false
                        });
                    }

                    // Dias do mês atual
                    for (let day = 1; day <= daysInMonth; day++) {
                        const date = new Date(year, month, day);
                        days.push({
                            date: date,
                            current: true,
                            isToday: this.isSameDay(date, this.today)
                        });
                    }

                    // Dias do próximo mês
                    const remainingDays = 42 - days.length;
                    for (let day = 1; day <= remainingDays; day++) {
                        days.push({
                            date: new Date(year, month + 1, day),
                            current: false,
                            isToday: false
                        });
                    }

                    return days;
                },

                toISODate(date) {
                    if (!date) return '';
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                },

                isSameDay(date1, date2) {
                    if (!date1 || !date2) return false;
                    return date1.getFullYear() === date2.getFullYear() &&
                           date1.getMonth() === date2.getMonth() &&
                           date1.getDate() === date2.getDate();
                },

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
                    const existingError = fieldset?.querySelector('.js-error-message');

                    if (existingError) existingError.remove();
                    if (inputLabel) inputLabel.classList.remove('!input-error');

                    if (masked.length === 10) {
                        const regex = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)(?:0?2)\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))$)|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;

                        if (!regex.test(masked)) {
                            if (inputLabel) inputLabel.classList.add('!input-error');
                            if (fieldset) {
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'text-error js-error-message';
                                errorDiv.textContent = 'Data inválida';
                                fieldset.appendChild(errorDiv);
                            }
                        } else {
                            // Data válida - atualizar objeto
                            const [day, month, year] = masked.split('/');
                            const dateObj = new Date(year, month - 1, day);
                            @if ($range)
                            if (field === 'startDateInput') {
                                this.startDate = dateObj;
                            } else {
                                this.endDate = dateObj;
                            }
                            @else
                            this.date = dateObj;
                            @endif
                        }
                    }

                    e.target.value = masked;
                    this[field] = masked;
                },

                setView(view) {
                    if (view === 'years') {
                        this.selectedYear = this.currentYear;
                    }
                    this.view = view;
                },

                selectMonth(monthIndex) {
                    this.currentMonth = monthIndex;
                    this.view = 'days';
                },

                selectYear(year) {
                    this.currentYear = year;
                    this.view = 'months';
                },

                navigate(direction) {
                    if (this.view === 'days') {
                        this.currentMonth += direction;
                        if (this.currentMonth > 11) {
                            this.currentMonth = 0;
                            this.currentYear++;
                        } else if (this.currentMonth < 0) {
                            this.currentMonth = 11;
                            this.currentYear--;
                        }
                    } else if (this.view === 'months') {
                        this.currentYear += direction;
                    } else if (this.view === 'years') {
                        this.selectedYear += (direction * 9);
                    }
                },

                @if($range)
                isBetween(date, start, end) {
                    return date > start && date < end;
                },

                isInRange(date) {
                    if (this.startDate && this.endDate) {
                        return this.isBetween(date, this.startDate, this.endDate);
                    }
                    if (this.startDate && this.hoverDate && !this.endDate) {
                        if (this.hoverDate >= this.startDate) {
                            return this.isBetween(date, this.startDate, this.hoverDate);
                        } else {
                            return this.isBetween(date, this.hoverDate, this.startDate);
                        }
                    }
                    return false;
                },

                isSelected(date) {
                    if (this.startDate && this.isSameDay(date, this.startDate)) return true;
                    if (this.endDate && this.isSameDay(date, this.endDate)) return true;
                    if (this.startDate && !this.endDate && this.hoverDate && this.isSameDay(date, this.hoverDate)) return true;
                    return false;
                },

                selectDate(date) {
                    if (!this.startDate || this.endDate) {
                        this.startDate = date;
                        this.startDateInput = date.toLocaleDateString('pt-BR');
                        this.endDate = null;
                        this.endDateInput = '';
                    } else {
                        if (date < this.startDate) {
                            this.endDate = this.startDate;
                            this.endDateInput = this.startDate.toLocaleDateString('pt-BR');
                            this.startDate = date;
                            this.startDateInput = date.toLocaleDateString('pt-BR');
                        } else {
                            this.endDate = date;
                            this.endDateInput = date.toLocaleDateString('pt-BR');
                        }
                        this.open = false;
                        this.hoverDate = null;
                    }
                },
                @else
                selectDate(date) {
                    this.date = date;
                    this.dateInput = date.toLocaleDateString('pt-BR');
                    this.open = false;
                },
                @endif

                togglePicker() {
                    this.open = !this.open;
                    if (this.open) {
                        this.view = 'days';
                    }
                },
            }"
        >
            <!-- Hidden inputs para Livewire -->
            @if ($range)
                <input type="hidden" x-model="toISODate(startDate)" {{ $attributes->whereStartsWith('wire:model')->first('wire:model') ? $attributes->whereStartsWith('wire:model')->first('wire:model') . '.0' : '' }} />
                <input type="hidden" x-model="toISODate(endDate)" {{ $attributes->whereStartsWith('wire:model')->first('wire:model') ? $attributes->whereStartsWith('wire:model')->first('wire:model') . '.1' : '' }} />
            @else
                <input type="hidden" x-model="toISODate(date)" {{ $attributes->whereStartsWith('wire:model') }} />
            @endif

            @if ($range)
                <div class="flex gap-4" x-ref="trigger">
                    <x-input
                        label="Dê:"
                        icon="o-calendar"
                        x-model.lazy="startDateInput"
                        @input="maskDate($event, 'startDateInput')"
                        @click="togglePicker()"
                    />
                    <x-input
                        label="Até:"
                        icon="o-calendar"
                        x-model.lazy="endDateInput"
                        @input="maskDate($event, 'endDateInput')"
                        @click="togglePicker()"
                    />
                </div>
            @else
                <div class="flex gap-4" x-ref="trigger">
                    <x-input
                        label="{{ $label }}"
                        icon="o-calendar"
                        x-model.lazy="dateInput"
                        @input="maskDate($event, 'dateInput')"
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
                    <!-- Header -->
                    <div class="flex items-center justify-between px-4 mt-2">
                        <x-button
                            icon="o-arrow-left"
                            class="btn-circle btn-ghost"
                            @click="navigate(-1)"
                        />

                        <div class="font-semibold text-center">
                            <span x-show="view === 'days'">
                                <span class="cursor-pointer hover:text-primary" @click="setView('months')" x-text="months[currentMonth]"></span>
                                de
                                <span class="cursor-pointer hover:text-primary" @click="setView('years')" x-text="currentYear"></span>
                            </span>
                            <span x-show="view === 'months'" class="cursor-pointer hover:text-primary" @click="setView('years')" x-text="currentYear"></span>
                            <span x-show="view === 'years'" x-text="yearRange[0] + ' - ' + yearRange[8]"></span>
                        </div>

                        <x-button
                            icon="o-arrow-right"
                            class="btn-circle btn-ghost"
                            @click="navigate(1)"
                        />
                    </div>

                    <!-- Days View -->
                    <div x-show="view === 'days'" @mouseleave="hoverDate = null">
                        <ul class="grid grid-cols-7 gap-0.5 p-4 text-center text-sm">
                            <template x-for="weekday in daysOfWeek">
                                <li class="font-medium text-xs text-base-content/50" x-text="weekday"></li>
                            </template>

                            <template x-for="day in calendarDays">
                                <li>
                                    @if ($range)
                                    <button
                                        type="button"
                                        @click="selectDate(day.date)"
                                        @mouseenter="hoverDate = day.date"
                                        :class="{
                                            'opacity-50': !day.current,
                                            'font-bold bg-secondary': day.isToday,
                                            'bg-primary text-primary-content rounded-full': isSelected(day.date),
                                            'bg-primary/30': isInRange(day.date),
                                            'rounded-r-full': startDate && isSameDay(day.date, startDate),
                                            'rounded-l-full': endDate && isSameDay(day.date, endDate)
                                        }"
                                        class="p-1 btn btn-ghost h-9 w-9"
                                        x-text="day.date.getDate()"
                                    ></button>
                                    @else
                                    <button
                                        type="button"
                                        @click="selectDate(day.date)"
                                        :class="{
                                            'opacity-50': !day.current,
                                            'font-bold bg-secondary': day.isToday,
                                            'bg-primary text-primary-content rounded-full': date && isSameDay(day.date, date)
                                        }"
                                        class="p-1 btn btn-ghost h-9 w-9"
                                        x-text="day.date.getDate()"
                                    ></button>
                                    @endif
                                </li>
                            </template>
                        </ul>
                    </div>

                    <!-- Months View -->
                    <div x-show="view === 'months'" class="p-4">
                        <ul class="grid grid-cols-3 gap-2 text-center text-sm">
                            <template x-for="(monthName, monthIndex) in months">
                                <li>
                                    <button
                                        type="button"
                                        @click="selectMonth(monthIndex)"
                                        :class="{
                                            'bg-primary text-primary-content font-bold': monthIndex === today.getMonth() && currentYear === today.getFullYear()
                                        }"
                                        class="p-2 btn btn-ghost w-full rounded-md hover:bg-base-200 transition-colors"
                                        x-text="monthName"
                                    ></button>
                                </li>
                            </template>
                        </ul>
                    </div>

                    <!-- Years View -->
                    <div x-show="view === 'years'" class="p-4">
                        <ul class="grid grid-cols-3 gap-2 text-center text-sm">
                            <template x-for="year in yearRange">
                                <li>
                                    <button
                                        type="button"
                                        @click="selectYear(year)"
                                        :class="{
                                            'bg-primary text-primary-content font-bold': today.getFullYear() === year
                                        }"
                                        class="p-2 btn btn-ghost w-full rounded-md hover:bg-base-200 transition-colors"
                                        x-text="year"
                                    ></button>
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
