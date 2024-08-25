@extends('base')

@section('title', 'Stocks')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Liste Stock</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Stock</a></li>
                    <li class="breadcrumb-item active">Liste Stock</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">

        <div class="d-inline-flex">
            <a href="{{ route('stocks.create') }}" title="Add Stock">
                <button type="button" class="btn btn-success waves-effect waves-light mb-3 me-2">
                    <i class="mdi mdi-plus me-1"></i>
                    Nouveau Stock
                </button>
            </a>
            <a href="{{ route('stock.out') }}" class="btn btn-primary mb-3">
                <i class="fas fa-sign-out-alt me-1"></i>
                Stock Out
            </a>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-6">
                <form method="get" id="stockForm">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="DataTables_Table_0_length">
                                <label class="d-flex align-items-center">
                                    <select id="category-filter" name="category" class="form-control form-control-sm me-2 w-auto" aria-controls="DataTables_Table_0">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ Request::input('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="DataTables_Table_0_length">
                                <label class="d-flex align-items-center">
                                    <input type="search" name="name" id="name-filter" class="form-control form-control-sm me-2 w-auto"
                                           placeholder="CodeBarre / Name / Description" value="{{ Request::input('name') }}" aria-controls="DataTables_Table_0">
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="table-responsive mb-4">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-centered datatable dt-responsive nowrap table-card-list dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px 12px; width: 100%;" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead style="background-color: #dde0e0;">
                                <tr class="bg-transparent">
                                    <th style="width: 22px;"></th>
                                    <th class="sorting" style="width: 86px;">Image</th>
                                    <th class="sorting" style="width: 120px;">Nom</th>
                                    <th class="sorting" style="width: 217px;">Description</th>
                                    <th class="sorting" style="width: 144px;">Catégorie</th>
                                    <th class="sorting" style="width: 144px;">Stock</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="stock-tbody">
                                @forelse ($stocks as $stock)
                                    <tr role="row" class="odd">
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input" id="stockcheck{{ $stock->id }}" value="{{ $stock->id }}">
                                        </td>
                                        <td class="text-center">
                                            @if ($stock->product && $stock->product->image)
                                                <img width="50px" height="50px" src="{{ asset('storage/' . $stock->product->image) }}" alt="Product Image" class="rounded-circle">
                                            @else
                                                <img width="50px" height="50px" src="{{ asset('storage/default-image.png') }}" alt="Default Image" class="rounded-circle">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $stock->product ? $stock->product->name : 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $stock->product ? $stock->product->description : 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($stock->product && $stock->product->category)
                                                <a href="{{ route('categories.show', $stock->product->category->id) }}" class="btn btn-link">
                                                    <span class="badge" style="background-color:#F97300;">
                                                        {{ $stock->product->category->name }}
                                                    </span>
                                                </a>
                                            @else
                                                ----------
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $stock->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $stock->quantity }}
                                            </span>
                                        </td>
                                        <td style="white-space: nowrap;">
                                            <!-- Edit Stock Button -->
                                            <a href="{{ route('stocks.edit', $stock) }}" class="btn btn-sm btn-outline-primary rounded" title="Edit">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center"><h4>No Stocks</h4></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                 Affichage de 1 à 10 sur 12 entrées                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                    <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">
                                        Previous</a>
                                    </li>
                                    <li class="paginate_button page-item active">
                                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                    </li>
                                    <li class="paginate_button page-item ">
                                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                    </li>
                                    <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" class="page-link">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameFilter = document.getElementById('name-filter');
    const categoryFilter = document.getElementById('category-filter');
    const stockForm = document.getElementById('stockForm');

    function filterStocks() {
        stockForm.submit();
    }

    nameFilter.addEventListener('input', function() {
        if (nameFilter.value === '') {
            filterStocks(); // Soumettre automatiquement le formulaire si le champ est vidé
        }
    });

    categoryFilter.addEventListener('change', filterStocks);
});

</script>


@endsection
