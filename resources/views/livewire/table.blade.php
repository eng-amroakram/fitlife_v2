<div class="card" style="--mdb-card-box-shadow: 0 2px 15px -3px rgb(0, 0, 0), 0 10px 20px -2px rgba(0, 0, 0, 0.04);">
    <div class="card-body">

        <div id="customremoveinputgroup" class="input-group p-0 mb-3" wire:ignore>
            <!-- search input -->
            <div id="navbar-search-autocomplete" class="form-outline">
                <input type="search" id="form1" wire:model="search" class="form-control" />
                <label class="form-label" for="form1">{{ __('Search') }}</label>
            </div>

            @foreach ($selects as $name => $options)
                <x-table.extensions.select-search :input="$name" :options="$options">
                </x-table.extensions.select-search>
            @endforeach

        </div>

        <div class="table-responsive">

            <x-table.extensions.loading></x-table.extensions.loading>

            <table class="table table-hover text-nowrap table-bordered text-center">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th style="cursor: pointer;" wire:click="sortDirection" scope="col">

                                @if ($sort_direction == 'asc')
                                    <i class="fas fa-arrow-down-wide-short"></i>
                                @endif

                                @if ($sort_direction == 'desc')
                                    <i class="fas fa-arrow-up-wide-short"></i>
                                @endif

                                {{ $column }}
                            </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $model)
                        <x-table.rows :model="$model" :page="false" :updaterid="$updater_id" :table="$table"
                            :rows="$rows">
                        </x-table.rows>
                    @endforeach
                </tbody>

            </table>
        </div>

        @if ($create['check'])
            @if ($create['modal'])
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-rounded create-button" data-mdb-toggle="modal"
                        data-mdb-ripple-color="dark" data-mdb-target="#{{ $create['id'] }}">
                        <i class="fas fa-plus"></i>
                        {{ __($create['lable']) }}
                    </button>
                </div>
            @endif
        @endif

    </div>

    <div class="card-footer">
        <div class="d-flex justify-content-between">

            <div wire:ignore>
                <select class="select" wire:model="rows_number">
                    <option value="all">{{ __('All') }}</option>
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label class="form-label select-label">الصفوف</label>
            </div>

            <div>
                <nav aria-label="...">
                    <ul class="pagination pagination-circle">
                        {{ $data->withQueryString()->onEachSide(0)->links() }}
                    </ul>
                </nav>
            </div>

        </div>
    </div>

</div>
