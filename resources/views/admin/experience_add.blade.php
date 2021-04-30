@extends('layouts.admin')

@php
//Controllerden gelen compact('experience') değer.
if (!is_null($experience))
    {
        $experienceText='Deneyim Düzenleme';
    }
    else
        {
            $experienceText='Deneyim Ekleme';
        }
@endphp


@section('title')
    {{$experienceText}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$experienceText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.experience.list')}}">Experience List</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$experienceText}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form id="createExperienceForm" class="forms-sample" action="" method="POST">
                        @csrf
                        @if($experience)
                            <inpu type="hidden" name="experienceID" value="{{$experience->id}}"></inpu>
                        @endif
                        <div class="form-group">
                            <label for="data">Çalışma Tarihi</label>
                            <input type="text" class="form-control" name="data" id="data"
                                   placeholder="Çalışma Tarihi" value="{{$experience ? $experience->data : ''}}">
                            <small>Örneğin : 2012-2016</small>
                            @error('data')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="task_name">Görev Adı</label>
                            <input type="text" class="form-control" id="task_name" name="task_name"
                                   placeholder="Görev Adı" value="{{$experience ? $experience->task_name : ''}}">
                            @error('task_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_name">Çalıştığınız Firma</label>
                            <input type="text" class="form-control" name="company_name" id="company_name"
                                   placeholder="Çalıştığınız Firma" value="{{$experience ? $experience->company_name : ''}}">
                            @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="7"
                                      placeholder="Açıklama" >{{$experience ? $experience->description : ''}}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="order">Görüntülencek Deneyim Sırası</label>
                            <input type="text" class="form-control" name="order" id="order"
                                   placeholder="Görüntülencek Deneyim Sırası" value="{{$experience ? $experience->order : ''}}">
                            @error('order')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="status">
                                    @php
                                    if ($experience)
                                        {
                                            $checkStatus=$experience->status ? "checked" : '';
                                        }
                                        else
                                            {
                                                $checkStatus='';
                                            }
                                    @endphp
                                    <input type="checkbox" name="status" id="status" class="form-check-input" {{$checkStatus}}> Deneyim Gösterilme Durumu </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="status">
                                    @php
                                        if ($experience)
                                            {
                                                $checkActive=$experience->active ? "checked" : '';
                                            }
                                            else
                                                {
                                                    $checkActive='';
                                                }
                                    @endphp
                                    <input type="checkbox" name="active" id="active" class="form-check-input" {{$checkActive}}> İlgili Pozisyonda Çalışmaya Devam Ediyor Musunuz?</label>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary mr-2" id="createButton">Kaydet</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let createButton = $("#createButton");
        createButton.click(function (){


            if ($('#data').val().trim()=='')
            {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı...',
                    text: 'Lütfen Tarih Giriniz!',
                    confirmButtonText:"Tamam"

                })
            }
            else if($('#task_name').val().trim()=='')
            {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı...',
                    text: 'Lütfen Görev Adı Yazın!',
                    confirmButtonText:"Tamam"

                })
            }
            else if($('#company_name').val().trim()=='')
            {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı...',
                    text: 'Lütfen Çalıştığınız Firma Yazın!',
                    confirmButtonText:"Tamam"

                })
            }
            else
            {
                $('#createExperienceForm').submit();
            }
        })
    </script>
@endsection
