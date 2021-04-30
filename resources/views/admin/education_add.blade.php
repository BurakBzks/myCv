@extends('layouts.admin')

@php
if (!is_null($education))
    {
        $educationText='Eğitim Düzenleme';
    }
    else
        {
            $educationText='Eğitim Ekleme';
        }
@endphp


@section('title')
    {{$educationText}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$educationText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.education.list')}}">Education List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Educational İnformation Add</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form id="createEducationForm" class="forms-sample" action="" method="POST">
                        @csrf
                        @if($education)
                            <inpu type="hidden" name="educationID" value="{{$education->id}}"></inpu>
                        @endif
                        <div class="form-group">
                            <label for="university_date">Eğitim Tarihi</label>
                            <input type="text" class="form-control" name="university_date" id="university_date"
                                   placeholder="Eğitim Tarihi" value="{{$education ? $education->university_date : ''}}">
                            <small>Örneğin : 2012-2016</small>
                            @error('university_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="university_name">Üniversite Adı</label>
                            <input type="text" class="form-control" id="university_name" name="university_name"
                                   placeholder="Üniversite Adı" value="{{$education ? $education->university_name : ''}}">
                            @error('university_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="university_branch">Üniversite Bölüm</label>
                            <input type="text" class="form-control" name="university_branch" id="university_branch"
                                   placeholder="Üniversite Bölüm" value="{{$education ? $education->university_branch : ''}}">
                            @error('university_branch')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="7"
                                      placeholder="Açıklama" >{{$education ? $education->description : ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="order">Görüntülencek Eğitim Sırası</label>
                            <input type="text" class="form-control" name="order" id="order"
                                   placeholder="Görüntülencek Eğitim Sırası" value="{{$education ? $education->order : ''}}">
                            @error('order')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="status">
                                    @php
                                    if ($education)
                                        {
                                            $checkStatus=$education->status ? "checked" : '';
                                        }
                                        else
                                            {
                                                $checkStatus='';
                                            }
                                    @endphp
                                    <input type="checkbox" name="status" id="status" class="form-check-input" {{$checkStatus}}> Eğitim Gösterilme Durumu </label>
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


            if ($('#university_date').val().trim()=='')
            {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı...',
                    text: 'Lütfen Tarih Giriniz!'

                })
            }
            else if($('#university_name').val().trim()=='')
            {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı...',
                    text: 'Lütfen üniversite adını yazın!'

                })
            }
            else if($('#university_branch').val().trim()=='')
            {
                Swal.fire({
                    icon: 'info',
                    title: 'Uyarı...',
                    text: 'Lütfen üniversite bölümü yazınız!'

                })
            }
            else
            {
                $('#createEducationForm').submit();
            }
        })
    </script>
@endsection
