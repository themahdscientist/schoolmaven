<?php

namespace App\PowerGridThemes;

use PowerComponents\LivewirePowerGrid\Themes\Components\Actions;
use PowerComponents\LivewirePowerGrid\Themes\Components\Checkbox;
use PowerComponents\LivewirePowerGrid\Themes\Components\Cols;
use PowerComponents\LivewirePowerGrid\Themes\Components\Editable;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterBoolean;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterDatePicker;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterInputText;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterMultiSelect;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterNumber;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterSelect;
use PowerComponents\LivewirePowerGrid\Themes\Components\Footer;
use PowerComponents\LivewirePowerGrid\Themes\Components\Radio;
use PowerComponents\LivewirePowerGrid\Themes\Components\SearchBox;
use PowerComponents\LivewirePowerGrid\Themes\Components\Table;
use PowerComponents\LivewirePowerGrid\Themes\Tailwind;
use PowerComponents\LivewirePowerGrid\Themes\Theme;

class CustomFilament extends Tailwind
{
    public string $name = 'tailwind';

    public function table(): Table
    {
        return Theme::table('min-w-full bg-light dark:bg-body-dark')
            ->div('rounded-t-lg relative border-x border-t border-primary/20 dark:border-primary/60')
            ->thead('shadow-sm rounded-t-lg bg-primary dark:bg-body-dark')
            ->thAction('!font-bold')
            ->tdAction('')
            ->tr('')
            ->trFilters('bg-light shadow-sm dark:bg-primary/80')
            ->th('font-semibold px-2 pr-4 py-3 text-left text-xs font-semibold text-secondary tracking-wider whitespace-nowrap dark:text-light')
            ->tbody('text-dark dark:text-light')
            ->trBody('border-b border-primary/10 dark:border-primary/50 hover:bg-secondary dark:bg-body-dark dark:hover:bg-primary')
            ->tdBody('pl-[19px] px-3 py-2 whitespace-nowrap text-dark dark:text-light')
            ->tdBodyEmpty('px-3 py-2 whitespace-nowrap text-dark dark:text-light')
            ->trBodyClassTotalColumns('')
            ->tdBodyTotalColumns('px-3 py-2 whitespace-nowrap dark:text-secondary text-sm text-body-dark text-right space-y-2');
    }

    public function footer(): Footer
    {
        return Theme::footer()
            ->view($this->root().'.footer')
            ->select('block !appearance-none bg-light border border-primary/10 text-dark py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:border-primary/50 dark:text-light dark:placeholder-bg-secondary dark:bg-body-dark dark:border-primary/50');
    }

    public function actions(): Actions
    {
        return Theme::actions()
            ->headerBtn('block w-full bg-primary-50 text-primary/70 border border-primary/20 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-light focus:border-primary/60 dark:bg-primary/80 dark:text-primary/20 dark:placeholder-bg-primary/30 dark:border-primary/60')
            ->rowsBtn('focus:outline-none text-sm py-2.5 px-5 rounded border');
    }

    public function cols(): Cols
    {
        return Theme::cols()
            ->div('select-none')
            ->clearFilter('', '');
    }

    public function editable(): Editable
    {
        return Theme::editable()
            ->view($this->root().'.editable')
            ->span('flex justify-between')
            ->input('dark:bg-primary/80 bg-primary-50 text-black/70 border border-primary/20 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-light focus:border-primary/20 dark:bg-primary/60 dark:bg-primary/80 dark:text-primary/20 dark:placeholder-bg-primary/30 dark:border-primary/60 shadow-md');
    }

    public function checkbox(): Checkbox
    {
        return Theme::checkbox()
            ->th('px-6 py-3 text-left text-xs font-medium text-primary/50 tracking-wider')
            ->label('flex items-center space-x-3')
            ->input('h-4 w-4');
    }

    public function radio(): Radio
    {
        return Theme::radio()
            ->th('px-6 py-3 text-left text-xs font-medium text-primary/50 tracking-wider')
            ->label('flex items-center space-x-3')
            ->input('form-radio rounded-full transition ease-in-out duration/10');
    }

    public function filterBoolean(): FilterBoolean
    {
        return Theme::filterBoolean()
            ->view($this->root().'.filters.boolean')
            ->base('min-w-[5rem]')
            ->select('appearance-none block mt-1 mb-1 bg-light border border-primary/30 text-primary/70 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-light focus:border-primary/50 w-full dark:bg-primary/80 dark:text-primary/20 dark:placeholder-bg-primary/30 dark:border-primary/60', 'max-width: 370px');
    }

    public function filterDatePicker(): FilterDatePicker
    {
        return Theme::filterDatePicker()
            ->base()
            ->view($this->root().'.filters.date-picker')
            ->input('flatpickr flatpickr-input block my-1 bg-light border border-primary/30 text-primary/70 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-light focus:border-primary/50 w-full placeholder-bg-primary/40 dark:bg-primary/80 dark:text-primary/20 dark:placeholder-bg-primary/30 dark:border-primary/60');
    }

    public function filterMultiSelect(): FilterMultiSelect
    {
        return Theme::filterMultiSelect()
            ->base('inline-block relative w-full')
            ->select('mt-1')
            ->view($this->root().'.filters.multi-select');
    }

    public function filterNumber(): FilterNumber
    {
        return Theme::filterNumber()
            ->view($this->root().'.filters.number')
            ->input('block bg-light border border-primary/30 text-primary/70 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-light focus:border-primary/50 w-full min-w-[5rem] placeholder-bg-primary/40 dark:bg-primary/80 dark:text-primary/20 dark:placeholder-bg-primary/30 dark:border-primary/60');
    }

    public function filterSelect(): FilterSelect
    {
        return Theme::filterSelect()
            ->view($this->root().'.filters.select')
            ->base('min-w-[9.5rem]')
            ->select('appearance-none block bg-light border border-primary/30 text-primary/70 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-light focus:border-primary/50 w-full dark:bg-primary/80 dark:text-primary/20 dark:placeholder-bg-primary/30 dark:border-primary/60');
    }

    public function filterInputText(): FilterInputText
    {
        return Theme::filterInputText()
            ->view($this->root().'.filters.input-text')
            ->base('min-w-[9.5rem]')
            ->select('appearance-none block bg-light border border-primary/30 text-primary/70 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-light focus:border-primary/50 w-full placeholder-bg-primary/40 dark:bg-primary/80 dark:text-primary/20 dark:placeholder-bg-primary/30 dark:border-primary/60')
            ->input('w-full block bg-light text-primary/70 border border-primary/30 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-light focus:border-primary/50 placeholder-bg-primary/40 dark:bg-primary/80 dark:text-primary/20 dark:placeholder-bg-primary/30 dark:border-primary/60');
    }

    public function searchBox(): SearchBox
    {
        return Theme::searchBox()
            ->input('placeholder-body-dark text-sm pl-[36px] block w-full float-right bg-light text-dark border border-primary rounded-lg py-2 px-3 leading-tight focus:outline-none focus:border-primary pl-10 dark:bg-body-dark dark:text-light dark:placeholder-secondary dark:border-primary')
            ->iconClose('text-body-dark dark:text-secondary')
            ->iconSearch('text-body-dark mr-2 w-5 h-5 dark:text-secondary');
    }
}
