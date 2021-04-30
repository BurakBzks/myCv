@extends('layouts.admin')
@section('title')
    Kişisel Bilgiler
@endsection
@section('css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">Kişisel Bilgiler</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Paneli</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kişisel Bilgileri Düzenle</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form id="createEducationForm" class="forms-sample" action="" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="main_title">Anasayfa Başlık</label>
                            <input type="text" class="form-control" name="main_title" id="main_title"
                                   placeholder="Anasayfa Başlık" value="{{$information->main_title}}">
                            @error('main_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for=about_text">Hakkımda Yazısı</label>
                            <texarea cols="80" id="about_text" name="about_text" rows="10" data-sample="1" data-sample-short="">
                                {!!$information->about_text!!}
                            </texarea>
                            @error('about_text')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="btn_contact_text">Bize Ulaşın Butonu</label>
                            <input type="text" class="form-control" name="btn_contact_text" id="btn_contact_text"
                                   placeholder="Bize Ulaşın" value="{{$information->btn_contact_text}}">
                            @error('btn_contact_text')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="small_title_left">Eğitim Başlığı Üzerindeki Ufak Başlık</label>
                            <input type="text" class="form-control" name="small_title_left" id="small_title_left"
                                   placeholder="Eğitim Bilgileri" value="{{$information->small_title_left}}">
                            @error('small_title_left')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="small_title_right">Deneyim Başlığı Üzerindeki Ufak Başlık</label>
                            <input type="text" class="form-control" name="small_title_right" id="small_title_right"
                                   placeholder="Deneyim Bilgileri" value="{{$information->small_title_right}}">
                            @error('small_title_right')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="full_name">Ad Soyad</label>
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                   placeholder="Ad Soyad" value="{{$information->full_name}}">
                            @error('full_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="image">Resim</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <img width="100%" src="{{$information->image ? 'storage/'.$information->image :'assets\images\faces\brk.jpg'}}" >
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="task_name">Pozisyon Adı</label>
                            <input type="text" class="form-control" name="task_name" id="task_name"
                                   placeholder="Pozisyon" value="{{$information->task_name}}">
                            @error('task_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birthday">Doğum Tarihi</label>
                            <input type="text" class="form-control" name="birthday" id="birthday"
                                   placeholder="Doğum Tarihi" value="{{$information->birthday}}">
                            @error('birthday')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="website">Web Site</label>
                            <input type="text" class="form-control" name="website" id="website"
                                   placeholder="Web Site" value="{{$information->website}}">
                            @error('website')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                   placeholder="Telefon" value="{{$information->phone}}">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mail">Mail Adresi</label>
                            <input type="text" class="form-control" name="mail" id="mail"
                                   placeholder="Mail Adresi" value="{{$information->mail}}">
                            @error('mail')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Adres</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   placeholder="Adres" value="{{$information->address}}">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cv">Özgeçmiş</label>
                            <input type="file" class="form-control" name="cv" id="cv" value="{{$information->cv}}">
                            @error('cv')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=languages">Diller</label>
                            <texarea cols="80" id="languages" name="lang" rows="10" data-sample="1" data-sample-short="">
                                {!!$information->lang!!}
                            </texarea>
                            @error('languages')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=interests">Hobiler</label>
                            <texarea cols="80" id="interests" name="interests" rows="10" data-sample="1" data-sample-short="">
                                {!!$information->interests!!}
                            </texarea>
                            @error('interests')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <button type="submit" class="btn btn-primary mr-2" id="createButton">Kaydet</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/ckeditor/samples/js/sample.js')}}"></script>
    <script>
        var about_text =CKEDITOR.replace('about_text',{
            extraAllowedContent: 'div',
            height:150
        });
        var languages =CKEDITOR.replace('languages',{
            extraAllowedContent: 'div',
            height:150
        });
        var interests =CKEDITOR.replace('interests',{
            extraAllowedContent: 'div',
            height:150
        });



    </script>
@endsection
