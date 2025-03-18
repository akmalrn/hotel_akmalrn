@extends('tamu.layouts')
@section('title', 'Kontak ' . ($configuration->title ?? ''))
@section('site-hero', 'Kontak')
@section('content')

    <section class="section contact-section" id="next">
        <div class="container">
            <div class="row">
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                    <form action="{{ route('send.email') }}" method="POST" class="bg-white p-md-5 p-4 mb-5 border">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                    
                        <div class="row">
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 form-group">
                                <label for="message">Write Message</label>
                                <textarea name="message" id="message" class="form-control" cols="30" rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="Send Message" class="btn btn-primary text-white font-weight-bold">
                            </div>
                        </div>
                    </form>                    

                </div>
                <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <div class="col-md-10 ml-auto contact-info">
                            <p><span class="d-block">Alamat:</span> <span>{{ $configuration->address ?? '' }}</span></p>
                            <p><span class="d-block">Telepon:</span> <span>{{ $configuration->phone_number ?? '' }}</span></p>
                            <p><span class="d-block">Email:</span> <span>{{ $configuration->email_address ?? '' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
