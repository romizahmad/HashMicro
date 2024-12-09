@extends('layouts.home')

@section("content")
<div>
    <form method="POST" action="{{ route('input.compare') }}">
        @csrf
        <div>
            <label class="form-label">Compare Character :</label>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="first" name="first" placeholder="First Character">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="second" name="second" placeholder="Second Character">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Compare</button>
    </form>
    @isset($result)
        <div class="mt-5">
            <h2>Result: {{ $result }}%</h2>
        </div>
    @endisset
</div>
@endsection