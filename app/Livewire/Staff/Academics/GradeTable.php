<?php

namespace App\Livewire\Staff\Academics;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Column;
// use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class GradeTable extends PowerGridComponent
{
    public function datasource(): ?Collection
    {
        return \App\Models\User::query()->find(auth()->id())->staff->grades()->with('subjects', 'staff.user')->get();
    }

    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showRecordCount(),
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name');
            // ->add('price')
            // ->add('created_at_formatted', function ($entry) {
            //     return Carbon::parse($entry->created_at)->format('d/m/Y');
            // });
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            // Column::make('Price', 'price')
            //     ->sortable(),

            // Column::make('Created', 'created_at_formatted'),

            // Column::action('Action'),
        ];
    }
}
