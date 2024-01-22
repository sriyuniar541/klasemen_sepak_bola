@extends('index') @section('title', 'Add_Product') @section('content') 

<div class="row shadow-lg p-3 mb-2 mt-5 bg-body-tertiary rounded d-flex">
   

    <h4 class="mt-5">Tambah Skor</h4>
    <form
        action="{{ url('/skor/store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        {{-- @method("POST") --}}

        <table class="table" id="table">
            <thead>
            <tr>
                <th scope="col">Nama Klub</th>
                <th scope="col">Skor</th>
                <th scope="col">Nama Klub</th>
                <th scope="col">Skor</th>
            <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <select class="form-select" id="klub_id" name = "inputs[0][klub_id]" aria-label="Floating label select example">
                        @foreach ($klub as $item)
                            <option selected value={{$item->id}}>{{$item->nama_klub ?? 'Nama Klub Tidak Tersedia'}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input
                        type="number"
                        class="form-control"
                        id="skor"
                        min=0                        
                        name = "inputs[0][skor]"                      
                        
                    />
                </td>
                <td>
                    <select class="form-select" id="klub_id_lawan" name = "inputs[0][klub_id_lawan]" aria-label="Floating label select example">
                        @foreach ($klub as $item)
                            <option selected value={{$item->id}}>{{$item->nama_klub ?? 'Nama Klub Tidak Tersedia'}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input
                        type="number"
                        class="form-control"
                        id="skor_lawan"
                        min=0                        
                        name = "inputs[0][skor_lawan]"                        
                    />
                </td>
                <td><button type="button" name="add" id="add" class="btn btn-outline-info col-lg-10">Insert multi</button></td>
            </tr>
            </tbody>
        </table>
        <button class="btn btn-info text-white">Save</button>
    </form>
</div>

<script>
    var i = 0;

    $('#add').click(function(){
        ++i;

        // Fetch klub options dynamically
        var klubOptions = '';
        @foreach ($klub as $item)
            klubOptions += '<option value={{$item->id}}>{{$item->nama_klub ?? 'Nama Klub Tidak Tersedia'}}</option>';
        @endforeach

        $('#table').append(
            `
            <tr>
                <td>
                    <select class="form-select" id="klub_id" name="inputs[${i}][klub_id]" aria-label="Floating label select example">
                        ${klubOptions}
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control" name="inputs[${i}][skor]" min=0  />
                </td>
                <td>
                    <select class="form-select" id="klub_id_lawan" name="inputs[${i}][klub_id_lawan]" aria-label="Floating label select example">
                        ${klubOptions}
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control" name="inputs[${i}][skor_lawan]" min=0  />
                </td>
                <td>
                    <button type="button" class="remove-table-row btn btn-outline-danger col-lg-10">Remove</button>
                </td>
            </tr>
            `
        );

        // Add event listener for the "Remove" button in the new row
        $('.remove-table-row').last().click(function () {
            $(this).closest('tr').remove();
        });
    });
</script>


@endsection
