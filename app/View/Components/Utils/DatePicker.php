<?php

namespace App\View\Components\Utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DatePicker extends Component
{
    public string $label;
    public bool $range;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label = 'Data', bool $range = false)
    {
        $this->label = $label;
        $this->range = $range;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return <<<blade
            <div
                x-data="{
                    open: false,
                    view: 'days',
                    hoverDate: null,
                    now: null,
                    yearRangeStart: 2020,
                    
                    @if ($this->range)
                    startDate: @entangle('{$wireModel}.start'),
                    endDate: @entangle('{$wireModel}.end'),
                    @else
                    date: @entangle('{$wireModel}'),
                    @endif

                    months: [
                        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                    ],

                    init() {
                        this.now = new Date();
                        this.yearRangeStart = Math.floor(this.now.getFullYear() / 9) * 9;
                    },

                    getCurrentMonth() {
                        return this.months[this.now.getMonth()];
                    },

                    getCurrentYear() {
                        return this.now.getFullYear();
                    },

                    navigate(direction) {
                        if (this.view === 'days') {
                            this.setMonth(direction);
                        } else if (this.view === 'months') {
                            this.setYear(direction);
                        } else if (this.view === 'years') {
                            this.setYearRange(direction);
                        }
                    },

                    setMonth(direction) {
                        if (direction === 'inc') {
                            this.now.setMonth(this.now.getMonth() + 1);
                        } else {
                            this.now.setMonth(this.now.getMonth() - 1);
                        }
                        this.now = new Date(this.now);
                    },

                    setYear(direction) {
                        if (direction === 'inc') {
                            this.now.setFullYear(this.now.getFullYear() + 1);
                        } else {
                            this.now.setFullYear(this.now.getFullYear() - 1);
                        }
                        this.now = new Date(this.now);
                    },

                    setYearRange(direction) {
                        if (direction === 'inc') {
                            this.yearRangeStart += 9;
                        } else {
                            this.yearRangeStart -= 9;
                        }
                    },

                    setView(view) {
                        this.view = view;
                    },

                    selectMonth(month) {
                        this.now.setMonth(month);
                        this.now = new Date(this.now);
                        this.view = 'days';
                    },

                    selectYear(year) {
                        this.now.setFullYear(year);
                        this.now = new Date(this.now);
                        this.view = 'months';
                    },

                    calendarDays() {
                        const year = this.now.getFullYear();
                        const month = this.now.getMonth();
                        
                        const startOfMonth = new Date(year, month, 1);
                        const endOfMonth = new Date(year, month + 1, 0);
                        
                        const startDayOfWeek = startOfMonth.getDay();
                        
                        const days = [];
                        
                        // Dias do mês anterior
                        if (startDayOfWeek > 0) {
                            const prevMonth = new Date(year, month, 0);
                            const prevMonthEndDay = prevMonth.getDate();
                            for (let i = startDayOfWeek - 1; i >= 0; i--) {
                                const date = new Date(year, month - 1, prevMonthEndDay - i);
                                days.push({
                                    date: date,
                                    current: false,
                                    isToday: this.isToday(date)
                                });
                            }
                        }
                        
                        // Dias do mês atual
                        for (let day = 1; day <= endOfMonth.getDate(); day++) {
                            const date = new Date(year, month, day);
                            days.push({
                                date: date,
                                current: true,
                                isToday: this.isToday(date)
                            });
                        }
                        
                        // Dias do mês seguinte
                        const remaining = 7 - (days.length % 7);
                        if (remaining < 7) {
                            for (let i = 1; i <= remaining; i++) {
                                const date = new Date(year, month + 1, i);
                                days.push({
                                    date: date,
                                    current: false,
                                    isToday: this.isToday(date)
                                });
                            }
                        }
                        
                        return days;
                    },

                    isToday(date) {
                        const today = new Date();
                        return date.getDate() === today.getDate() &&
                            date.getMonth() === today.getMonth() &&
                            date.getFullYear() === today.getFullYear();
                    },

                    formatDate(date) {
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        return `${day}/${month}/${year}`;
                    },

                    maskDate(e, field) {
                        let digits = e.target.value.replace(/\\D/g, '');
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
                        inputLabel?.classList.remove('!input-error');

                        if (masked.length === 10) {
                            const regex = /^(?:(?:31(\\/|-|\\.)(?:0?[13578]|1[02]))\\1|(?:(?:29|30)(\\/|-|\\.)(?:0?[13-9]|1[0-2])\\2))(?:(?:1[6-9]|[2-9]\\d)?\\d{2})$|^(?:29(\\/|-|\\.)(?:0?2)\\3(?:(?:(?:1[6-9]|[2-9]\\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))$)|^(?:0?[1-9]|1\\d|2[0-8])(\\/|-|\\.)(?:(?:0?[1-9])|(?:1[0-2]))\\4(?:(?:1[6-9]|[2-9]\\d)?\\d{2})$/;
                            if (!regex.test(masked)) {
                                inputLabel?.classList.add('!input-error');
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'text-error js-error-message';
                                errorDiv.textContent = 'Data inválida';
                                fieldset?.appendChild(errorDiv);
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

                    @if({$range})
                    isBetween(date, start, end) {
                        const d = this.parseDate(date);
                        const s = this.parseDate(start);
                        const e = this.parseDate(end);
                        if (!d || !s || !e) return false;
                        return d > s && d < e;
                    },

                    isInRange(dateStr) {
                        if (this.startDate && this.endDate) {
                            return this.isBetween(dateStr, this.startDate, this.endDate);
                        }
                        if (this.startDate && this.hoverDate && !this.endDate) {
                            const start = this.parseDate(this.startDate);
                            const hover = this.parseDate(this.hoverDate);
                            if (hover >= start) {
                                return this.isBetween(dateStr, this.startDate, this.hoverDate);
                            } else {
                                return this.isBetween(dateStr, this.hoverDate, this.startDate);
                            }
                        }
                        return false;
                    },

                    setInput(dateStr) {
                        const clickedDate = this.parseDate(dateStr);
                        if (!this.startDate || this.endDate) {
                            this.startDate = dateStr;
                            this.endDate = null;
                        } else {
                            const startDateObj = this.parseDate(this.startDate);
                            if (clickedDate < startDateObj) {
                                this.startDate = dateStr;
                            } else {
                                this.endDate = dateStr;
                                this.open = false;
                                this.hoverDate = null;
                            }
                        }
                    },
                    @else
                    setInput(dateStr) {
                        this.date = dateStr;
                        this.open = false;
                    },
                    @endif

                    togglePicker() {
                        this.open = !this.open;
                    }
                }"
                x-init="init()">

                @if ({$range})
                <div class="flex gap-4" x-ref="trigger">
                    <x-input
                        label="De:"
                        icon="o-calendar"
                        x-model.lazy="startDate"
                        x-on:input="maskDate($event, 'startDate')"
                        @click="togglePicker()" />
                    <x-input
                        label="Até:"
                        icon="o-calendar"
                        x-model.lazy="endDate"
                        x-on:input="maskDate($event, 'endDate')"
                        @click="togglePicker()" />
                </div>
                @else
                <div class="flex gap-4" x-ref="trigger">
                    <x-input
                        label="{$label}"
                        icon="o-calendar"
                        x-model.lazy="date"
                        x-on:input="maskDate($event, 'date')"
                        @click="togglePicker()" />
                </div>
                @endif

                <template x-teleport="main">
                    <div
                        x-show="open"
                        @click.outside="open = false"
                        @click.stop
                        class="bg-base-100 w-fit flex flex-col rounded-md shadow-lg max-w-lg min-w-[300px] z-1000"
                        x-transition
                        x-anchor.bottom-start.offset.10="$refs.trigger">
                        <div class="flex items-center justify-between px-4 mt-2">
                            <x-button
                                icon="o-arrow-left"
                                class="btn-circle btn-ghost"
                                @click="navigate('dec')" />

                            <div x-show="view === 'days'" class="font-semibold text-center">
                                <span
                                    class="cursor-pointer hover:text-primary"
                                    @click="setView('months')"
                                    x-text="getCurrentMonth()"></span>
                                de
                                <span
                                    class="cursor-pointer hover:text-primary"
                                    @click="setView('years')"
                                    x-text="getCurrentYear()"></span>
                            </div>

                            <div x-show="view === 'months'" class="font-semibold text-center">
                                <span
                                    class="cursor-pointer hover:text-primary"
                                    @click="setView('years')"
                                    x-text="getCurrentYear()"></span>
                            </div>

                            <div x-show="view === 'years'" class="font-semibold text-center">
                                <span x-text="yearRangeStart"></span> - <span x-text="yearRangeStart + 8"></span>
                            </div>

                            <x-button
                                icon="o-arrow-right"
                                class="btn-circle btn-ghost"
                                @click="navigate('inc')" />
                        </div>

                        <div x-show="view === 'days'" @mouseleave="hoverDate = null">
                            <ul class="grid grid-cols-7 gap-0.5 p-4 text-center text-sm">
                                <template x-for="weekday in ['D', 'S', 'T', 'Q', 'Q', 'S', 'S']">
                                    <li class="font-medium text-xs text-base-content/50" x-text="weekday"></li>
                                </template>

                                <template x-for="(day, index) in calendarDays()" :key="index">
                                    <li>
                                        @if ({$range})
                                        <button
                                            type="button"
                                            @click="setInput(formatDate(day.date))"
                                            @mouseenter="hoverDate = formatDate(day.date)"
                                            :class="{
                                                'opacity-50': !day.current,
                                                'font-bold': day.isToday,
                                                'bg-primary text-primary-content rounded-full': startDate === formatDate(day.date) || endDate === formatDate(day.date) || (startDate && !endDate && hoverDate === formatDate(day.date)),
                                                'bg-primary/30': isInRange(formatDate(day.date)),
                                                'rounded-r-full': startDate === formatDate(day.date) || (hoverDate && parseDate(hoverDate) < parseDate(startDate) && formatDate(day.date) === hoverDate),
                                                'rounded-l-full': endDate === formatDate(day.date) || (hoverDate && parseDate(hoverDate) > parseDate(startDate) && formatDate(day.date) === hoverDate)
                                            }"
                                            class="p-1 btn btn-ghost h-9 w-9"
                                            x-text="day.date.getDate()"></button>
                                        @else
                                        <button
                                            type="button"
                                            @click="setInput(formatDate(day.date))"
                                            :class="{
                                                'opacity-50': !day.current,
                                                'font-bold bg-primary text-primary-content rounded-full': day.isToday,
                                                'bg-primary text-primary-content rounded-full': date === formatDate(day.date)
                                            }"
                                            class="p-1 btn btn-ghost h-9 w-9"
                                            x-text="day.date.getDate()"></button>
                                        @endif
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <div x-show="view === 'months'" class="p-4">
                            <ul class="grid grid-cols-3 gap-2 text-center text-sm">
                                <template x-for="(monthName, monthIndex) in months" :key="monthIndex">
                                    <li>
                                        <button
                                            type="button"
                                            @click="selectMonth(monthIndex)"
                                            :class="{
                                                'bg-primary text-primary-content': now.getMonth() === monthIndex,
                                                'font-bold': now.getMonth() === monthIndex
                                            }"
                                            class="p-2 btn btn-ghost w-full rounded-md hover:bg-base-200 transition-colors"
                                            x-text="monthName"></button>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <div x-show="view === 'years'" class="p-4">
                            <ul class="grid grid-cols-3 gap-2 text-center text-sm">
                                <template x-for="year in Array.from({length: 9}, (_, i) => yearRangeStart + i)" :key="year">
                                    <li>
                                        <button
                                            type="button"
                                            @click="selectYear(year)"
                                            :class="{
                                                'bg-primary text-primary-content': now.getFullYear() === year,
                                                'font-bold': now.getFullYear() === year
                                            }"
                                            class="p-2 btn btn-ghost w-full rounded-md hover:bg-base-200 transition-colors"
                                            x-text="year"></button>
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
