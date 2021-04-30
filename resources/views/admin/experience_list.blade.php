@extends('layouts.admin')
@section('title')
    Experience İnformation List
@endsection
@section('css')
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">Deneyim Bilgileri Listesi</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item active" aria-current="page">Deneyim Bilgileri Listesi</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('admin.experience.add')}}" class="btn btn-primary btn-block">Yeni Deneyim Ekle</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                                <th>Sıralama</th>
                                <th>Deneyim Tarihi</th>
                                <th>Pozisyon</th>
                                <th>Firma</th>
                                <th>Açıklama</th>
                                <th>Status</th>
                                <th>Active</th>
                                <th>Eklenme Tarihi</th>
                                <th>Güncellenme Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr id="{{$item->id}}">
                                    <td>{{$item->id}}</td>
                                    <td><a href="{{route('admin.experience.add',['experienceID'=>$item->id])}}" class="btn btn-warning editEducation">Düzenle<i class="fa fa-edit"></i></a></td>
                                    <td><a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-danger deleteEducation">Sil<i class="fa fa-trash"></i></a></td>
                                    <td>{{$item->order}}</td>
                                    <td>{{$item->data}}</td>
                                    <td>{{$item->task_name}}</td>
                                    <td>{{$item->company_name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        @if($item->status)
                                            <a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-success changeStatus">Aktif</a>
                                        @else
                                            <a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-danger changeStatus">Pasif</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->active)
                                                <a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-success activeStatus">Aktif</a>
                                            @else
                                                <a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-danger activeStatus">Pasif</a>
                                            @endif
                                    </td>

                                    <td>{{\Carbon\Carbon::parse($item->created_at)->format("d-m-Y H:i:s")}}</td>
                                    <td>{{\Carbon\Carbon::parse($item->updated_at)->format("d-m-Y H:i:s")}}</td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>
        //layouts admin tarafın da meta etiketinden ajax ile token çekme.
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr("content")
            }
        });

        //anasayfa da aktif pasif olayı
        $('.changeStatus').click(function (){

            //status butonunda ki id değerini alma.
            //2.yöntem
            //let educationID = $(this).data('id');
           let experienceID = $(this).attr('data-id');
           //.changeStatus(button click olduğu sınıfı) self olarak alıp aşağı tarafta kullanıyoruz.
           let self=$(this);

           $.ajax({
              url:"{{route('admin.experience.changeStatus')}}",
              //method:"POST",
              type:"POST",
              async:false,
              data:{
                  experienceID:experienceID
              },
              success:function (response)
              {
                  //console.log(response);  --kontrol amaçlı.
                  Swal.fire({
                      icon: 'success',
                      title: 'Başarılı.',
                      text: response.experienceID + "ID'li kayıt durumu "+response.newStatus+"olarak güncellenmiştir",
                      confirmButtonText:'Tamam'

                  })

                  if (response.status==1)
                  {
                      self[0].innerText="Aktif";
                      self.removeClass("btn-danger");
                      self.addClass("btn-success");
                  }
                  else if (response.status==0)
                  {
                      self[0].innerText="Pasif";
                      self.removeClass("btn-success");
                      self.addClass("btn-danger");

                  }
              },
               error:function ()
               {

               }
           });
        });

        //anasayfa da aktif pasif olayı(iş yerinde aktif çalışıyor mu)
        $('.activeStatus').click(function (){

            //status butonunda ki id değerini alma.
            //2.yöntem
            //let educationID = $(this).data('id');
            let experienceID = $(this).attr('data-id');
            //.changeStatus(button click olduğu sınıfı) self olarak alıp aşağı tarafta kullanıyoruz.
            let self=$(this);

            $.ajax({
                url:"{{route('admin.experience.activeStatus')}}",
                //method:"POST",
                type:"POST",
                async:false,
                data:{
                    experienceID:experienceID
                },
                success:function (response)
                {
                    //console.log(response);  --kontrol amaçlı.
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı.',
                        text: response.experienceID + "ID'li active durumu "+response.newStatus+"olarak güncellenmiştir",
                        confirmButtonText:'Tamam'

                    })

                    if (response.active==1)
                    {
                        self[0].innerText="Aktif";
                        self.removeClass("btn-danger");
                        self.addClass("btn-success");
                    }
                    else if (response.active==0)
                    {
                        self[0].innerText="Pasif";
                        self.removeClass("btn-success");
                        self.addClass("btn-danger");

                    }
                },
                error:function ()
                {

                }
            });
        });


        //.ajax ile silme işlemi tr taglarına verdiğimiz id ve class lar ile silme işlemi yapıyoruz.
        $('.deleteExperience').click(function () {

            //status butonunda ki id değerini alma.
            //2.yöntem
            //let educationID = $(this).data('id');
            let experienceID = $(this).attr('data-id');


            //sweetalert2 ile silme işlemi. içerisinde ajax kulanıldı
            Swal.fire({
                title: 'Eminmisiniz?',
                text: educationID + "ID'li eğitim bilgisini silmek istediğinize eminmisiniz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet!',
                cancelButtonText: 'Hayır!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url:"{{route('admin.experience.delete')}}",
                        //method:"POST",
                        type:"POST",
                        async:false,
                        data:{
                            experienceID:experienceID
                        },
                        success:function (response)
                        {
                            //console.log(response);  --kontrol amaçlı.
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı.',
                                text: 'Silme işlemi başarılı...!',
                                confirmButtonText:'Tamam'

                            });
                            $("tr#"+experienceID).remove();
                        },
                        error:function ()
                        {

                        }
                    });
                }
            })



        });
    </script>
@endsection
