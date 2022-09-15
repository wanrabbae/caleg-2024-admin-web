@extends('layouts.admin')

@section("content")

<div class="card shadow mb-4">
    <div class="card-header py-3">
            <!-- Button trigger modal -->
            <a href="{{ asset("backup/create") }}">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-disk"></i>
                Backup Now
            </button>
            </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Backup</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $i => $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data["filename"] }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ asset("backup?download=$i") }}">
                                        <button type="submit" class="btn btn-primary mr-4">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </a>
                                    <form action="{{ asset("backup/$i") }}" method="POST" class="d-inline">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
