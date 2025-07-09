@extends('layouts.app')

@section('title', 'Proses Apriori')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Proses Apriori</h3>

    <form method="POST" action="{{ route('admin.apriori.process') }}" class="mb-4">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label for="support1" class="form-label">Min Support 1-Itemset (%)</label>
                <input type="number" name="support1" id="support1" class="form-control" value="{{ old('support1', 0.05) }}" step="0.01" min="0" max="100" required>
            </div>
            <div class="col-md-4">
                <label for="support2" class="form-label">Min Support 2-Itemset (%)</label>
                <input type="number" name="support2" id="support2" class="form-control" value="{{ old('support2', 0.05) }}" step="0.01" min="0" max="100" required>
            </div>
            <div class="col-md-4">
                <label for="confidence" class="form-label">Min Confidence (%)</label>
                <input type="number" name="confidence" id="confidence" class="form-control" value="{{ old('confidence', 30) }}" step="1" min="0" max="100" required>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="fas fa-cogs me-1"></i> Proses</button>
        </div>
    </form>

    {{-- Frequent 1-Itemset --}}
    @isset($frequent1Itemsets)
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            <strong>Frequent 1-Itemset</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr><th>No</th><th>Item</th><th>Frekuensi</th></tr>
                </thead>
                <tbody>
                    @foreach($frequent1Itemsets as $index => $itemset)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ implode(', ', $itemset['item']) }}</td>
                            <td>{{ $itemset['frequency'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endisset

    {{-- Frequent 2-Itemset --}}
    @isset($frequent2Itemsets)
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-info text-white">
            <strong>Frequent 2-Itemset</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr><th>No</th><th>Itemset</th><th>Frekuensi</th><th>Support</th></tr>
                </thead>
                <tbody>
                    @foreach($frequent2Itemsets as $index => $itemset)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ implode(', ', $itemset['itemset']) }}</td>
                            <td>{{ $itemset['frequency'] }}</td>
                            <td>{{ $itemset['support'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endisset

    {{-- Confidence & Rule --}}
    @isset($rules)
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white">
            <strong>Hasil Aturan Confidence (Minimum: {{ $minConfidence }}%)</strong>
        </div>
        <div class="card-body table-responsive">
            @if(count($rules))
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Rule</th>
                        <th>Support</th>
                        <th>Confidence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rules as $index => $rule)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rule['rule'] }}</td>
                            <td>{{ $rule['support'] }}</td>
                            <td>{{ $rule['confidence'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning mb-0">
                    Tidak ada aturan yang memenuhi minimum confidence.
                </div>
            @endif
        </div>
    </div>
    @endisset
</div>
@endsection
