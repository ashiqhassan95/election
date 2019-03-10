@section('page-content-title')
    {{ $title }}
@endsection
<div class="col-12 col-md-6 text-center text-md-left mb-4 mb-md-0">
    <span class="text-uppercase page-subtitle">{{ $title }}</span>
</div>

<div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
    <div>
        @if(isset($create_link))
            <a class="btn btn-primary" href="{{ $create_link }}">Create</a>
        @endif

        @if(isset($import_link))
            <a class="btn btn-white" href="{{ $import_link ?? '#'}}">Import</a>
        @endif


        @if(isset($export_link_csv) || isset($export_link_excel))
            <button class="btn btn-white dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Export
            </button>
            <div class="dropdown-menu dropdown-menu-small">
                @if(isset($export_link_csv))
                    <a class="dropdown-item" href="{{ $export_link_csv }}">CSV</a>
                @endif
                @if(isset($export_link_excel))
                    <a class="dropdown-item" href="{{ $export_link_excel }}">Excel</a>
                @endif
            </div>
        @endif
    </div>
</div>