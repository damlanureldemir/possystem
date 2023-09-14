@extends('front.master')
@section('title','Tüm Kategoriler')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    <strong>Başarılı!</strong>
                    {{session()->get('message')}}
                </div>
            @endif
            <div class="container mt-2">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right mb-2">
                            <a class="btn btn-success" onclick="add()" href="javascript:void(0)">kategori ekle</a>
                        </div>
                    </div>
                </div>
            </div>
                <div class="container">
                    <h1>Category Listesi</h1>
                    <div class="card">
                        <div class="card-body">
                            <table  class="table table-bordered " id="categoryTable_id">
                                <thead>
                                <tr>
                                    <th>isim</th>
                                    <th>Silme işlemi</th>
                                </tr>
                                </thead>
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="category-modal"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title " >Name</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0)" id="kategoriEkleForm" name="kategoriEkleForm" method="post">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                            <label for="category_name">Kategori Adı</label>
                                            <input type="text" class="form-control" id="category_name" name="name">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" onclick="submitCategoryForm()">Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
            $(document).ready(function() {
                $('#categoryTable_id').DataTable();
            });
            var table = $('#categoryTable_id').DataTable({
                    proccessing:false,
                    serverSide:false,
                    ajax:{
                        url:"{!!route('category.fetch')!!}"
                    },
                    columns:[
                        {data:'name',name:'name'},
                        {data:'action',name:'action',orderable:false,searchable:false},

                    ]
                });


            function add(){
                $('#category-modal').modal('show');
            }

            function submitCategoryForm(){
                var formData = new FormData(document.getElementById('kategoriEkleForm'));
                $.ajax({
                    url: '{{ route('category.create') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache:false,
                    success: function(response) {
                        if (response.success) {
                            $('#category-modal').modal('hide'); // Modal'ı kapat
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: 'Kategori başarıyla oluşturuldu.',
                            });

                        }
                    }
                });
            }
            function deleteCategory(id){
                if(confirm("silmek istediğinizden emin misiniz?")){
                    var id=id;
                    $.ajax({
                        type: 'POST',
                        url: 'delete/' + id,
                        data:{id:id},
                        dataType: 'json',
                        success:function (response){
                            if(response.success){
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Silindi!',
                                    text: 'başarıyla silindi!',
                                });
                            }

                        }

                    });
                }
            }


        </script>

@endsection
